<?php 
    session_start();
    require_once 'config.php';
	
	if(isset($_POST['email']) && isset($_POST['password'])){
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		$check = $bdd->prepare('SELECT id, pseudo, email, password, admin FROM utilisateur WHERE email = ?');
		$check->execute(array($email));
		$data = $check->fetch();
		
		if($data['email'] === $email){
			if(filter_var($email, FILTER_VALIDATE_EMAIL)){
				$password = hash('sha256', $password);
				
				if($data['password'] === $password){
					$_SESSION['panier'] = [];
					$_SESSION['id'] = $data['id'];
					$_SESSION['user'] = $data['pseudo'];
					$_SESSION['admin'] = $data['admin'];
					
					header('Location:../accueil.php');
				}
				else header('Location:connexion.php?login_err=password');
			}
			else header('Location:connexion.php?login_err=email');
		}
		else header('Location:connexion.php?login_err=already');
	}
	
	else header('Location:connexion.php');
?>