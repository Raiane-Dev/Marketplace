<?php 
    include('../MySql.php');
    include('../Controllers/Controller.php');
    Controller\Controller::calculateFrete(40010, $_POST['vendor_single_cep'], $_POST['cep'], $_POST['weight'], $_POST['height'], $_POST['width'], $_POST['length'], 0); 
    Controller\Controller::calculateFrete(41106, $_POST['vendor_single_cep'], $_POST['cep'], $_POST['weight'], $_POST['height'], $_POST['width'], $_POST['length'], 0); 

    $user_cep = \MySql::connect()->prepare("SELECT * FROM `users` WHERE cep = '$_POST[cep]'");
    $user_cep->execute();
    $user_cep = $user_cep->fetch();
    if(!isset($user_cep)){
        $update = \MySql::connect()->prepare("UPDATE `users` SET cep = '$_POST[cep]' WHERE id = '$_SESSION[user_id]'");
        $update->execute();
    }
?>