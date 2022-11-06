<!DOCTYPE html>

<?php
	session_start();	
	require_once '../connexion/config.php';

    if(!isset($_SESSION['user']))
        header('Location:../connexion/connexion.php');
?>

<html>
    <head>
        <title>Panier</title>
        <meta charset="utf8"/>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="stylepanier.css" type="text/css" />
        <link rel="stylesheet" href="../stylebandeau.css" type="text/css" />
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
        <script src="script.js"></script>
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

        <?php
            if (count($_SESSION["panier"])) {
                $total = 0;
                foreach($_SESSION["panier"] as $id => $nombre) {
                    $produit = $bdd->query("SELECT * FROM produits WHERE id_produit = ".$id)->fetch();
                    echo '<div class="produit">
                        <div class="image" onClick="voirProduit('.$id.');">
                            <img src="../articles/images-produits/'.$produit["image_produit"].'"> 
                        </div>
                        <div class="text">
                            <div class="titre">
                                <span class="nom">'.$produit["nom_produit"].'</span> 
                                <span class="categorie">('.$produit["categorie_produit"].')</span>
                            </div>
                            <span class="status">En panier :
                                <div class="modif">
                                    <div class="modifmoins" onClick="retirer('.$id.', '.$produit["prix_produit"].', this);">-</div>
                                    <div class="nombre">'.$nombre.'</div>
                                    <div class="modifplus" onClick="ajouter('.$id.', '.$produit["stock_produit"].', '.$produit["prix_produit"].', this);">+</div>
                                </div>
                            </span>
                            <span class="status">Disponibles : <strong>'.$produit["stock_produit"].'</strong></span>
                            <span class="status">Prix unitaire : <strong>'.$produit["prix_produit"].'</strong> €</span>
                            <span class="status">Prix total : <strong class="prixtotal">'.($nombre * $produit["prix_produit"]).'</strong> €</span>
                            <div class="supprimer" onClick="supprimer('.$id.');">Supprimer du panier</div>
                        </div>
                    </div>';
                    $total += $nombre * $produit["prix_produit"];
                }
                echo '<div id="commander" onClick="commander();">Commander (<span>'.$total.'</span> €)</div>';
            }
            else
                echo "<p id='paniervide'>Aucun article dans le panier</p>";
        ?>
    </body>
</html>