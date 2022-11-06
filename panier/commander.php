<?php
    session_start();
    require_once '../connexion/config.php';
    foreach($_SESSION["panier"] as $id => $nombre) {
        $bdd->query("UPDATE produits SET stock_produit = stock_produit - $nombre WHERE id_produit = ".$id);
        unset($_SESSION["panier"][$id]);
    }
?>