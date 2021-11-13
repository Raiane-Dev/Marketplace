<?php
    include('Controllers/ControllerDashboard.php');

    $controllerDashboard = new ControllerDashboard\ControllerDashboard;
    $controllerPayment = new ControllerPayment\pay;

    $controllerDashboard->index();



?>