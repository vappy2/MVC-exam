<?php

    $action = isset($_GET['action']) ? $_GET['action'] : '';
    $controller = isset($_GET['controller']) ? $_GET['controller'] : '';


    if(file_exists(__DIR__.'/controllers/'.$controller.'_controller.php')){
        include ('controllers/'.$controller.'_controller.php');
    }else {
        include('controllers/users_controller.php');
    }
