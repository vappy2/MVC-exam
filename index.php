<?php

    $action = isset($_GET['action']) ? $_GET['action'] : '';
    $controller = isset($_GET['controller']) ? $_GET['controller'] : '';


/*    echo $controller;
    echo '----';
    echo $action;

    if ($controller == 'user'){
        include ('controllers/users_controller.php');
    }else if($controller == "messages"){
        include ("controllers/messages_controller.php");
    }else {
        header('Location: ./controllers/users_controller.php');
    }*/


    if(file_exists(__DIR__.'/controllers/'.$controller.'_controller.php')){
        include ('controllers/'.$controller.'_controller.php');
    }else {
        include('controllers/users_controller.php');
    }
