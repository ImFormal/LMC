<?php

	session_start();
	require_once '../connexion/config.php';
	
	if(!isset($_SESSION['user']))
		header('Location:../connexion/connexion.php');
	if($_SESSION['admin'] != 1)
		header('Location:../accueil.php');
	
	if(isset($_POST['btn-ajouter'])){
		$con = mysqli_connect("localhost","root","","projet");
		$nom = $_POST['nom'];
		if(!empty($nom)){
			$req1 = mysqli_query($con, "SELECT nom_categorie FROM categorie WHERE nom_categorie = '$nom'");
			if(mysqli_num_rows($req1) > 0) {
				header('Location:categories.php?add_err=already');
			}else{
				$req2 = mysqli_query($con,"INSERT INTO categorie VALUES(NULL,'$nom')");
				if($req2){
					header('Location:categories.php?add_err=success');
				}else {
					header('Location:categories.php?add_err=fail');
				}
			}

		}
	}	
?>



<!DOCTYPE html>
<head>
	<title>LeMauvaisCoin</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<link href="style.css" rel="stylesheet" type="text/css" rel="icon" href="../lmc.png"/> 
</head>
<body>
	<div class = "formulaire">
		<?php
			if(isset($_GET['add_err'])){
				$err = $_GET['add_err'];
				
				switch($err){
					case 'success':
					?>
						<div class = "alert alert-success">
							<strong>Succès</strong> Ajout Réussie !
						</div>
					<?php
					break;
						
					case 'fail':
                    ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> Echec de l'ajout
                        </div>
                    <?php
                    break;
						
                    case 'already':
                    ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> Cet article existe déjà
                        </div>
                    <?php 
					break;
				}
			}
		?>
			
        <form action="" method="POST" enctype="multipart/form-data">
           <h3>Ajouter une catégorie</h3><hr><br><br>
			
			<div class="Box">
			
				<span>Nom</span>
				<div class = "box">
					<div class = "icon"><ion-icon name="pricetag-outline"></ion-icon></div>
					<input type = "text" name = "nom" required>
				</div>
			
			<br><br>
			
			<div class = "box">
				<input type="submit" value="Ajouter" name="btn-ajouter">
				<input type = "reset" value = "Annuler"  onclick="window.location.href='../accueil.php';">
			</div>
		</form>
	</div>
    <center><a class="btn-liste-prod" href="resultats.php"> Liste des catégories</a></center>
	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
	<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>

