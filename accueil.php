<?php
	session_start();		
?>

<!DOCTYPE html>

<html>
    <head>
        <title>LeMauvaisCoin</title>
        <meta charset="utf8"/>
		<link rel="stylesheet" href="stylebandeau.css" type="text/css" />
		<link rel="stylesheet" href="styleaccueil.css" type="text/css" />
    </head>
	
    <body>
		<div class="bandeau">
            <img class="logo" href="accueil.php" src="lmc.png">
            <div class="onglets">
                <div class="onglet"><a href="accueil.php">Accueil</a></div>
                <div class="onglet"><a href="boutique/boutique.php">Boutique</a></div>
                <div class="onglet"><a href="questions/questions.php">Questions</a></div>
                <div class="onglet"><a href="informations/infos.php">Informations</a></div>
                <?php
                    if (isset($_SESSION["user"])) {
						if($_SESSION["admin"])
							echo '<div class="onglet"><a href = "#popup">Admin</a></div>';
						else
							echo '<div class="onglet"><a href="panier/panier.php">Panier</a></div>'.
                        	(count($_SESSION["panier"]) ? '<span class="nombrepanier">'.count($_SESSION["panier"]).'</span>' : "");
                        echo '<div class="onglet connexion"><a href="connexion/deconnexion.php">Déconnexion</a></div>';
					}
                    else
                        echo '<div class="onglet connexion"><a href="connexion/connexion.php">Connexion</a></div>';
                ?>
            </div>
        </div>
		
		<div id = "popup" class = "overlay">
			<div class = "popup">	
				<a href = "#" class = "cross">&times;</a>
				<li><a class="con" href="articles/ajouter.php">Articles</a></li>
				<li><a class="con" href="membres/membres.php">Membres</a></li>
				<li><a class="con" href="categories/categories.php">Catégories</a></li>
			</div>
		</div>
		
		<div class="container">
			
			<h1><span>
			<?php
			if (isset($_SESSION["user"]))
				echo "Bonjour, ".$_SESSION["user"];
			else
				echo "Bonjour!";
			?><br /><br />
			Besoin de<span style="color:#fff"><span style="color:#ff006e"> Musique </span></span>? <br>Ne cherchez plus, écoutez !</span></h1>
			<a class = "bouton-boutique" href="boutique/boutique.php">Accédez à la boutique</a>
		</div>
		
    </body>
</html>