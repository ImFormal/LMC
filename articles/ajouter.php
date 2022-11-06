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
		$prix = $_POST['prix'];
		$stock = $_POST['stock'];
		$desc = $_POST['desc'];
		$categorie = $_POST['select_produit'];
		if(!empty($nom)){
			$req1 = mysqli_query($con, "SELECT nom_produit FROM produits WHERE nom_produit = '$nom'");
			if(mysqli_num_rows($req1) > 0) {
				header('Location:ajouter.php?add_err=already');
			}else {
				if(isset($_FILES['image'])){
					$img_nom = $_FILES['image']['name'];
					$tmp_nom = $_FILES['image']['tmp_name'];
					$deplacer_image = move_uploaded_file($tmp_nom,"images-produits/".$img_nom) ;

					if($deplacer_image){
						$req2 = mysqli_query($con,"INSERT INTO produits VALUES(NULL,'$nom','$prix','$stock','$categorie','$desc','$img_nom', 2.5, 0, CURRENT_TIMESTAMP)");
						if($req2){
							header('Location:ajouter.php?add_err=success');
						}else {
							header('Location:ajouter.php?add_err=fail');
						}
					}

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
	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
	<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
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
           <h3>Ajouter un article</h3><hr><br><br>
			
			<div class="Box">
			
				<span>Nom</span>
				<div class = "box">
					<div class = "icon"><ion-icon name="pricetag-outline"></ion-icon></div>
					<input type = "text" name = "nom" required>
				</div>
			
			<br>
			
				<span>Prix</span>
				<div class = "box">
					<div class = "icon"><ion-icon name="logo-euro"></ion-icon></ion-icon></div>
					<input type= "text" name= "prix" required>
				</div>
				
			<br>
			
				<span>Stock</span>
				<div class = "box">
					<div class = "icon"><ion-icon name="cube-outline"></ion-icon></div>
					<input type= "text" name= "stock" required>
				</div>
				
			<br>
			
				<span>Ajouter une image</span>
				<br>
				<div class = "img">
					<input type="file" name = "image" required>
				</div>
				
			<br><br>
				
				<span>Description</span>
				<br> 
				<textarea name = "desc" rows = "4" cols = "50" required></textarea>
				
			<br><br>
			
			<span>Catégorie</span> <br>
					<select class = "select_produit" name="select_produit" id = "pet-select" required>
						<option value = "">Saisir la catégorie</option>
							<?php
								
								$select = $bdd->prepare("SELECT * FROM categorie");
								$select->execute();
		
								while($print = $select->fetch(PDO::FETCH_ASSOC)){
								?>
								
								<option value = "<?php echo $print['nom_categorie'];?>"><?php echo $print['nom_categorie'];?></option>
		
		
							<?php
							}
							?>
					</select>
			
			<br><br>
			
			<div class = "box">
				<input type="submit" value="Ajouter" name="btn-ajouter">
				<input type = "reset" value = "Annuler"  onclick="window.location.href='../accueil.php';">
			</div>
		</form>
	</div>
    <center><a class="btn-liste-prod" href="resultats.php">Liste des produits</a></center>
</body>