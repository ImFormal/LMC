function modifierPanier(id, nombre) {
    $.post("./modifierpanier.php", {
        "id": id,
        "nombre": nombre
    }).done(function() {   
        location.reload();  
    });
}

function supprimerAvis(id, id_avis) {
    $.post("./supprimeravis.php", {
        "id": id,
        "id_avis": id_avis
    }).done(function() {   
        location.reload();  
    });
}

function ajouterAvis() {
    $.post("./ajouteravis.php", $('#avisutilisateur').serialize()).done(function() {   
        location.reload();  
    });
};

function retirer(id, element) {
    var compteur = $(element).next();
    if (compteur.text() <= 1)
        supprimer(id);
    else {
        compteur.text(parseInt(compteur.text()) - 1);
        $.post("./modifierpanier.php", {
            "id": id,
            "val": -1
        });
    }
}

function ajouter(id, max, element) {
    var compteur = $(element).prev();
    if (compteur.text() < max) {
        compteur.text(parseInt(compteur.text()) + 1);
        $.post("./modifierpanier.php", {
            "id": id,
            "val": 1
        });
    }
}

function ajouterPremier(id) {
    $.post("./ajouterpanier.php", {
        "id": id
    }).done(function() {
        location.reload(); 
    });
}

function supprimer(id) {
    $.post("./supprimerpanier.php", {
        "id": id
    }).done(function() {
        location.reload();
    });
}