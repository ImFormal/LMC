<!DOCTYPE html>

<?php
	session_start();	
	require_once '../../connexion/config.php';
    require_once 'pdf.php';

    $idproduit = $_GET["id"];
    $produit = $bdd->query("SELECT * FROM produits WHERE id_produit = ".$idproduit)->fetch();

    function etoilesNote($note) {
        $str = '<span class="etoiles">';
        for ($i = 0.5; $i <= 4.5; ++$i)
            $str = $str.'<img class="etoile" src="../icones/'.($i <= $note ? "star_icon_full" : "star_icon").'.png"></img>';
        return $str.'</span>';
    }
?>

<html>
    <head>
        <title><?= $produit["nom_produit"] ?></title>
        <meta charset="utf8"/>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="stylearticle.css" type="text/css" /> 
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="../../stylebandeau.css" type="text/css" /> 
        <script src="script.js"></script>
    </head>
    <body>
        <div class="bandeau">
            <img class="logo" href="../../accueil.php" src="../../lmc.png">
            <div class="onglets">
                <div class="onglet"><a href="../../accueil.php">Accueil</a></div>
                <div class="onglet"><a href="../../boutique/boutique.php">Boutique</a></div>
                <div class="onglet"><a href="../../questions/questions.php">Questions</a></div>
                <div class="onglet"><a href="../../informations/infos.php">Informations</a></div>
                <?php
                    if (isset($_SESSION["user"])) {
                        echo '<div class="onglet"><a href="../../panier/panier.php">Panier</a>'.
                        (count($_SESSION["panier"]) ? '<span class="nombrepanier">'.count($_SESSION["panier"]).'</span>' : "")
                        .'</div><div class="onglet connexion"><a href="../../connexion/deconnexion.php">Déconnexion</a></div>';
                    }
                    else
                        echo '<div class="onglet connexion"><a href="../../connexion/connexion.php">Connexion</a></div>';
                ?>
            </div>
        </div>

        <div id="contenu">
            <div id="gauche">
                <div class="image"><img src="../../articles/images-produits/<?= $produit["image_produit"] ?>"></img></div>
                <div class="action"><a href="#" onclick="window.location.href = '../boutique.php';"><img src="icones/return_icon" class="icon"></img>Retour à la boutique</a></div><hr />
                <div class="action"><a href="#avisutilisateur"><img src="icones/comment_icon" class="icon"></img>Écrire un avis</a></div><hr />
                <div class="action">
					<form method = "post">
						<input type="submit" name="create_pdf" class ="btn btn-warning" value="créer PDF"  />
					</form>
				</div>            </div>
            <div id="droite">
                <h1><?= $produit["nom_produit"] ?></h1>
                <div id="panier">
                    <img src="icones/cart_icon" id="iconepanier"></img>
                    <div id="text">
                        <?php
                            if (isset($_SESSION["user"])) {
                                if ($produit["stock_produit"]) {
                                    if (isset($_SESSION["panier"][$idproduit]))
                                        echo '<span>En panier :
                                            <div class="modif">
                                                <div class="modifmoins" onClick="retirer('.$idproduit.', this);">-</div>
                                                <div class="nombre">'.$_SESSION["panier"][$idproduit].'</div>
                                                <div class="modifplus" onClick="ajouter('.$idproduit.', '.$produit["stock_produit"].', this);">+</div>
                                            </div>
                                        </span>';
                                    else
                                        echo '<a class="action" href="" onClick="ajouterPremier('.$idproduit.')">+ Ajouter cet article au panier</a>';
                                }
                                else
                                    echo '<span class="paniererreur">Article indisponible à l\'achat</span>';
                            }
                            else
                                echo '<span class="paniererreur">Vous devez être connecté pour ajouter cet article</span>';
                        ?>
                    </div>
                </div>
                <h2>Prix : <strong><?= $produit["prix_produit"] ?></strong> €</h2>
                <?php
                    if ($produit["stock_produit"])
                        echo '<h2>Restant : <strong>'.$produit["stock_produit"].'</strong></h2>';
                ?>
                <h2>Description</h2>
                <p><?= $produit["description_produit"] ?></p>
                <?php
                    if ($produit["nombre_avis"]) {
                        echo '<h2>Avis ('.$produit["nombre_avis"].' avis)</h2>';
                        $avis = $bdd->query("SELECT * FROM avis WHERE id_article = ".$idproduit);
                        foreach($avis as $av) {
                            $pseudo = $bdd->query("SELECT pseudo FROM utilisateur WHERE id = ".$av["id_utilisateur"])->fetch()["pseudo"];
                            echo '<div class="avis">
                                <div class="enteteavis">
                                    <span class="pseudoavis">'.$pseudo.'</span>'.
                                    etoilesNote($av["note"]).
                                    '<span class="dateavis"> publié le '.date("d/m/y à H\hi", strtotime($av["date_ajout"])).'</span>'.
                                    (isset($_SESSION["user"]) && ($_SESSION["admin"] || $_SESSION["id"] == $av["id_utilisateur"]) ? '<a class="supprimeravis" href="#" onClick="supprimerAvis('.$idproduit.', '.$av["id_avis"].')">Supprimer</a>' : '').
                                '</div>
                                <div class="corpsavis">
                                    <span class="texteavis">'.$av["avis"].'</span>
                                </div>
                            </div>';
                        }
                    }
                    else
                        echo '<h2>Avis (aucun avis)</h2>';
                    if (isset($_SESSION['user'])) {
                        echo '<h3>Ajoutez un avis :</h3>
                        <form id="avisutilisateur" method="POST" action="javascript:ajouterAvis();">
                            <textarea name="avis" minlength="10" maxlength="500" placeholder="Laissez nous un avis ici!" spellcheck required></textarea>
                            <label for="note">Note : </label>
                            <input name="id" type="hidden" value="'.$idproduit.'">
                            <select id="note" name="note">
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                                <option value="0">0</option>
                            </select>                            
                            <button type="submit">Envoyer</button>
                        </form>';
                    }
                    else
                        echo '<h3>Connectez vous pour laisser un avis</h3>';
                ?>
            </div>
        </div>
    </body>
</html>