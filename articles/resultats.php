<?php 
	
	session_start();	
	require_once '../connexion/config.php';
	
	if(!isset($_SESSION['user']))
		header('Location:../connexion/connexion.php');
	
	if($_SESSION['admin'] != 1)
		header('Location:../accueil.php');

?>
	
<head>
    <meta charset="UTF-8">
    <title>LeMauvaisCoin</title>
    <link href="styles.css" rel="stylesheet" type="text/css" rel="icon" href="../lmc.png"/> 
	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
	<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>
<body>
    <div class="result">
       <div class="result-content">
            <a href="ajouter.php">Ajouter un produit</a>
            <h3>liste des produits</h3>
            <div class="liste-produits">
                <?php 
				   $con = mysqli_connect("localhost","root","","projet");
                   $req2 = mysqli_query($con , "SELECT * FROM produits");
                   if(mysqli_num_rows($req2) == 0){
					   echo "Aucun produit trouvé";
                   }else {
                       while($row = mysqli_fetch_assoc($req2)){
                           echo '
                           <div class="produit">
                                <div class="image-prod">
                                        <img src="images-produits/'.$row['image_produit'].'"> 
                                </div>
                                <div class="text">
                                    <strong><p class="titre">'.$row['nom_produit']. ' - ' .$row['prix_produit']. ' €'.'</p></strong>
									<p class="categorie">'.$row['categorie_produit'].'</p>
									<p class="stock">'.'En stock : '.$row['stock_produit'].'</p>
                                    <p class="description">'.$row['description_produit'].'</p>
									<span>
										<a style="color:orange;text-decoration:none;" href="edit.php?id_produit='.$row['id_produit'].'">(Modifier)</a>
										<a style="color:red;text-decoration:none;" href="del.php?id_produit='.$row['id_produit'].'">(Supprimer)</a>
									</span>
                                </div>
                           </div>
                           ';
						   
                       }
                   }

                ?>
            </div>
			<a href = "../accueil.php"><div class = "icon"><ion-icon name="arrow-back-circle-outline"></ion-icon></div></a>
       </div>
    </div>
</body>
</html>