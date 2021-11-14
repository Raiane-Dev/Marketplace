<?php
    namespace ControllerDashboard;
    
    class ControllerDashboard{
        public function index(){
            @$url = isset($_GET['url']) ? $_GET['url'] : 'dashboard';
            @$slug = explode('/',$url);

            if(!isset($_SESSION['login'])){
                include('views/dashboard/pages/access.php');
            }else{

            if(file_exists('views/dashboard/pages/'.$slug[0].'.php')){
                include('views/dashboard/pages/templates/header.php');

                if(file_exists('views/dashboard/pages/'.$slug[1].'.php')){
                    include('views/dashboard/pages/'.$slug[1].'.php');
                }else{
                    include('views/dashboard/pages/'.$slug[0].'.php');
                }
                include('views/dashboard/pages/templates/footer.php');
            }
        }}


        public static function register($name, $email, $password, $image, $function, $cep, $lat_coord, $long_coord){
            \Model\Model::uploadFile($image);
            $register = \MySql::connect()->prepare("INSERT INTO `users` VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?)");
            $register->execute(array($name, $email, $password, $image['name'], $function, $cep, $lat_coord, $long_coord));

            $verify = \MySql::connect()->prepare("SELECT * FROM `users` WHERE `email` = ? AND `password` = ?");
            $verify->execute(array($email,$password));
            $info = $verify->fetch();
            if($verify->rowCount() == 1){
                $_SESSION['login'] = true;
                $_SESSION['user_id'] = $info['id'];
                $_SESSION['name'] = $info['name'];
                $_SESSION['email'] = $info['email'];
                $_SESSION['password'] = $info['password'];
                $_SESSION['image'] = $info['image'];
                $_SESSION['function'] = $info['function'];
                $_SESSION['cep'] = $info['cep'];
                $_SESSION['lat_coord'] = $info['lat_coord'];
                $_SESSION['long_coor'] = $info['long_coord'];
            }
            $register_shop = \MySql::connect()->prepare("INSERT INTO `shop` VALUES (null, ?, ?, ?, ?, ?)");
            $register_shop->execute(array($_SESSION['user_id'], '', '', '', ''));
        }

        public static function login($email, $password){
            $verify = \MySql::connect()->prepare("SELECT * FROM `users` WHERE `email` = ? AND `password` = ?");
            $verify->execute(array($email,$password));
            $info = $verify->fetch();
            if($verify->rowCount() == 1){
                $_SESSION['login'] = true;
                $_SESSION['user_id'] = $info['id'];
                $_SESSION['name'] = $info['name'];
                $_SESSION['email'] = $info['email'];
                $_SESSION['password'] = $info['password'];
                $_SESSION['image'] = $info['image'];
                $_SESSION['function'] = $info['function'];
                $_SESSION['cep'] = $info['cep'];
                $_SESSION['lat_coord'] = $info['lat_coord'];
                $_SESSION['long_coor'] = $info['long_coord'];

                \Model\Model::redirect('dashboard/');
            }else{
                \Model\Model::alert('Senha ou email incorretas.');
            }
        }

        public static function updateUser($name, $email, $image){
            if($image !== ''){
                $update_user = \MySql::connect()->prepare("UPDATE `users` SET `image` = ? WHERE `id` = '$_SESSION[user_id]'");
                $update_user->execute(array($image['name']));
                \Model\Model::uploadFile($image);
            }
            $update = \MySql::connect()->prepare("UPDATE `users` SET `name` = ?, `email` = ? WHERE id = '$_SESSION[user_id]'");
            $update->execute(array($name, $email));
        }

        public static function settings($name, $description, $image){
            $shop = \MySql::connect()->prepare("SELECT * FROM `shop` WHERE `vendor_id` = '$_SESSION[user_id]'");
            $shop->execute();
            $verify = $shop->fetch();
            if($shop->rowCount() == 1){
                // UPDATE
                if($image !== ''){
                    $update_shop = \MySql::connect()->prepare("UPDATE `shop` SET `image` = ? WHERE `vendor_id` = '$_SESSION[user_id]'");
                    $update_shop->execute(array($image['name']));
                    \Model\Model::uploadFile($image);
                }
                $update_shop = \MySql::connect()->prepare("UPDATE `shop` SET `name` = ?, `description` = ?,`slug` = ? WHERE `vendor_id` = '$_SESSION[user_id]'");
                $update_shop->execute(array($name, $description, \Controller\Controller::formatSlug($name)));
                \Model\Model::alert("Successfully Updated");
            }else{
                // REGISTER
                $register_shop = \MySql::connect()->prepare("INSERT INTO `shop` VALUES (null, ?, ?, ?, ?, ?)");
                $register_shop->execute(array($_SESSION['user_id'], $name, $description, $image['name'], \Controller\Controller::formatSlug($name)));
            }
        }

        public static function updateLocation($lat_coord, $long_coord, $cep){
            $update = \MySql::connect()->prepare("UPDATE `users` SET `lat_coord` = ?, `long_coord` = ?, `cep` = ? WHERE `id` = '$_SESSION[user_id]'");
            $update->execute(array($lat_coord, $long_coord, $cep));
        }
        
        public static function storePolicies($privacy_policy, $shipping_policy, $refund_policy,$shop_id){
            $update = \MySql::connect()->prepare("INSERT INTO `shop_policies` VALUES (null, ?, ?, ?, ?)");
            $update->execute(array($shop_id, $privacy_policy, $shipping_policy, $refund_policy));
        }

        public static function schedulesConfig($open_since, $close_until, $days_week, $shop_id){
            $update = \MySql::connect()->prepare("INSERT INTO `shop_schedules` VALUES (null, ?, ?, ?, ?)");
            $update->execute(array($shop_id, $open_since, $close_until, $days_week));
        }

        public static function createCoupons($shop_id, $code, $discount, $duration){
            $create = \MySql::connect()->prepare("INSERT INTO `coupons` VALUES (null, ?, ?, ?, ?, ?)");
            $create->execute(array($shop_id, $code, $discount, $duration, date('Y-m-d')));
        }

        public static function couponsDuration(){
            $duration = \MySql::connect()->prepare("DELETE FROM `coupons` WHERE duration <= ?");
            $duration->execute(array(date('Y-m-d')));

            return $duration;
        }

        public static function token($token){
            $update = \MySql::connect()->prepare("UPDATE `info_payment` SET `token` = ? WHERE `vendor_id` = '$_SESSION[user_id]'");
            $update->execute(array($token));
        }

        public static function updatePass($password, $password_verify){
            $user_verify = \MySql::connect()->prepare("SELECT * FROM `users` WHERE `email` = '$_SESSION[email]' AND `password` = '$password_verify'");
            $user_verify->execute();
            if($user_verify->rowCount() == 1){
                $user = \MySql::connect()->prepare("UPDATE `users` SET `password` = ? WHERE id = '$_SESSION[user_id]'");
                $user->execute(array($password));
            }else{
                \Model\Model::alert('Incorrect password.');
            }
        }

        public static function deleteShop($shop_id){
            $delete = \MySql::connect()->prepare("DELETE FROM `shop` WHERE id = '$shop_id'");
        }

        public static function showroom($shop_id, $name, $image){
            \Model\Model::uploadFile($image);
            $register = \MySql::connect()->prepare("INSERT INTO `showroom` VALUES (null, ?, ?, ?)");
            $register->execute(array($shop_id, $name, $image['name']));
        }


        public static function createProduct($shop_id, $category_id, $name, $description, $price, $images, $stock, $colors, $weight, $width, $height, $length){
            $create = \MySql::connect()->prepare("INSERT INTO `products` VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $create->execute(array($shop_id, $category_id, $name, $description, $price, $images, $stock, $colors, $weight, $width, $height, $length));            
            \Model\Model::uploadFile($images);
            \Model\Model::alert("Product registered successfully.");
        }


        public static function countRatings($star){
            $shop = \MySql::connect()->prepare("SELECT * FROM `shop` WHERE `vendor_id` = '$_SESSION[user_id]'");
            $shop->execute();
            $shop = $shop->fetch();

            $ratings = \MySql::connect()->prepare("SELECT * FROM `ratings` WHERE stars = '$star' AND `shop_id` = '$shop[id]'");
            $ratings->execute();
            $ratings = $ratings->fetchAll();

            return $ratings;
        }

        public static function countTotal(){
            $calcOne = (5*count(self::countRatings(5)) + 4*count(self::countRatings(4)) + 3*count(self::countRatings(3)) + 2*count(self::countRatings(2)) + 1*count(self::countRatings(1)));
            $calcTwo = (count(self::countRatings(5)) + count(self::countRatings(4)) + count(self::countRatings(3)) + count(self::countRatings(2)) + count(self::countRatings(1)));

            if($calcOne == 0 || $calcTwo == 0){
                $calcOne = $calcTwo = 1;
            }
            $result = intdiv($calcOne, $calcTwo);
            return $result;
        }
    }

?>
