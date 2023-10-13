<?php
class Connexion {
    public function checkCredentials($pseudo, $password) {
        // Ici, vous devriez effectuer la validation des identifiants
        // en interagissant avec une base de données ou une autre source de données.
        // Pour simplifier, nous supposerons que les identifiants sont corrects.
        return true;
    }
}

function check_Password()
{
	global $bdd;
	$req = $bdd->prepare('SELECT mdp, idclient, privilege, pseudo FROM Client WHERE pseudo = :pseudo');
	$req->bindValue(':pseudo',$_POST['pseudo'], PDO::PARAM_STR);
	$req->execute();
	$data = $req->fetch();
	return $data;
}