<?php
function get_checkPseudo()
{
	global $bdd;
	$pseudo=$_POST['pseudo'];
	$req = $bdd->prepare('SELECT COUNT(*) AS nbr FROM Client WHERE pseudo =:pseudo');
	$req->bindValue(':pseudo',$pseudo, PDO::PARAM_STR);
	$req->execute();
	$pseudo_free=($req->fetchColumn()==0)?1:0;
	$req->CloseCursor();
	return $pseudo_free;
}
function get_checkMail()
{
	global $bdd;
	$email = $_POST['email'];
	$req = $bdd->prepare('SELECT COUNT(*) AS nbr FROM Client WHERE adressemail =:mail');
	$req->bindValue(':mail',$email, PDO::PARAM_STR);
	$req->execute();
	$mail_free=($req->fetchColumn()==0)?1:0;
	$req->CloseCursor();
	return $mail_free;
}
function post_Registre()
{
	global $bdd;
	$pseudo=$_POST['pseudo'];
	$pass = /*md5*/($_POST['password']);
	$email = $_POST['email'];
	$nomavatar=(!empty($_FILES['avatar']['size']))?move_avatar($_FILES['avatar']):'';
	$localisation = $_POST['localisation'];
	$req = $bdd->prepare('INSERT INTO Client (pseudo, mdp, adressemail, imageclient, adresse, dateenregistre)
						VALUES (:pseudo, :pass, :email, :nomavatar, :localisation, NOW())');
	$req->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
	$req->bindValue(':pass', $pass, PDO::PARAM_INT);
	$req->bindValue(':email', $email, PDO::PARAM_STR);
	$req->bindValue(':nomavatar', $nomavatar, PDO::PARAM_STR);
	$req->bindValue(':localisation', $localisation, PDO::PARAM_STR);
	$req->execute();
}