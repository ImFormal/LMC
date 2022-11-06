<?php
    session_start();
    require_once '../../connexion/config.php';
    $note = $bdd->query("SELECT note FROM avis WHERE id_avis = ".$_POST["id_avis"])->fetch()["note"];
    $bdd->query("DELETE FROM avis WHERE id_avis = ".$_POST["id_avis"]);
    $nombreavis = $bdd->query("SELECT nombre_avis FROM produits WHERE id_produit = ".$_POST["id"])->fetch()["nombre_avis"];
    $bdd->query("UPDATE produits SET nombre_avis = nombre_avis - 1, moyenne_note = ".($nombreavis > 1 ? "(moyenne_note * $nombreavis - $note) / ($nombreavis - 1)" : "5")." WHERE id_produit = ".$_POST["id"]);
?>