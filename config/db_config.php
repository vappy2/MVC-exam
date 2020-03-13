<?php
// connection base mysql
$db_config = [
    'host' => 'localhost', // machine, la machine locale s'appelle par convention "localhost"
    'schema' => 'projet', // nom du schema
    'port' => 8889, // 3306 est le port par defaut de mysql
    'user' => 'root', // nom d'utilisateur
    'password' => 'root', // mot de passe
    'charset' => 'utf8mb4', // le charset utilisé pour communiquer avec mysql via PDO
];