<?php
	session_start();	
	require_once '../connexion/config.php';
	
	if(!isset($_SESSION['user']))
		header('Location:../connexion/connexion.php');
	
	if($_SESSION['admin'] != 1)
		header('Location:../accueil.php');
		
	if(isset($_GET['id_produit']) and !empty($_GET['id_produit'])){
		$id = $_GET['id_produit'];
		$dataproduct = $bdd->prepare('SELECT * FROM produits WHERE id_produit = ?');
		$dataproduct->execute(array($id));
		if($dataproduct->rowCount()>0){
			$del = $bdd->prepare('DELETE FROM produits WHERE id_produit = ?');
			$del->execute(array($id));
			
			header("Location:resultats.php");
		}
		else echo "Aucun produit n'a été trouvé";
	}
	else echo "L'id n'a pas été récupérée";
?>