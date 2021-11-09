<?php
    namespace Model;

    class Model{
        public static function get($table){
            $get = \MySql::connect()->prepare("SELECT * FROM `$table`");
            $get->execute();
            $get = $get->fetchAll();
            return $get;
        }

        public static function getWhere($table, $where){
            $getWhere = \MySql::connect()->prepare("SELECT * FROM `$table` $where");
            $getWhere->execute();
            $getWhere = $getWhere->fetchAll();
            return $getWhere;
        }


        public static function getOne($table, $where){
            $getOne = \MySql::connect()->prepare("SELECT * FROM `$table` $where");
            $getOne->execute();
            $getOne = $getOne->fetch();
            return $getOne;
        }


        public static function rating($star){
            $rating = \MySql::connect()->prepare("SELECT `stars` FROM `ratings` WHERE stars = $star AND id = $_GET[id]");
            $rating->execute();
            $rating = $rating->fetchAll();
            
            return $rating;
        }

        public static function countRating(){
            $calcOne = (5*count(self::rating(5)) + 4*count(self::rating(4)) + 3*count(self::rating(3)) + 2*count(self::rating(2)) + 1*count(self::rating(1)));
            $calcTwo = (count(self::rating(5)) + count(self::rating(4)) + count(self::rating(3)) + count(self::rating(2)) + count(self::rating(1)));

            if($calcOne === 0 || $calcTwo === 0){
                $calcOne = $calcTwo = 1;
            }
            $calcResult = intdiv($calcOne, $calcTwo);

            return $calcResult;
        }

        public static function uploadFile($file){
            if(!isset($verify_file[1])){
                return;
            }
            $verify_file = explode('.', $file['name']);
            if($verify_file[1] === 'png' || $verify_file[1] === 'jpg' || $verify_file[1] === 'jpeg'){
                move_uploaded_file($file['tmp_name'], BASE_DIR.$file['name']);
            }else{
                echo '<script> alert("File not supported."); </script>';
            }
        }

        public static function redirect($page){
            echo '<script> window.location.href = '.INCLUDE_PATH.$page.'; </script>';
        }

        public function addCart($idProduct){
            $add = \MySql::connect()->prepare("INSERT INTO `cart` VALUES (null, ?, ?, ?, ?)");
            $add->execute(array($idProduct, $_SESSION['user_id'], $_POST['quantity'], date('Y-m-d')));

            return $add;
        }

        public static function alert($message){
            echo '<script> alert("'.$message.'"); </script>';
        }

    }

?>