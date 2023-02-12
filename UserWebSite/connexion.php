<?php
	include_once('./vue/header.html');
include_once('./modele/connexion_sql.php');

if (!isset($_GET['section']) OR $_GET['section'] == 'index')
{
    include_once('./controleur/membre/connexion/index.php');
}
	include_once('./vue/footer.html');	
