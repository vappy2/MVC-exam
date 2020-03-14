<?php
require_once(__DIR__.'/../models/Group.class.php');

//On démarre la session
session_start();

//Try/Catch pour gérer les erreurs de connexion
try{

    //Si  action n'existe pas alors on l'a crée en l'initialisant à vide
    //$action = isset($_GET['action']) ? $_GET['action'] : '';

    //Case modification d'un groupe
    function update(){
        $group = new Group();

        if(empty($_POST)){
            $_SESSION['errors'] = [];
            include('./views/groups_edit.php');
        }else{
            // Si ton model group se sauvegarde dans la base de donnée, alors tu vides ton tableau d'erreurs et tu affiches la liste des groups
            if ($group->update($_POST)){
                $_SESSION['errors'] = [];
                include('./views/groups_list.php');
                die;
            } // Par défaut, on affiche le message d'erreur et on rediriges vers la page add_groups
            $_SESSION['errors'] = $group->errors;
            include('./views/groups_edit.php');
        }
    }

    //Case création de groupe
    function add()
    {
        //On créé un nouveau group
        $group = new Group();
        //Si $_POST est vide alors on vide notre tableau d'erreur et redirige vers la même page
        if (empty($_POST)) {
            $_SESSION['errors'] = [];
            include('./views/groups_add.php');
        } else {
            if ($group->add($_POST)) {
                $_SESSION['errors'] = [];
                $groups = $group->findAll();
                $_SESSION['groups'] = $groups;
                include('./views/groups_add.php');
                die;
            }
            $_SESSION['errors'] = $group->errors;
            include('./views/groups_add.php');
        }
    }

    function liste(){
        //On instancie notre nouvel utilisateur
        $group = new Group();

        //On vide la tableau des erreurs et on affiche la liste des messages de la personne log sur la view message_list
        $_SESSION['errors'] = [];
        $groups = $group->findAll();
        $_SESSION['groups'] = $groups;
        include('./views/groups_list.php');
    }

    $availableActions = [
        'add',
        'update',
        'liste'
    ];

    //Si l'action ($action) existe dans le tableau, alors tu exe la fonction qui a la même nom
    if(in_array($action, $availableActions))
    {
        call_user_func($action);
    }else{
        call_user_func("liste");
    }

}catch (Exception $e) {
        echo('Erreur de connexion à la base de données');
        print_r($e);
    }
    ?>
