<?php
    session_start();
    
    define('INCLUDE_PATH','http://localhost/Marketplace/');
    define('INCLUDE_PATH_DASHBOARD','http://localhost/Curso/Projeto/Marketplace/Views/dashboard/');
    define('INCLUDE_PATH_DASHBOARD_URL','http://localhost/Curso/Projeto/Marketplace/dashboard/');
    define('BASE_DIR',__DIR__.'/assets\/');

    if(!isset($_SESSION['user_id'])){
        $_SESSION['user_id'] = uniqid();
    }

?>
