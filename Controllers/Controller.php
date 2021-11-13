<?php
    namespace Controller;

    class Controller{
        public function index(){
            $url = (isset($_GET['url']) ? $_GET['url'] : 'home');
            $slug = explode('/',$url)[0];

            if(file_exists('views/'.$slug.'.php')){
                include('views/templates/header.php');
                include('views/'.$slug.'.php');
                include('views/templates/footer.php');
            }
            else if(file_exists('views/dashboard/pages/'.$slug.'.php')){
                include('views/dashboard/index.php');
            }
            else{
                die("No Exists");
            }
        }

        public static function login($email, $password){
            $verify_user = \MySql::connect()->prepare("SELECT * FROM `users` WHERE `email` = ? AND `password` = ?");
            $verify_user->execute(array($email, $password));
            $info_user = $verify_user->fetch();
            if($verify_user->rowCount() == 1){
                $_SESSION['login'] = true;
                $_SESSION['user_id'] = $info_user['id'];
                $_SESSION['name'] = $info_user['name'];
                $_SESSION['email'] = $info_user['email'];
                $_SESSION['password'] = $info_user['password'];
                $_SESSION['cep'] = $info_user['cep'];
                $_SESSION['image'] = $info_user['image'];
                $_SESSION['function'] = $info_user['function'];
            }
        }

        public static function register($name, $email, $password, $image, $function){
            \Model\Model::uploadFile($image);
            $register_user = \MySql::connect()->prepare("INSERT INTO `users` VALUES (null, ?, ?, ?, ?, ?)");
            $register_user->execute(array($name, $email, $password, $image['name'], $function));
            $_SESSION['login'] = true;
            $_SESSION['user_id'] = uniqid();
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            $_SESSION['image'] = $image['name'];
            $_SESSION['function'] = $function;

            if($function == 'vendor'){
                header('Location: '.INCLUDE_PATH.'dashboard');
                die();
            }
        }

        
        public static function addCart($product_id, $user_id, $vendor_id, $quantity, $amount_frete, $date){
            $cart = \MySql::connect()->prepare("SELECT `amount_frete` FROM `cart` WHERE `user_id` = '$_SESSION[user_id]' AND `vendor_id` = '$vendor_id'");
            $cart->execute();
            if($cart->rowCount() == 1){
                $amount_frete = 0;
            }

            $add_cart = \MySql::connect()->prepare("INSERT INTO `cart` VALUES (null, ?, ?, ?, ?, ?, ?)");
            $add_cart->execute(array($product_id, $user_id, $vendor_id, $quantity, $amount_frete, $date));
        }

        public static function avaliation($product_id, $stars, $feedback){
            $avaliation = \MySql::connect()->prepare("INSERT INTO `ratings` VALUES (null, ?, ?, ?)");
            $avaliation->execute(array($product_id, $stars, $feedback));
        }


        public static function verifyPermission(){
            if($_SESSION['login'] == false AND $_GET['url'] !== $_GET['access']){
                \Model\Model::redirect('access');
            }
        }

        public static function optimizationCart(){
            $future = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d') + 30, date('Y')));
            
            $delete = \MySql::connect()->prepare("DELETE FROM `cart` WHERE created >= '$future'");
            $delete->execute();    
        }

        public static function formatSlug($slug){
            $slug = mb_strtolower($slug);
            $slug = preg_replace('/ã|á|â/', 'a', $slug);
            $slug = preg_replace('/é|è|ê/', 'e', $slug);
            $slug = preg_replace('/í|î|ì/', 'i', $slug);
            $slug = preg_replace('/ó|ô|õ|ò/', 'o', $slug);
            $slug = preg_replace('/ú|û|ù/', 'u', $slug);
            $slug = preg_replace('/ /', '-', $slug);
            return $slug;
        }

        public static function calculateFrete($service_code, $zip_code, $zip_destination, $weight, $height, $width, $length, $declared_value = 0){
            $service_code = strtoupper($service_code);
            if($service_code == 40215){
                $service_code = 40215; //sedex10
            }else if($service_code == 40045){
                $service_code = 40045; //sedexacobrar
            }else if($service_code == 40010){
                $service_code = 40010; //sedex
            }else if($service_code == 41106){
                $service_code = 41106; //pac
            }

            $correios = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem=".$zip_code."&sCepDestino=".$zip_destination."&nVlPeso=".$weight."&nCdFormato=1&nVlComprimento=".$length."&nVlAltura=".$height."&nVlLargura=".$width."&sCdMaoPropria=n&nVlValorDeclarado=".$declared_value."&sCdAvisoRecebimento=n&nCdServico=".$service_code."&nVlDiametro=0&StrRetorno=xml";
        
            $file_xml = simplexml_load_file($correios);

            $code['codigo'] = $file_xml->cServico->Codigo;
            $value['valor'] = $file_xml->cServico->Valor;
            $deadline['prazo'] = $file_xml->cServico->PrazoEntrega.' Dias para a entrega';

            $return_value = implode(',', $value);
            $return_deadline = implode(',', $deadline);
            $return_code = implode(',', $code);

            if(isset($_POST['cep'])){
                echo '<p class="description"><b>'.$service_code.'</b><br /> Cost of freight: '.$return_value.'.</p>';
                echo '<p class="description">Deadline: '.$return_deadline.' days.</p>';
            }

            return $return_value;
        }

        public static function applyCoupon($coupon, $shop_id){
            $coupon = \MySql::connect()->prepare("SELECT * FROM `coupons` WHERE `code` = '$coupon' AND `shop_id` = '$shop_id'");
            $coupon->execute();
            $coupon_discount = $coupon->fetch();
            if($coupon->rowCount() == 1){
                $_SESSION['coupon'] = $coupon_discount['code'];
                $_SESSION['coupon_value'] = $coupon_discount['discount'];
                $_SESSION['coupon_shop'] = $coupon_discount['shop_id'];
            }else{
                \Model\Model::alert('Coupon invalid');
            }
        }

        public static function feedback($shop_id, $product_id, $stars, $feedback){
            $create = \MySql::connect()->prepare("INSERT INTO `ratings` VALUES (null, ?, ?, ?, ?, ?)");
            $create->execute(array($shop_id, $_SESSION['user_id'], $product_id, $stars, $feedback));
        }

    }

?>