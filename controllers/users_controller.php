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
                include('./views/add_message.php');
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

            if (isset($_FILES['photo']) && !empty($_FILES['photo']['name'])) {
                $tmp_name = $_FILES['photo']['tmp_name'];
                $current_dir = realpath(dirname(__FILE__));
                $final_name = $current_dir . '/../uploads/' . $_FILES['photo']['name'];
                if (move_uploaded_file($tmp_name, $final_name)) {
                    echo('<hr/>fichier uploadé TMTC<hr/>');
                }
            }

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
            if ($user->edit($_POST)){
                $_SESSION['errors'] = [];
                include('./views/users_list.php');
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