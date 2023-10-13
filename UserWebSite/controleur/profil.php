<?php
include_once('./modele/profil.php');
$titre="Profil";
//On récupère la valeur de nos variables passées par URL
$action = isset($_GET['action'])?htmlspecialchars($_GET['action']):'consulter';
$membre = isset($_GET['m'])?(int) $_GET['m']:'';
switch($action)
{
	case "consulter":
		//On affiche les infos sur le membre
		$data = get_MemberInfo();
		include_once('./vue/profile_view.html');
	break;
	case "modifier":
		if (empty($_POST['sent'])) // Si on la variable est vide, on peut considérer qu'on est sur la page de formulaire
		{
			//On commence par s'assurer que le membre est connecté
			//if ($id==0) erreur(ERR_IS_NOT_CO);
			//Les infos du membre
			$data = get_MemberInfoId();
			include_once('./vue/edit_profile_view.html');			
		}
		else //Sinon on est dans la page de traitement
		{
			 //On déclare les variables
			$mdp_erreur = NULL;
			$email_erreur1 = NULL;
			$avatar_erreur3 = NULL;
			//Encore et toujours notre belle variable $i :p
			$i = 0;
			$temps = time(); 
			$email = $_POST['email'];
			$localisation = $_POST['localisation'];
			$pass = /*md5*/($_POST['password']);
			$confirm = /*md5*/($_POST['confirm']);
			$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
			//Vérification des champs du formulaire
			if ($pass != $confirm || empty($confirm) || empty($pass))
			{
				 $mdp_erreur = "Votre mot de passe et votre confirmation sont different ou sont vides";
				 $i++;
			}
			$data = get_checkMail();
			if (strtolower($data['adressemail']) != strtolower($email))
			{
				$mail_free = get_checkCopyMail();
				if(!$mail_free)
				{
					$email_erreur1 = "Votre adresse email est déjà utilisé par un membre";
					$i++;
				}
			}
			$data = get_Pseudo();
			$extension_upload = strtolower(substr(  strrchr($_FILES['avatar']['name'], '.')  ,1));
			if (!in_array($extension_upload,$extensions_valides) )
			{
				$i++;
				$avatar_erreur3 = "Extension de l'avatar incorrecte";
			}
			if ($i == 0) // Si $i est vide, il n'y a pas d'erreur sur l'avatar
			{
				if (!empty($_FILES['avatar']['size']))
				{
					post_UpdateAvatar($data['pseudo']);
				}
				if (isset($_POST['delete']))
				{
					post_RemoveAvatar();
				}
				?>
				
				<div class="container-fluid">
					<section id="content" class="page-content">
						<div class="container text-center">
							<h2>Modification de profil terminée</h2><br>
							<p>Votre profil a été modifié avec succès !</p>
							<p>Cliquez <a href="./profil.php?action=modifier">ici</a> 
							pour revenir à ton profil</p>
						</div>
					</section>
				</div>
				<?php
				//On modifie la table
				post_UpdateMember();
			}
			else
			{
				?>
				
				<div class="container-fluid">
					<section id="content" class="page-content">
						<div class="container text-center">
							<h2>Modification de profil interrompue</h2><br>
							<h5><?php echo $i; ?> erreurs se sont produites lors de votre modification</h5>
							<ul>
								<?php 
								echo'<p>' .$email_erreur1. '' .$email_erreur2. '</p>
								<p>' .$avatar_erreur. '' .$avatar_erreur1. '</p>
								<p>' .$avatar_erreur2. '' .$avatar_erreur3. '</p>
								<p>' .$mdp_erreur. '</p>';
								?>
							</ul>
							<p> Cliquez <a href="./profil.php?action=modifier">ici</a> pour recommencer</p>
						</div>
					</section>
				</div>
				<?php
			}
		}
	break;
	default; //Si jamais c'est aucun de ceux là c'est qu'il y a eu un problème :o
		echo'<p>Cette action est impossible</p>';
}