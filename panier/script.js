function voirProduit(id) {
    window.location.href = "../boutique/article/article.php?id=" + id;
}

function retirer(id, prix, element) {
    var compteur = $(element).next();
    if (compteur.text() <= 1)
        supprimer(id);
    else {
        compteur.text(parseInt(compteur.text()) - 1);
        var elementprix = $(element).parents().eq(2).find(".prixtotal");
        elementprix.text(parseFloat(elementprix.text()) - prix);
        var commanderprix = $("#commander > span");
        commanderprix.text(parseFloat(commanderprix.text()) - prix);
        $.post("./modifierpanier.php", {
            "id": id,
            "val": -1
        });
    }
}

function ajouter(id, max, prix, element) {
    var compteur = $(element).prev();
    if (compteur.text() < max) {
        compteur.text(parseInt(compteur.text()) + 1);
        var elementprix = $(element).parents().eq(2).find(".prixtotal");
        elementprix.text(parseFloat(elementprix.text()) + prix);
        var commanderprix = $("#commander > span");
        commanderprix.text(parseFloat(commanderprix.text()) + prix);
        $.post("./modifierpanier.php", {
            "id": id,
            "val": 1
        });
    }
}

function supprimer(id) {
    $.post("./supprimerpanier.php", {
        "id": id
    }).done(function() {
        location.reload();
    });
}

function commander() {
    $.ajax("./commander.php").done(function() {
        location.reload();
    });
}