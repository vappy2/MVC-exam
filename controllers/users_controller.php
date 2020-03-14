<?php
require_once(__DIR__.'/../models/User.class.php');
//demarrage session
session_start();

// try/catch pour lever les erreurs de connexion
try {

/*   $action = isset($_GET['action']) ? $_GET['action'] : '';*/


    $publicActions = [
        'login',
        'signon',
        'jsonlist',
        'liste',
        'edit',
        'deco'
    ];

   /* $protectedActions = [
        'index',
        'liste'
    ];*/


    function login(){
        $user = new User();
        if (empty($_POST)) {
            $_SESSION['errors'] = [];
            include('./views/users_login.php');
        }else{
            if ($user->login($_POST)){
                $_SESSION['errors'] = [];
                $users = $user->findAll();
                $_SESSION['users'] = $users;
                include('./views/message_add.php');
                die;
            }
            // put errors in $session
            $_SESSION['errors'] = $user->errors;
            include('./views/users_login.php');
        }
    }

    function liste(){
        $user = new User();
        $_SESSION['errors'] = [];
        $users = $user->findAll();
        $_SESSION['users'] = $users;
        include('./views/users_list.php');
    }

    function jsonlist(){
        $user = new User();
        $users = $user->findAll();
        header("Access-Control-Allow-Origin: *");
        header('Content-type: application/json; charset=UTF-8');
        echo json_encode($users);
    }

    function deco(){
        $user = new User();
        $users = $user->deco();
        include('./views/users_login.php');
    }

    function signon(){
        $user = new User();
        if (empty($_POST)){
            $_SESSION['errors'] = [];
            include('./views/users_register.php');
        }else{

            $user->upload();

            if ($user->save($_POST)){
                $_SESSION['errors'] = [];
                include('./views/users_list.php');
                die;
            }
            $_SESSION['errors'] = $user->errors;
            include('./views/users_register.php');
        }
    }

    function edit(){
        $user = new User();
        if (empty($_POST)){
            $_SESSION['errors'] = [];
            include('./views/users_edit.php');
        }else{

            $user->upload();

            if ($user->edit($_POST)){
                $_SESSION['errors'] = [];
                header('Location:./index.php?controller=users&action=liste');
                die;
            }
            $_SESSION['errors'] = $user->errors;
            include('./views/users_edit.php');
        }
    }


    if (in_array($action,$publicActions)){
        call_user_func($action);
    }else{
        call_user_func('login');;
    }


} catch (Exception $e) {
    echo('cacaboudin exception');
    print_r($e);
}
?>