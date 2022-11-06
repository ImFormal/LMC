<!DOCTYPE HTML>

<?php
	session_start();		
?>

<html>
	<head>
        <title>LeMauvaisCoin</title>
        <meta charset="utf8"/>
        <link href="style.css" rel="stylesheet" type="text/css" rel="icon" href="../lmc.png"/> 
		<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
		<link rel="stylesheet" href="../stylebandeau.css" type="text/css" />
    </head>

	<body>
		<div class="bandeau">
            <img class="logo" href="../accueil.php" src="../lmc.png">
            <div class="onglets">
                <div class="onglet"><a href="../accueil.php">Accueil</a></div>
                <div class="onglet"><a href="../boutique/boutique.php">Boutique</a></div>
                <div class="onglet"><a href="../questions/questions.php">Questions</a></div>
                <div class="onglet"><a href="../informations/infos.php">Informations</a></div>
                <?php
                    if (isset($_SESSION["user"])) {
                        echo '<div class="onglet"><a href="../panier/panier.php">Panier</a>'.
                        (count($_SESSION["panier"]) ? '<span class="nombrepanier">'.count($_SESSION["panier"]).'</span>' : "")
                        .'</div><div class="onglet connexion"><a href="../connexion/deconnexion.php">Déconnexion</a></div>';
                    }
                    else
                        echo '<div class="onglet connexion"><a href="../connexion/connexion.php">Connexion</a></div>';
                ?>
            </div>
        </div>
		
		<section>
			<div class = "container">
				<div class = "titre">
					<p>
						<i class = "icon"><ion-icon name="help-buoy-outline"></ion-icon></i>
						FAQ : Questions / Réponses
					</p>
				</div>
				
				<div class = "deroulant">
					<div class = "question" id = "question1">
						<a class = "lien" href = "#question1">
							En quoi est codé ce site ?
							<i class = "down"><ion-icon name="chevron-down-outline"></ion-icon></i>
						</a>
						<div class = "reponse">
							<p>Ce site est codé en HTML, CSS, PHP et JavaScript à l'aide de la bibliothèque jQuery.</p>
						</div>
					</div>
					
					<div class = "question" id = "question2">
						<a class = "lien" href = "#question2">
							Qui a créé ce site ?
							<i class = "down"><ion-icon name="chevron-down-outline"></ion-icon></i>
						</a>
						<div class = "reponse">
							<p>Les personnes ayant créé ce site sont : NOYE Valentin et THUBERT Maxime.</p>
						</div>
					</div>
					
					<div class = "question" id = "question3">
						<a class = "lien" href = "#question3">
							Que puis-je acheter sur ce site ?
							<i class = "down"><ion-icon name="chevron-down-outline"></ion-icon></i>
						</a>
						<div class = "reponse">
							<p>Vous pouvez acheter tout ce qui est disponible dans la <a href = "../boutique/boutique.php">boutique</a> du moment où les stocks ne sont pas vides.</p>
						</div>
					</div>
					
					<div class = "question" id = "question4">
						<a class = "lien" href = "#question4">
							Un article que je souhaite acheter est en rupture de stock, quand sera t'il disponible ?
							<i class = "down"><ion-icon name="chevron-down-outline"></ion-icon></i>
						</a>
						<div class = "reponse">
							<p>Nous sommes en pleine faillite, nous ne restockerons plus d'article.</p>
						</div>
					</div>
					
					<div class = "question" id = "question5">
						<a class = "lien" href = "#question5">
							J'ai un problème sur ma commande, que faire ?
							<i class = "down"><ion-icon name="chevron-down-outline"></ion-icon></i>
						</a>
						<div class = "reponse">
							<p>Vous pouvez nous contacter à l'adresse suivante : <a href = "mailto:LeMauvaisCoin@support.com">LeMauvaisCoin@support.com</a></p>
						</div>
					</div>
					
					<div class = "question" id = "question6">
						<a class = "lien" href = "#question6">
							Quels sont les délais de livraison ?
							<i class = "down"><ion-icon name="chevron-down-outline"></ion-icon></i>
						</a>
						<div class = "reponse">
							<p>Nous ne sommes pas un vrai site, vous ne recevrez donc rien. Par contre, nous on recevra bien votre argent. Bonne journée !</p>
						</div>
					</div>
					
				</div>
			</div>
		</section>
	</body>
</html>