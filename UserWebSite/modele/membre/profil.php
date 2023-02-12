<?php
function get_MemberInfo()
{
	global $bdd;
	$membre = isset($_GET['m'])?(int) $_GET['m']:'';
	//On récupère les infos du membre
	$req = $bdd->prepare('SELECT pseudo, imageclient, adressemail, dateenregistre, adresse, prenom, nom, age, permis FROM Client WHERE idclient=:membre');
	$req->bindValue(':membre',$membre, PDO::PARAM_INT);
	$req->execute();
	$data = $req->fetch();
	return $data;
}
function get_MemberInfoId()
{
	global $bdd;
	$id=(isset($_SESSION['idclient']))?(int) $_SESSION['idclient']:0;

	//On prend les infos du membre
	$req = $bdd->prepare('SELECT pseudo, imageclient, adressemail, adresse, prenom, nom, age, permis FROM Client WHERE idclient=:id');
	$req->bindValue(':id',$id,PDO::PARAM_INT);
	$req->execute();
	$data = $req->fetch();
	return $data;
}
function get_checkMail()
{
	global $bdd;
	$id=(isset($_SESSION['idclient']))?(int) $_SESSION['idclient']:0;
	//On commence donc par récupérer le mail
	$req = $bdd->prepare('SELECT adressemail FROM Client WHERE idclient =:id'); 
	$req->bindValue(':id',$id,PDO::PARAM_INT);
	$req->execute();
	$data = $req->fetch();
	return $data;
}
function get_Pseudo()
{
	global $bdd;
	$id=(isset($_SESSION['idclient']))?(int) $_SESSION['idclient']:0;
	//On commence donc par récupérer le pseudo
	$req = $bdd->prepare('SELECT pseudo FROM Client WHERE idclient =:id'); 
	$req->bindValue(':id',$id,PDO::PARAM_INT);
	$req->execute();
	$data = $req->fetch();
	return $data;
}
function get_checkCopyMail()
{
	global $bdd;
	$email = $_POST['email'];
	//Il faut que l'adresse email n'ait jamais été utilisée
	$req = $bdd->prepare('SELECT COUNT(*) AS nbr FROM Client WHERE adressemail =:mail');
	$req->bindValue(':mail',$email,PDO::PARAM_STR);
	$req->execute();
	$mail_free = ($req->fetchColumn()==0)?1:0;
	$req->CloseCursor();
	return $mail_free;
}
function post_UpdateAvatar($pseudo)
{
	global $bdd;
	$id=(isset($_SESSION['idclient']))?(int) $_SESSION['idclient']:0;
	$nomavatar=edit_avatar($_FILES['avatar'], $pseudo );
	$req = $bdd->prepare('UPDATE Client SET imageclient = :avatar WHERE idclient = :id');
	$req->bindValue(':avatar',$nomavatar,PDO::PARAM_STR);
	$req->bindValue(':id',$id,PDO::PARAM_INT);
	$req->execute();
	$req->CloseCursor();
}
function post_RemoveAvatar()
{
	global $bdd;
	$id=(isset($_SESSION['idclient']))?(int) $_SESSION['idclient']:0;
	$req = $bdd->prepare('UPDATE Client SET imageclient=0 WHERE idclient = :id');
	$req->bindValue(':id',$id,PDO::PARAM_INT);
	$req->execute();
	$req->CloseCursor();
}
function post_UpdateMember()
{
	global $bdd;
	$id=(isset($_SESSION['idclient']))?(int) $_SESSION['idclient']:0;
	$pass = /*md5*/($_POST['password']);
	$email = $_POST['email'];
	$localisation = $_POST['localisation'];
	$req = $bdd->prepare('UPDATE Client SET mdp = :mdp, adressemail=:mail, adresse=:loc WHERE idclient=:id');
	$req->bindValue(':mdp',$pass,PDO::PARAM_STR);
	$req->bindValue(':mail',$email,PDO::PARAM_STR);
	$req->bindValue(':loc',$localisation,PDO::PARAM_STR);
	$req->bindValue(':id',$id,PDO::PARAM_INT);
	$req->execute();
	$req->CloseCursor();
}