<?php
	session_start();	
	require_once '../connexion/config.php';
	
	if(!isset($_SESSION['user']))
		header('Location:../connexion/connexion.php');
	
	if($_SESSION['admin'] != 1)
		header('Location:../accueil.php');
	
	if(isset($_GET['id_produit']) and !empty($_GET['id_produit'])){
		$id_produit = $_GET['id_produit'];
		$get_produit = $bdd->prepare("SELECT * FROM produits WHERE id_produit = ?");
		$get_produit->execute(array($id_produit));
		
		$print = $get_produit->fetch(PDO::FETCH_ASSOC);
		
		$nom = $print['nom_produit'];
		$prix = $print['prix_produit'];
		$desc = $print['description_produit'];
		$stock = $print['stock_produit'];
		
		if(isset($_FILES['image'])){
				$img_nom = $_FILES['image']['name'];
				$tmp_nom = $_FILES['image']['tmp_name'];
				$deplacer_image = move_uploaded_file($tmp_nom,"images-produits/".$img_nom) ;
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
		<form action= "" method= "post" enctype="multipart/form-data">

		<h3>Modifier un article</h3><hr><br><br>
		
		<div class="Box">
			
				<span>Nom</span>
				<div class = "box">
					<div class = "icon"><ion-icon name="pricetag-outline"></ion-icon></div>
					<input type = "text" name = "nom" value = "<?php echo $nom; ?>" required>
				</div>
			
			<br>
			
				<span>Prix</span>
				<div class = "box">
					<div class = "icon"><ion-icon name="logo-euro"></ion-icon></div>
					<input type= "text" name= "prix" value = "<?php echo $prix; ?>"required>
				</div>
				
			<br>
			
				<span>Stock</span>
				<div class = "box">
					<div class = "icon"><ion-icon name="cube-outline"></ion-icon></div>
					<input type= "text" name= "stock" value = "<?php echo $stock; ?>"required>
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
				<textarea name = "desc" rows = "4" cols = "50" value = "<?php echo $desc; ?>"required></textarea>
				
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
				<input type="submit" value="Editer" name="edit_produit">
				<input type = "reset" value = "Annuler"  onclick="window.location.href='resultats.php';">
			</div>
		</form>
	</div>
</body>

<?php

	if(isset($_POST['edit_produit'])){

		if(isset($_POST['select_produit']) and !empty($_POST['select_produit'])){
			$categorie = $_POST['select_produit'];
			
			$update = $bdd->prepare("UPDATE produits SET nom_produit=?, prix_produit=?, stock_produit=?, categorie_produit=?, description_produit=?, image_produit=? WHERE id_produit=?");
			$update->execute(array($_POST['nom'], $_POST['prix'], $_POST['stock'], $categorie, $_POST['desc'], $img_nom, $_GET['id_produit']));
				
				
			header("Location:resultats.php");
		}
	}
	
?>