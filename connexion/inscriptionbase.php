<?php
	require_once 'config.php';
	
	if(isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password'])){
		$pseudo = $_POST['pseudo'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		$check_email = $bdd->prepare('SELECT email FROM utilisateur WHERE email = ?');
		$check_pseudo = $bdd->prepare('SELECT pseudo FROM utilisateur WHERE pseudo = ?');
		$check_email->execute(array($email));
		$check_pseudo->execute(array($pseudo));
		$data_email = $check_email->fetch();
		$data_pseudo = $check_pseudo->fetch();
		
		if($data_email['email'] != $email){
			if(strlen($pseudo) <= 100){
				if($data_pseudo['pseudo'] != $pseudo){
					if(strlen($email) <= 100){
						if(filter_var($email, FILTER_VALIDATE_EMAIL)){
							$password = hash('sha256', $password);
							$ip = $_SERVER['REMOTE_ADDR'];
						
							$insert = $bdd->prepare('INSERT INTO utilisateur(pseudo, email, password, ip) VALUES(:pseudo, :email, :password, :ip)');
							$insert->execute(array(
								'pseudo' => $pseudo,
								'email' => $email,
								'password' => $password,
								'ip' => $ip
							));
							header('Location:inscription.php?reg_err=success');
						}
						else header('Location:inscription.php?reg_err=email');
					}
					else header('Location:inscription.php?reg_err=email_length');
				}
				else header('Location:inscription.php?reg_err=pseudo_already');
			}
			else header('Location:inscription.php?reg_err=pseudo_length');
		}
		else header('Location:inscription.php?reg_err=already');
	}