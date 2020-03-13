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
            if ($user->save($_POST)){
                $_SESSION['errors'] = [];
                include('./views/users_list.php');
                die;
            }
            $_SESSION['errors'] = $user->errors;
            include('./views/users_register.php');
        }
    }


    if (in_array($action,$publicActions)){
        call_user_func($action);
    }else{
        call_user_func('login');;
    }






    /*switch ($action){
        case 'login':

            if (empty($_POST)) {
                $_SESSION['errors'] = [];
                header('Location: ../views/users_login.php');
            }else{
                if ($user->login($_POST)){
                    $_SESSION['errors'] = [];
                    $users = $user->findAll();
                    $_SESSION['users'] = $users;
                    header('Location: ../views/add_message.php');
                    die;
                }
                // put errors in $session
                $_SESSION['errors'] = $user->errors;
                header('Location: ../views/users_login.php');
            }
            break;

        case 'list':
            $_SESSION['errors'] = [];
            $users = $user->findAll();
            $_SESSION['users'] = $users;
            header('Location: ../views/users_list.php');
            break;

        case 'jsonlist':
            $users = $user->findAll();
            header("Access-Control-Allow-Origin: *");
            header('Content-type: application/json; charset=UTF-8');
            echo json_encode($users);
            break;

        case 'deco':
            $users = $user->deco();
            header('Location: ../views/users_login.php');
            break;

        case 'signon';

            if (empty($_POST)){
                $_SESSION['errors'] = [];
                header('Location: ../views/users_register.php');
            }else{
                if ($user->save($_POST)){
                    $_SESSION['errors'] = [];
                    header('Location: ../views/users_list.php');
                    die;
                }
                $_SESSION['errors'] = $user->errors;
                header('Location: ../views/users_register.php');
            }

            break;
        default:
            header('Location: ../views/users_login.php');
            break;
    }*/
} catch (Exception $e) {
    echo('cacaboudin exception');
    print_r($e);
}
?>