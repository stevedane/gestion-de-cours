<?php

include_once('config.php');

try{
    $bdd = new PDO('mysql:host='.DB_HOST.';dbname='.DB_DATABASE.';dbport='.DB_PORT, DB_USER, DB_PASSWORD);
}
catch(Exception $e){
    echo $e->getMessage();
}