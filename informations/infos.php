<!DOCTYPE HTML>

<?php
	session_start();		
?>

<html>
	<head>
        <title>LeMauvaisCoin</title>
        <meta charset="utf8"/>
        <link href="style.css" rel="stylesheet" type="text/css" rel="icon" href="../lmc.png"/> 
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

		<div class = "bloc">
			<div class = "titre">Qui sommes-nous</div>
			<div class = "text">Nous sommes deux élèves : NOYE Valentin et THUBERT Maxime en licence 2 informatique à l'université de Perpignan, nous avons travaillé sur ce site lors d'un projet en programmation web.</div>
		</div>
		
		<div class = "bloc">
			<div class = "titre">Quel est ce site</div>
			<div class = "text">
				<p>Ce site est un site de vente en ligne qui détourne le nom du site "LeBonCoin", afin de montrer que ce site est une parodie et non un réel site de vente en ligne même si toutefois le site est fonctionnel.</p>
				<p>Ce site a été développé en HTML, CSS, PHP et JavaScript, à l'aide de jQuery et d'une connexion vers une base de donnée MYSQL.</p>
			</div>
		</div>
		
		<div class = "bloc">
			<div class = "titre">Questions</div>
			<div class = "text">Pour toutes questions vous pouvez vous rendre sur l'onglet <a href = "../questions/questions.php">questions</a> ou nous contacter par mail : <a href = "mailto:support@lemauvaiscoin.com">support@lemauvaiscoin.com</a>.</div>
		</div>
	</body>
</html>