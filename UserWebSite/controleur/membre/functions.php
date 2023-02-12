<?php
function erreur($err='')
{
   $mess=($err!='')? $err:'Une erreur inconnue s\'est produite';
   exit('
		<div class="container-fluid">
			<section id="content" class="page-content">
				<div class="container text-center">
					<h2>Vous êtes pas autorisé a passer ici</h2><br>
					<p> '.$mess.' </p>
					<p>Cliquez <a href="./espace_membre.php">ici</a> pour revenir à la page d\'accueil</p>
				</div>
			</section>
		</div>');
}
function move_avatar($avatar)
{
    $extension_upload = strtolower(substr(  strrchr($avatar['name'], '.')  ,1));
    $name = time();
    $nomavatar = str_replace(' ','',$name).".".$extension_upload;
    $name = "./images/avatars/".str_replace(' ','',$name).".".$extension_upload;
    move_uploaded_file($avatar['tmp_name'],$name);
    return $nomavatar;
}
?>
