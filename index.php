<?php
    include('MySql.php');
    include('config.php');
    include('Controllers/Controller.php');
    include('Controllers/ControllerPayment.php');
    include('Models/Model.php');


    $controllerPayment = new ControllerPayment\pay;
    $controller = new Controller\Controller;
    $model = new Model\Model;

    $controller->index();
?>