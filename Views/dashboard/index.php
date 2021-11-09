<?php
    include('Controllers/ControllerDashboard.php');
    include('Models/ModelDashboard.php');

    $controllerDashboard = new ControllerDashboard\ControllerDashboard;
    $controllerPayment = new ControllerPayment\pay;
    $modelDashboard = new ModelDashboard\ModelDashboard;


    $controllerDashboard->index();



?>