<?php
function get_MemberCount()
{
	global $bdd;
	
	$TotalDesMembres = $bdd->query('SELECT COUNT(*) FROM Client')->fetchColumn();
	return $TotalDesMembres;
}
function get_LastMember()
{
	global $bdd;
	$req = $bdd->query('SELECT pseudo, idclient FROM Client ORDER BY idclient DESC LIMIT 0, 1');
	$data = $req->fetch();
	return $data;
}