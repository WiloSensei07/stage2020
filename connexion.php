<?php
    //parametres de connexion
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'stage2020');
    define('DB_USER', 'rose');
    define('DB_PWD', 'rose');

    try{
        $db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PWD);
    }catch(PDOException $e){
        die('ERROR: '.$e->getessage());
    }
?>