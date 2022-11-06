<?php
	session_start();	
	require_once '../connexion/config.php';
	
	if(!isset($_SESSION['user']))
		header('Location:../connexion/connexion.php');
	
	if($_SESSION['admin'] != 1)
		header('Location:../accueil.php');
	
	if(isset($_GET['id']) and !empty($_GET['id'])){
		$id = $_GET['id'];
		$datausers = $bdd->prepare('SELECT * FROM utilisateur WHERE id = ?');
		$datausers->execute(array($id));
		if($datausers->rowCount()>0){
			$admin = $bdd->prepare('UPDATE utilisateur SET admin = 1 WHERE id = ?');
			$admin->execute(array($id));
			
			header('Location:membres.php');
		}
		else echo "Aucun membre n'a été trouvé";
	}
	else echo "L'id n'a pas été récupérée";
?>