<?php

    namespace ControllerPayment;

    class Pay{
      protected $key;
      protected $url;
      protected $data;
      protected $endpoint;
      protected $callback;

      public function __construct(){
        $this->url = 'https://api.stripe.com';
        $this->key = 'YOUR PRIVATE TOKEN';
      }


      public function createUser($id_method, $city, $addressOne, $numberHome, $postalCode, $state, $email, $name, $phone){
        $this->endpoint = '/v1/customers';
        $this->data = [
          "address"             => [
                  "city"        => "$city",
                  "country"     => "BR",
                  "line1"       => "$addressOne",
                  "line2"       => "$numberHome",
                  "postal_code" => "$postalCode",
                  "state"       => "$state"
          ],
          "email"               => "$email",
          "name"                => "$name",
          "phone"               => "+55$phone",
          "shipping"            => [
                  "address"     => [
                  "city"        => "$city",
                  "country"     => "BR",
                  "line1"       => "$addressOne",
                  "line2"       => "$numberHome",
                  "postal_code" => "$postalCode",
                  "state"       => "$state"
                  ],
          "name"                => "$name",
          "phone"               => "+55$phone",
        ],
        "payment_method"      => "$id_method",
        ];

        $this->post();
        return $this;

      }


      public function paymentMethods($cardNumber, $cardExpMonth, $cardExpYear, $cardCvc){
        $this->endpoint = '/v1/payment_methods';
        $this->data = [
          "type"             => "card",
          "card[number]"     => $cardNumber,
          "card[exp_month]"  => $cardExpMonth,
          "card[exp_year]"   => $cardExpYear,
          "card[cvc]"        => $cardCvc,
        ];

        $this->post();
        return $this;
      }

      public function payCharges($amount, $vendor_user, $email_user, $products, $id_user){
        $destination = \MySql::connect()->prepare("SELECT * FROM `info_payment` WHERE `vendor_id` = '$vendor_user'");
        $destination->execute();
        $destination = $destination->fetch();
        $vendor_percentage = ($amount / 100) * (90);
        $vendor_percentage_format = $vendor_percentage * 100;

        $this->endpoint = '/v1/payment_intents';
        $this->data = [
            "amount"                      => $amount,
            "currency"                    => "brl",
            "application_fee_amount"      =>  $vendor_percentage_format,
            "transfer_data[destination]"  =>  "$destination[ref_id]",
            "description"                 => "$products",
            "customer"                    => "$id_user",
          ];

        $this->post();
        return $this;
      }

      public function callback(){
        return $this->callback();
      }


      public function post(){
        $url_format = $this->url.$this->endpoint;
        $key_format = ['api_key' => $this->key];

        $ch = curl_init($url_format);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($this->data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer YOUR PRIVATE TOKEN"]);
        $return = json_decode(curl_exec($ch));
        curl_close($ch);

        if($this->endpoint == '/v1/payment_methods'){
          return $this->createUser($return->id, $_POST['city'], $_POST['address_one'], $_POST['number_home'], $_POST['postal_code'], $_POST['state'], $_POST['email'], $_POST['name'], $_POST['phone']);
        }
        if($this->endpoint == '/v1/customers'){
           $this->payCharges($_POST['amount'],$_POST['vendor_id'],$_POST['email'],$_POST['products_id'],$return->id);
          $create_user = \MySql::connect()->prepare("INSERT INTO `method_payment` VALUES (null, ?, ?, ?, ?, ?, ?)");
          $create_user->execute(array($_SESSION['user_id'], $return->id, $_POST['card_number'], $_POST['card_exp_month'], $_POST['card_exp_year'], $_POST['card_cvc']));
        return;
        }

        if($this->endpoint == '/v1/charges'){
          $insert = \MySql::connect()->prepare("INSERT INTO `orders` VALUES (null, ?, ?, ?, ?, ?, ?, ?)");
          $insert->execute(array($return->id, $_SESSION['user_id'], $_POST['vendor_id'], $_POST['products_id'], $_POST['amount'], $_POST['city'], $_POST['address_one']));
          
          $delete = \MySql::connect()->prepare("DELETE FROM `cart` WHERE `vendor_id` = '$_POST[vendor_id]'");
          $delete->execute();

          $_SESSION['coupon'] = $_SESSION['coupon_value'] = $_SESSION['coupon_shop'] = '';
        }

      }
    }


    class paySplit extends pay{
      public function createClient($user_id,$email){
        $email = $_POST['email'];
        $this->endpoint = '/v1/accounts';
        $this->build = [
          "type"                                    => "express",
          "country"                                 => "BR",
          "email"                                   => "$email",
          "requested_capabilities"                  => ['card_payments', 'transfers'],
          "business_type"                           => "individual"
        ];

        $this->split();
        return $this;
      }

      public function finallyClient($ref_id){
        $this->endpoint = '/v1/account_links';
        $this->build = [
          "account"       =>  "$ref_id",
          "refresh_url"   => "http://localhost/Curso/Projeto/Marketplace/dashboard/",
          "return_url"    => "http://localhost/Curso/Projeto/Marketplace/dashboard/",
          "type"          =>  "account_onboarding"
        ];

        $this->split();
        return $this;
      }

      public function split(){
        $url_split = $this->url.$this->endpoint;
        $key_split = ['api_key' => $this->key];

        $request = curl_init($url_split);
        curl_setopt($request, CURLOPT_POST, true);
        curl_setopt($request, CURLOPT_POSTFIELDS, http_build_query($this->build));
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($request, CURLOPT_HTTPHEADER, ["Authorization: Bearer YOUR PRIVATE TOKEN"]);
        $return = json_decode(curl_exec($request));
        curl_close($request);
        
        @$arr = array($return->url);
        echo '<div class="alert success"><a href="'.$arr[0].'" target="__blank">Successfully Created. Click -> '.$arr[0].'</a></div>';

        if($this->endpoint == '/v1/accounts'){
          $insert = \MySql::connect()->prepare("INSERT INTO `info_payment` VALUES (null, ?, ?, ?, null)");
          $insert->execute(array($_SESSION['user_id'], $return->id, $_POST['email']));
      
          return $this->finallyClient($return->id);
        }
      }
    }


    class returnPayments{

      public function listPayments($token){
        $get = curl_init('https://api.stripe.com/v1/payment_intents');
        curl_setopt($get, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($get, CURLOPT_HTTPHEADER, ["Authorization: Bearer $token"]);
        curl_setopt($get, CURLOPT_HTTPGET, true);
        $response = json_decode(curl_exec($get));
        curl_close($get);

        $response_array = array($response);

        $data = $response_array[0]->data;

        foreach($data as $key => $value){
          if(!isset($data[$key]->charges->data[0]->status) ? $status = 'Undefined' : $status = $data[$key]->charges->data[0]->status);
          if(!isset($data[$key]->charges->data[0]->payment_method_details->card->brand) ? $brand = 'Undefined' : $brand = $data[$key]->charges->data[0]->payment_method_details->card->brand);
          if(!isset($data[$key]->charges->data[0]->description) ? $description = 'Undefined' : $description = $data[$key]->charges->data[0]->description);
          if(!isset($data[$key]->charges->data[0]->calculated_statement_descriptor) ? $customer = 'Undefined' : $customer = $data[$key]->charges->data[0]->calculated_statement_descriptor);
          if(!isset($data[$key]->charges->data[0]->billing_details->email) ? $email = 'Undefined' : $email = $data[$key]->charges->data[0]->billing_details->email);
          echo '<tr>';
          echo '<td><a href="'.INCLUDE_PATH_DASHBOARD_URL.'details-order?ref_id='.$data[$key]->id.'">'.$email.'</a></td>';
          echo '<td>'.$data[$key]->amount.'</td>';
          echo '<td>'.$status.'</td>';
          echo '<td>'.$brand.'</td>';
          echo '<td>'.$description.'</td>';
          echo '<td>'.$customer.'</td>';
          echo '</tr>';
        }
      }

      public static function getOrders($ref_id,$token){
          $get_order = curl_init("https://api.stripe.com/v1/payment_intents/$ref_id");
          curl_setopt($get_order, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($get_order, CURLOPT_HTTPHEADER, ["Authorization: Bearer $token"]);
          $return_order = json_decode(curl_exec($get_order));
          curl_close($get_order);

          return $return_order;
      }
    }
?>


