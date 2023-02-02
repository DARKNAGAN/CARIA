<?php

// Connexion à la base de données
try
{
    $bdd = new PDO('mysql:host=localhost:3307;dbname=CARIA', 'USER', 'MDP',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
