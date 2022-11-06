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
			$ban = $bdd->prepare('DELETE FROM utilisateur WHERE id = ?');
			$ban->execute(array($id));
			$ban = $bdd->prepare('DELETE FROM avis WHERE id_utilisateur = ?');
			$ban->execute(array($id));
			
			header('Location:membres.php');
		}
		else echo "Aucun membre n'a été trouvé";
	}
	else echo $row['id'];
?>