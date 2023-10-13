<?php
include_once('./modele/home.php');
$titre = "Index du forum";
//Initialisation de deux variables
$totaldesmessages = 0;
$categorie = NULL;
$TotalDesMembres = get_MemberCount();
$TotalDesVoitures = get_VoitureCount();
$data = get_LastMember();
$derniermembre = stripslashes(htmlspecialchars($data['pseudo']));

include_once('./vue/home.html');