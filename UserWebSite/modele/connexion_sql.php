<?php

// Connexion � la base de donn�es
try
{
    $bdd = new PDO('mysql:host=localhost:3307;dbname=CARIA', 'USER', 'MDP',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
