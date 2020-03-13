<?php
require_once(__DIR__.'/../models/Message.class.php');
//demarrage session
session_start();

// try/catch pour lever les erreurs de connexion
try {

    // tableau d'erreurs initial, vide
    $errors = [];

    $action = isset($_GET['action']) ? $_GET['action'] : '';

    $message = new Message();


    function index(){
        $message = new Message();
        $_SESSION['errors'] = [];
        $messages = $message->findAll($_SESSION);
        $_SESSION['messages'] = $messages;
        include('./views/messages_list.php');
    }

    switch ($action){
        case 'add':
            if ($message->add($_POST)){
                index();
                die;
            }
            $_SESSION['errors'] = $messages->errors;
            include('./views/add_message.php');
            break;


        case 'jsonlist':
            $users = $user->findAll();
            header("Access-Control-Allow-Origin: *");
            header('Content-type: application/json; charset=UTF-8');
            echo json_encode($messages);
            break;


         default;
            index();
            break;
    }
} catch (Exception $e) {
    echo('cacaboudin exception');
    print_r($e);
}
?>