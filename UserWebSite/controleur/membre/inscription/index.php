<?php
include_once('./modele/membre/inscription.php');
$titre="Enregistrement";
if ($id!=0) erreur(ERR_IS_CO);
if (empty($_POST['pseudo'])) // Si on la variable est vide, on peut considérer qu'on est sur la page de formulaire
{
	?>
	
	<div class="container-fluid">
		<section id="content" class="page-content">
			<div class="container text-center">
				<h2>Inscription</h2>
				<form method="post" action="inscription.php" enctype="multipart/form-data">
							<label class="labelI" >*Pseudo</label><br><input name="pseudo" type="text" id="pseudo" placeholder=" Entre 3 à 15 caractères"/><br><br>
							<label class="labelI" for="password">*Mot de Passe :</label><input type="password" name="password" id="password" placeholder="Mot de passe"/>
							<label class="labelI" for="confirm">*Confirmer :</label><input type="password" name="confirm" id="confirm" placeholder="Confirmation"/><br>
						</fieldset>
							<label class="labelI" for="email">*Votre adresse email :</label><br><input type="email" name="email" id="email" placeholder="email@mail.fr"/><br>
						</fieldset>
							<label class="labelI" for="localisation">Localisation :</label><br><input type="text" name="localisation" id="localisation" placeholder="Adresse" /><br>
							<label class="labelI" for="prenom">Prenom :</label><br><input type="text" name="prenom" id="prenom" placeholder="Prénom"/><br>
							<label class="labelI" for="nom">Nom :</label><br><input type="text" name="nom" id="nom" placeholder="Nom"/><br>
							<label class="labelI" for="sexe">Sexe :</label><br>
							<div><input type="radio" id="femme" name="sexe" value="FEMME" checked><label for="femme">Femme</label>
    						<input type="radio" id="homme" name="sexe" value="HOMME"><label for="homme">Homme</label></div>
							<label class="labelI" for="age">Age :</label><br><input type="number" name="age" id="age" min="5" max="90" placeholder="Age"/><br>
							<fieldset>
							<label class="labelI" for="permis">Permis :</label><br><input type="number" name="permis" id="permis" min="0" max="7" placeholder="1 à 7"/><br>
						</fieldset>
						<fieldset><legend class="colorbold marg3 pad1">Profil sur le forum</legend>
							<label for="avatar">Choisissez votre avatar :</label><br><input type="file" name="avatar" id="avatar" accept=".png, .jpg, .jpeg, gif" /><br>
						</fieldset><br>
						<p class="btns"><input type="submit" value="S'inscrire" class="button-3"/></p><br>
						<p>Les champs précédés d'un * sont obligatoires</p>
				</form>
			</div>
		</section>
	</div>
	<?php
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
		<p>Cliquez <a href="./espace_membre.php">ici</a> pour revenir dans votre espace membre</p>
		</div>
		<?php
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
include_once('./vue/membre/inscription.php');