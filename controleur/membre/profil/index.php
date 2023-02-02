<?php
include_once('./modele/membre/profil.php');
$titre="Profil";
//On récupère la valeur de nos variables passées par URL
$action = isset($_GET['action'])?htmlspecialchars($_GET['action']):'consulter';
$membre = isset($_GET['m'])?(int) $_GET['m']:'';
switch($action)
{
	case "consulter":
		//On affiche les infos sur le membre
		$data = get_MemberInfo();
		?>
		
		<div class="container-fluid">
			<section id="content" class="page-content">
				<div class="container text-center">
					<h2>Profil de <?php echo stripslashes(htmlspecialchars($data['pseudo'])); ?></h2><br>
						<img src=".<?php echo $data['imageclient']; ?>" alt="Acun avatar" /><br>
						<p class="text-2" ><strong>Adresse E-Mail : </strong>
							<a class=link2 href="mailto:<?php echo stripslashes($data['adressemail']); ?>"> <?php echo stripslashes(htmlspecialchars($data['adressemail'])); ?></a><br/><br>
							Ce membre est inscrit depuis le <strong><?php echo date('d-m-Y', strtotime(str_replace('/','-',$data['dateenregistre']))); ?></strong><br/><br/>
							<strong>Localisation : </strong> <?php echo stripslashes(htmlspecialchars($data['adresse'])); ?>
						</p>
					</div>
			</section>
		</div>
		<?php
	break;
	case "modifier":
		if (empty($_POST['sent'])) // Si on la variable est vide, on peut considérer qu'on est sur la page de formulaire
		{
			//On commence par s'assurer que le membre est connecté
			//if ($id==0) erreur(ERR_IS_NOT_CO);
			//Les infos du membre
			$data = get_MemberInfoId();
			?>
		
		<div class="container-fluid">
			<section id="content" class="page-content">
				<div class="container text-center">
					<form method="post" action="profil.php?action=modifier" enctype="multipart/form-data">
					   <h2>Edition du profil de <?php echo stripslashes(htmlspecialchars($data['pseudo']));?></h2><br>
							<fieldset>
								<label class="labelI" for="password">*Mot de passe<br>Nouveau mot de passe</label><br>
									<input type="password" name="password" id="password" /><br>
								<label class="labelI" for="confirm">*Confirmation du mot de passe</label><br>
									<input type="password" name="confirm" id="confirm"  /><br>
							</fieldset><br>
					 
							<fieldset><legend class=colorbold marg3 pad1>Contacts</legend>
								<label class="labelI" for="email">Adresse email</label><br>
									<input type="text" name="email" id="email" value="<?php echo stripslashes($data['adressemail']); ?>" /><br>
							</fieldset><br>
							<fieldset><legend class=colorbold marg3 pad1>Informations supplémentaires</legend>
								<label class="labelI" for="localisation">Localisation</label><br>
									<input type="text" name="localisation" id="localisation" value="<?php echo stripslashes($data['adresse']); ?>" />
							</fieldset><br>
							<fieldset><legend class=colorbold marg3 pad1>Profil sur le forum</legend>
								Avatar actuel <img src=".<?php echo $data['imageclient'];?>" alt="pas d avatar" /><br><br>
								<label class="labelI" for="avatar">Changer mon avatar</label><br>
									<input type="file" name="avatar" id="avatar" /><br>(Taille max : 200Ko)<br><br>
								<label><input type="checkbox" name="delete" value="Delete" /> Supprimer mon avatar</label>
							</fieldset><br>
						<p>
							<input type="submit" value="Modifier mon profil" class="button-3"/><br>
							<input  type="hidden"  id="sent" name="sent" value="1" />
						</p><br>
						<p>Les champs avec une * sont obligatoires</p><br>
					</form>
				</div>
			</section>
		</div>
		<?php
		}
		else //Sinon on est dans la page de traitement
		{
			 //On déclare les variables
			$mdp_erreur = NULL;
			$email_erreur1 = NULL;
			$email_erreur2 = NULL;
			$avatar_erreur = NULL;
			$avatar_erreur1 = NULL;
			$avatar_erreur2 = NULL;
			$avatar_erreur3 = NULL;
			//Encore et toujours notre belle variable $i :p
			$i = 0;
			$temps = time(); 
			$email = $_POST['email'];
			$localisation = $_POST['localisation'];
			$pass = /*md5*/($_POST['password']);
			$confirm = /*md5*/($_POST['confirm']);
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
				if (!preg_match("#^[a-z0-9A-Z._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email) || empty($email))
				{
					$email_erreur2 = "Votre nouvelle adresse E-Mail n'a pas un format valide";
					$i++;
				}
			}
			if (!empty($_FILES['avatar']['size']))
			{
				$maxsize = 200024; //Poid de l'image
				$maxwidth = 1000; //Largeur de l'image
				$maxheight = 1000; //Longueur de l'image
				//Liste des extensions valides
				$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png', 'bmp' );
				if ($_FILES['avatar']['error'] > 0)
				{
					$avatar_erreur = "Erreur lors du tranfsert de l'avatar : ";
				}
				if ($_FILES['avatar']['size'] > $maxsize)
				{
					$i++;
					$avatar_erreur1 = "Le fichier est trop gros :
					(<strong>".$_FILES['avatar']['size']." Octets</strong>
					contre <strong>".$maxsize." Octets</strong>)";
				}
				
				$image_sizes = getimagesize($_FILES['avatar']['tmp_name']);
				if ($image_sizes[0] > $maxwidth OR $image_sizes[1] > $maxheight)
				{
					$i++;
					$avatar_erreur2 = "Image trop large ou trop longue :
					(<strong>".$image_sizes[0]."x".$image_sizes[1]."</strong> contre
					<strong>".$maxwidth."x".$maxheight."</strong>)";
				}
				
				$extension_upload = strtolower(substr(  strrchr($_FILES['avatar']['name'], '.')  ,1));
				if (!in_array($extension_upload,$extensions_valides) )
				{
					$i++;
					$avatar_erreur3 = "Extension de l'avatar incorrecte";
				}
			}
			if ($i == 0) // Si $i est vide, il n'y a pas d'erreur sur l'avatar
			{
				if (!empty($_FILES['avatar']['size']))
				{
					post_UpdateAvatar();
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
include_once('./vue/membre/profil.php');