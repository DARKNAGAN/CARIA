<?php

// Connexion à la base de données
try
{
    $bdd = new PDO('mysql:host=nasccb:3307;dbname=CARIA', 'christian', 'fYUYWc5rSyC!',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
