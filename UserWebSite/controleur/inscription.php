<?php
include_once('./modele/inscription.php');

$titre="Enregistrement";
if (empty($_POST['pseudo'])) // Si on la variable est vide, on peut considérer qu'on est sur la page de formulaire
{
	include_once('./vue/inscription.html');
}
else //On est dans le cas traitement
	{
	$pseudo_erreur1 = NULL;$pseudo_erreur2 = NULL;
	$email_erreur1 = NULL;
	$mdp_erreur = NULL;
	$avatar_erreur3 = NULL;
	//On récupère les variables
	$i = 0;
	$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
	$pseudo=$_POST['pseudo'];
	$email = $_POST['email'];
	$localisation = $_POST['localisation'];
	$prenom = $_POST['prenom'];
	$nom = $_POST['nom'];
	$pass = /*md5*/($_POST['password']);
	$confirm = /*md5*/($_POST['confirm']);
	//Verification des champs formulaire
	$pseudo_free = get_checkPseudo();
	if(!$pseudo_free)
	{
		$pseudo_erreur1 = "Votre pseudo est déjà utilisé par un membre";
		$i++;
	}
	if (strlen($pseudo) < 3 || strlen($pseudo) > 15)
	{
		$pseudo_erreur2 = "Votre pseudo est soit trop grand, soit trop petit";
		$i++;
	}
	if ($pass != $confirm || empty($confirm) || empty($pass))
	{
		$mdp_erreur = "Votre mot de passe et la confirmation sont diffèrent, ou sont vides";
		$i++;
	}
	$mail_free = get_checkMail();
	if(!$mail_free)
	{
		$email_erreur1 = "Votre adresse email est déjà utilisée par un membre";
		$i++;
	}
	$extension_upload = strtolower(substr(  strrchr($_FILES['avatar']['name'], '.')  ,1));
	if (!in_array($extension_upload,$extensions_valides) )
	{
		$avatar_erreur3 = "Extension de l'avatar incorrecte";
		$i++;
	}
	if ($i==0)
	{
		?>
		<div class="text-center">
		<h2>Inscription terminée</h2>
		<p>Bienvenue <?php echo stripslashes(htmlspecialchars($_POST['pseudo'])); ?> vous êtes maintenant inscrit sur le forum!</p>
		<p>Cliquez <a href="./index.php">ici</a> pour revenir à l'acceuil</p>
		</div>
		<?php
		echo '<!-- This is a debug message! -->';
		post_Registre();
		//Et on définit les variables de sessions
		$_SESSION['pseudo'] = $pseudo;
		$_SESSION['idclient'] = $bdd->lastInsertId();
		$_SESSION['privilege'] = 2;
	}
	else
	{
		?>
		<div class="text-center"><h2>Inscription interrompue</h2><br>
		<h5><?php echo $i; ?> erreurs se sont produites lors de votre incription</h5><br>
			<ul>
				<p><?php echo $email_erreur1; ?></p>
				<p><?php echo $pseudo_erreur1; $pseudo_erreur2; ?></p>
				<p><?php echo $mdp_erreur; ?></p>
				<p><?php echo $avatar_erreur3; ?></p>
			</ul><br>
		<p>Cliquez <a href="./inscription.php">ici</a> pour recommencer</p>
		</div>
		<?php
	}
}