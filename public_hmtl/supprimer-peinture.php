<?php
session_start();
include("../config/bdd.php");

if(isset($_GET['id']) AND !empty($_GET['id'])) {
	$getid = $_GET['id'];
	$recupUser = $bdd->prepare('SELECT * FROM peintures WHERE id = ?');
	$recupUser->execute(array($getid));
	if($recupUser->rowCount() > 0) {

		$bannirUser = $bdd->prepare('DELETE FROM peintures WHERE id = ?');
		$bannirUser->execute(array($getid));

		header('Location:index-admin.php');

	}else{
		echo "Aucun produit n'a été trouvé";
	}
}else{
	echo "L'identifiant n'a pas été récupéré";
}


?>