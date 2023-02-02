<?php
include_once('./modele/membre/espace.php');
$titre = "Index du forum";
//Initialisation de deux variables
$totaldesmessages = 0;
$categorie = NULL;
$TotalDesMembres = get_MemberCount();
$data = get_LastMember();
$derniermembre = stripslashes(htmlspecialchars($data['pseudo']));
	?>
	
	<div class="container-fluid">
		<section id="content" class="page-content">
			<div class="container text-center">
				<h2>Espace Membre</h2><br>
				<h5>Qui est en ligne ?</h5>
				<p>Le site comptent <strong> <?php echo $TotalDesMembres;?></strong> membres.</p><br>
				<a href="./profil.php?m=<?php echo $data['idclient']?>&amp;action=consulter"><?php echo $derniermembre;?></a> est le dernier membre.</p>
			</div>
		</section>
	</div>
	<?php
include_once('./vue/membre/espace.php');