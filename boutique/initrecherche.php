<?php
    $categorie = isset($_GET["categorie"]) ? $_GET["categorie"] : "";
    $recherche = isset($_GET["recherche"]) ? $_GET["recherche"] : "";
    $montantmin = isset($_GET["montantmin"]) ? $_GET["montantmin"] : -1;
    $montantmax = isset($_GET["montantmax"]) ? $_GET["montantmax"] : -1;
    $dansstock = isset($_GET["dansstock"]);
    $dansdescription = isset($_GET["dansdescription"]);
    $tri = isset($_GET["tri"]) ? $_GET["tri"] : "none";
    
    $query = "SELECT * FROM produits WHERE (nom_produit LIKE '%{$recherche}%'".
    ($dansdescription ? " OR description_produit LIKE '%{$recherche}%') " : ") ").
    (!empty($categorie) ? "AND categorie_produit = '".$_GET["categorie"]."' " : "").
    ($montantmin != -1 ? "AND prix_produit >= ".$_GET["montantmin"]." " : "").
    ($montantmax != -1 ? "AND prix_produit <= ".$_GET["montantmax"]." " : "").
    ($dansstock ? "AND stock_produit > 0 " : "").
    (substr($tri, 0, 4) == "prix" ? "ORDER BY prix_produit ".($tri == "prix_asc" ? "ASC " : "DESC "): "").
    (substr($tri, 0, 4) == "date" ? "ORDER BY date_ajout ".($tri == "date_asc" ? "ASC " : "DESC "): "");

    $produits = $bdd->query($query);
?>