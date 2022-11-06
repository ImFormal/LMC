<!DOCTYPE html>

<?php
	session_start();
	require_once '../connexion/config.php';
    require_once 'initrecherche.php';

    function etoilesNote($note) {
        $str = '<span class="etoiles">';
        for ($i = 0.5; $i <= 4.5; ++$i)
            $str = $str.'<img class="etoile" src="icones/'.($i <= $note ? "star_icon_full" : "star_icon").'.png"></img>';
        return $str.'</span>';
    }
?>

<html>
    <head>
        <title>Boutique</title>
        <meta charset="utf8"/>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="styleboutique.css" type="text/css" /> 
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

        <form id="recherche" method="get">
            <div id="rechnormale">
                <select name="categorie" id="rechcategorie">
                    <option value="">Toutes les catégories</option>
                    <?php
                        foreach($bdd->query("SELECT nom_categorie FROM categorie") as $cat)
                            echo "<option ".($categorie == $cat["nom_categorie"] ? "selected " : " ")."value='".$cat["nom_categorie"]."' >".$cat["nom_categorie"]."</option>";
                    ?>
                </select>
                <input id="rechsaisie" type="text" placeholder="Recherchez un article" name="recherche" value="<?= $recherche ?>">
                <button id="rechbouton" type="submit"><img src="icones/search-icon.png"></img></button>
            </div>
            <div id="rechavancee">
                <div class="rechparametre">
                    <label for="tri">Tri : </label><select name="tri">
                        <option <?= $tri == "none" ? "selected" : "" ?> value="none" name="none">Aucun</option>
                        <option <?= $tri == "prix_asc" ? "selected" : "" ?> value="prix_asc" name="prix_asc">Prix ascendant</option>
                        <option <?= $tri == "prix_dcs" ? "selected" : "" ?> value="prix_dcs" name="prix_dcs">Prix décroissant</option>
                        <option <?= $tri == "date_asc" ? "selected" : "" ?> value="date_asc" name="date_asc">Le plus ancien</option>
                        <option <?= $tri == "date_dcs" ? "selected" : "" ?> value="date_dcs" name="date_dcs">Le plus nouveau</option>
                    </select>
                </div>
                <div class="rechparametre" style="width: 400px;">
                    <label>Prix : </label>
                    <div id="sliderprix"></div>
                    <label id="montants"></label>
                    <input type="hidden" id="montantmin" name="montantmin" value="-1">
                    <input type="hidden" id="montantmax" name="montantmax" value="-1">
                </div>
                <div class="rechparametre">
                    <label for="dansstock">Stock non épuisé : </label><input type="checkbox" name="dansstock" <?= $dansstock ? "checked" : "" ?> >
                </div>
                <div class="rechparametre">
                    <label for="dansdescription">Recherche dans la description : </label><input type="checkbox" name="dansdescription" <?= $dansdescription ? "checked" : "" ?>>
                </div>
                <div id="rechannuler" onClick="window.location.replace(window.location.pathname);">
                    <span>Annuler la recherche</span>
                </div>
            </div>
        </form>
        <?php
            if ($produits->rowCount()) {
                echo "<div id='listearticles'>";
                foreach($produits as $prod) {
                    echo '<div class="produit">
                        <div class="inner" onclick="goToArticle('.$prod['id_produit'].');">
                            <div class="image">
                                <img src="../articles/images-produits/'.$prod['image_produit'].'">
                            </div>
                            <div class="text">
                                <strong><p class="titre">'.$prod['nom_produit'].'</p></strong>
                                <p class="categorie">('.$prod['categorie_produit'].')</p>
                                <p class="description">'.$prod['description_produit'].'</p>
                                <p class="note">'.etoilesNote($prod['moyenne_note']).'('.($prod['nombre_avis'] ? $prod['nombre_avis'] : "aucun").' avis)</p>'.
                                (isset($_SESSION["user"]) && isset($_SESSION["panier"][$prod['id_produit']]) ? '<p class="panier"><strong>'.$_SESSION["panier"][$prod['id_produit']].'</strong> dans le panier</p>' : '')
                            .'</div>
                            <div class="infoprix">'.
                                ($prod['stock_produit'] ? '<span class="stock"><strong>'.$prod['stock_produit'].'</strong> restants à <strong>'.$prod['prix_produit'].' €</strong></span>' : '<span class="stockvide"><strong>Stock épuisé</strong></span><span class="stock"> - <strong>'.$prod['prix_produit'].' €</strong></span>')
                            .'</div>
                        </div>
                    </div>';
                }
                echo "</div>";
            }
            else
                echo "<p id='rechvide'>Aucun résultat pour cette recherche</p>";
            ?>
        </div>
    </body>
</html>