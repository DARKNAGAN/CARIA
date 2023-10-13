<?php
include_once('./modele/connexion.php');

$titre="Connexion";
if ($id!=0) erreur(ERR_IS_CO);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];
    $model = new Connexion();
	$data = check_Password();
    if ($model->checkCredentials($pseudo, $password)) {
	        // Les identifiants sont corrects, redirigez l'utilisateur vers une page de succès.
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
											<p>Cliquez <a href="./index.php">ici</a> pour accéder a votre espace membre!</p>
										</div>
									</section>
								</div>';
			    	echo $message;
	        header('Location: index.php');
	        exit();
    	} else {
        // Les identifiants sont incorrects, affichez un message d'erreur.
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
			echo $message;
    	}
	}
}
include_once('./vue/connexion.html');