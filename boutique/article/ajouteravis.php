<?php
    session_start();
    require_once '../../connexion/config.php';
    $nombreavis = $bdd->query("SELECT nombre_avis FROM produits WHERE id_produit = ".$_POST["id"])->fetch()["nombre_avis"];
    $avis = $bdd->prepare('INSERT INTO avis(id_article, id_utilisateur, avis, note) VALUES(:id_article, :id_utilisateur, :avis, :note)');
    $avis->execute(array(
        'id_article' => $_POST["id"],
        'id_utilisateur' => $_SESSION["id"],
        'avis' => $_POST["avis"],
        'note' => $_POST["note"]
    ));
    $bdd->query("UPDATE produits SET nombre_avis = nombre_avis + 1, moyenne_note = ".($nombreavis ? "moyenne_note + (".$_POST["note"]." - moyenne_note) / nombre_avis" : $_POST["note"])." WHERE id_produit = ".$_POST["id"]);
?>