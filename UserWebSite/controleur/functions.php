<?php
function erreur($err='')
{
   $mess=($err='')? $err:'Une erreur inconnue s\'est produite';
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
function edit_avatar($avatar, $pseudo)
{
      if (isset ($avatar)){
		$imagename = $avatar['name'];// exemple.png
		$source = $avatar['tmp_name'];// /volume1/@tmp/phpiES0qN
		$locate = "./images/avatars/".$pseudo."/";
		$dir = $locate."img_user.jpeg";
    	move_uploaded_file($source,$dir);
		changeToJpeg($dir,$dir);
		resize_avatar($dir,$dir);
		$rdir = substr($dir,1);
		return $rdir;
      }
}

function changeToJpeg($source, $dir) 
{
    $ext = substr($_FILES['avatar']['type'],6); //jpeg
    switch($ext) {
        case 'jpg':
            $image = imagecreatefromjpeg($source);
            break;
 
        case 'jpeg':
            $image = imagecreatefromjpeg($source);
            break;
 
        case 'png':
            $image = imagecreatefrompng($source);
            break;
 
        case 'gif':
            $image = imagecreatefromgif($source);
            break;
		default: 
		throw new Exception('Unknown image type.');
    }
    imagejpeg($image, $dir);
}

function resize_avatar($dir,$out ) 
{
	list($width, $height) = getimagesize($dir);
	$modwidth = 900;  //target width
	$diff = $width / $modwidth;
	$modheight = $height / $diff;

	$tn = imagecreatetruecolor($modwidth, $modheight);
	$image = imagecreatefromjpeg($dir);
	imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height);
	imagejpeg($tn, $out);
}
?>
