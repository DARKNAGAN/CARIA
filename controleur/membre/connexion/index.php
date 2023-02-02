<?php
include_once('./modele/membre/connexion.php');
$titre="Connexion";
if ($id!=0) erreur(ERR_IS_CO);
if (!isset($_POST['pseudo'])) { //Page de formulaire
	?>
	
	<div class="container-fluid">
		<section id="content" class="page-content">
			<div class="container text-center">
				<h2>Connexion</h2>
				<form method="post" action="connexion.php">
						<br><fieldset>
							<label class="labelI" for="pseudo">Pseudo :</label><input name="pseudo" type="text" id="pseudo" /><br>
							<label class="labelI" for="password">Password :</label><input type="password" name="password" id="password" />
						</fieldset><br>
							<p class="btns"><input type="submit" value="Connexion" class="button-3" /></p>
				</form>
				<a href="./inscription.php">Pas encore inscrit ?</a><br><br>
			</div>
		</section>
	</div>
	<?php
}				
else { //Check de l'identification
	$message='';
	$data = check_Password();
	if (empty($_POST['pseudo']) || empty($_POST['password']) ) {
		
		$message = '
					<div class="container-fluid">
						<section id="content" class="page-content">
							<div class="container text-center">
								<h2>Echec de connexion</h2><br>
								<p>Une erreur s\'est produite pendant votre identification!</p>
								<p>Vous devez remplir tous les champs</p>
								<p>Cliquez <a href="./connexion.php">ici</a> pour revenir à la page de connexion.</p>			
							</div>
						</section>
					</div>';
	}
	else { //Validation de l'accès
				if ($data['mdp'] == /*md5*/($_POST['password'])) {
				$_SESSION['pseudo'] = $data['pseudo'];
				$_SESSION['privilege'] = $data['privilege'];
				$_SESSION['idclient'] = $data['idclient'];
				
				$message = '
							<div class="container-fluid">
								<section id="content" class="page-content">
									<div class="container text-center">
										<h2>Connexion réussie!</h2><br>
										<p>Bienvenue '.$data['pseudo'].',<br>Vous êtes maintenant connecté!</p>
										<p>Cliquez <a href="./espace_membre.php">ici</a> pour accéder a votre espace membre!</p>
									</div>
								</section>
							</div>';
		}
		else {
			$message = '
						<div class="container-fluid">
							<section id="content" class="page-content">
								<div class="container text-center">
									<h2>Echec de connexion</h2><br>
									<p>Une erreur s\'est produite pendant votre identification!</p>
									<p>Le mot de passe ou le pseudo entré n\'est pas correct.</p>
									<p>Cliquez <a href="./connexion.php">ici</a> pour revenir à la page de connexion.</p>
								</div>
							</section>
						</div>';
		}
	}
	echo $message;
}
include_once('./vue/membre/connexion.php');