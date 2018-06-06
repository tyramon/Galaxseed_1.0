<?php

try {
    $connexion = new PDO ('mysql:host=localhost;dbname=nains;charset=utf8','root','');
    array
    (
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8 COLLATE utf8_general_ci'
    );
}
catch (PDOException $e)
{
    die(utf8_encode($e->getMessage()));
}