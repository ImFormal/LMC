<html>
<head>
	<title>Formulaire</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<link href="style.css" rel="stylesheet" type="text/css" rel="icon" href="../lmc.png"/> 
</head>
<body>
	<div class = "formulaire">
		<?php
			if(isset($_GET['reg_err'])){
				$err = $_GET['reg_err'];
				
				switch($err){
					case 'success':
					?>
						<div class = "alert alert-success">
							<strong>Succès</strong> Inscription Réussie !
						</div>
					<?php
					break;
						
					case 'email':
                    ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> Email Non Valide
                        </div>
                    <?php
                    break;

                    case 'email_length':
                    ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> Email Trop Long
                        </div>
                    <?php 
                    break;

                    case 'pseudo_length':
                    ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> Pseudo Trop Long
                        </div>
                    <?php 
					break;
						
                    case 'already':
                    ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> Ce compte existe déjà
                        </div>
                    <?php 
					break;
					
					case 'pseudo_already':
                    ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> Ce pseudo est déjà utilisé
                        </div>
                    <?php 
					break;
				}
			}
			?>
	
		<form action = "inscriptionbase.php" method = "post">
		
			<h3>Inscription</h3><hr><br><br>
			
			<div class="Box">
			
				<span>Pseudo</span>
				<div class = "box">
					<div class = "icon"><ion-icon name="person-circle-outline"></ion-icon></div>
					<input type = "text" name = "pseudo" id = "pseudo" placeholder = "Zhong Xina" pattern = "[a-z0-9A-Z._-]{3,}" required>
				</div>
			
			<br>
			
				<span>Email</span>
				<div class = "box">
					<div class = "icon"><ion-icon name="mail-outline"></ion-icon></div>
					<input type = "text" name = "email" id = "email" placeholder = "adresse@gmail.com" pattern = "[a-z0-9A-Z._-]+@[a-z.]+\.[a-z]{2,4}" required>
				</div>
				
			<br>
				
				<span>Mot de Passe</span>
				<div class = "box">
					<div class = "icon"><ion-icon name="lock-closed-outline"></ion-icon></div>
					<input type = "password" name = "password" id = "password" pattern = "[a-z0-9A-Z._-!]{8,}" required>
				</div>
				
			<br>
						
				<div class = "box">
					<input type = "submit" value = "Confirmer">
					<input type = "reset" value = "Annuler" <input type = "reset" value = "Annuler"  onclick="window.location.href='../accueil.php';">
				</div>
				
			</div>
			
		</form>
		<center><p><a href = "connexion.php">Connexion</a></p></center>
	</div>
	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
	<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>

