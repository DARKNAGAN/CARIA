<?php
session_start();
session_destroy();
$titre="Déconnexion";
include("./vue/header.html");
if ($id==0) erreur(ERR_IS_NOT_CO);
?>

<div class="container-fluid">
	<section id="content" class="page-content">
			<div class="container text-center">
			<h2>Déconnexion réussie!</h2><br>
			<h4>A Bientôt</h4><br>
				<p>Vous êtes à présent déconnecté <br/>
				<!--Cliquez <a href="'.htmlspecialchars($_SERVER['HTTP_REFERER']).'">ici</a> pour revenir à la page précédente.<br>-->
				Cliquez <a href="./espace_membre.php">ici</a> pour revenir à la page principale</p><br>
			</div>
		</div>
	</section>
</div>
<?php
include("./vue/footer.html"); 
?>