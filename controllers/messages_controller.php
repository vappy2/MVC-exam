<?php
require_once(__DIR__.'/../models/Message.class.php');
require_once(__DIR__.'/../models/Group.class.php');
//demarrage session
session_start();

// try/catch pour lever les erreurs de connexion
try {

    // tableau d'erreurs initial, vide
    $errors = [];

    //$action = isset($_GET['action']) ? $_GET['action'] : '';

    //$message = new Message();


    $publicActions = [
        'index',
        'add',
        'jsonlist',
        'deleted'
    ];


    function index(){
        $message = new Message();
        $_SESSION['errors'] = [];
        $messages = $message->findAll($_SESSION);
        $_SESSION['messages'] = $messages;
        include('./views/messages_list.php');
    }

    function add(){
        $message = new Message();
        $group = new Group();
        if ($message->add($_POST)){
            index();
            die;
        }
        $groups = $group->findId();
        $_SESSION['user_group'] = $groups;
        include('./views/message_add.php');
    }

    function jsonlist(){
        $message = new Message();
        $messages = $message->findAll();
        header("Access-Control-Allow-Origin: *");
        header('Content-type: application/json; charset=UTF-8');
        echo json_encode($messages);
    }

    function deleted(){
        $message = new Message();
        if ($message->deleted($_POST)){
            $_SESSION['errors'] = [];
            index();
            die;
        }
        $_SESSION['errors'] = $message->errors;
        index();
    }


    if (in_array($action,$publicActions)){
        call_user_func($action);
    }else{
        call_user_func('index');;
    }

} catch (Exception $e) {
    echo('cacaboudin exception');
    print_r($e);
}
?>