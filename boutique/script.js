const SLIDER_MIN = 0;
const SLIDER_MAX = 1000;
const ARTICLES_PAR_LIGNE = 5;

function updateSlider(min, max) {
    $("#montantmin").val(min != SLIDER_MIN ? min : -1);
    $("#montantmax").val(max != SLIDER_MAX ? max : -1);
    if (max == min)
        $("#montants").html(max + " €");
    else if (max == SLIDER_MAX && min == SLIDER_MIN)
        $("#montants").html("N'importe quel prix");
    else if (max == SLIDER_MAX)
        $("#montants").html("À partir de " + min + " €");
    else if (min == SLIDER_MIN)
        $("#montants").html("Jusqu'à " + max + " €");
    else
        $("#montants").html(min + " € à " + max + " €");
}

function setSliderValues(min, max) {
    $("#sliderprix").slider({
        values: [min, max]
    })
}

function goToArticle(id) {
    document.location.href = "article/article.php?id=" + id;
}

$(document).ready(function() {
    const params = new Proxy(new URLSearchParams(window.location.search), {
        get: (searchParams, prop) => searchParams.get(prop),
    });
    var min = !params.montantmin || params.montantmin == -1 ? SLIDER_MIN : params.montantmin;
    var max = !params.montantmax || params.montantmax == -1 ? SLIDER_MAX : params.montantmax;

    $("#listearticles").css({
        "grid-template-columns" : "1fr ".repeat(ARTICLES_PAR_LIGNE)
    });

    $("#sliderprix").slider({
        range: true,
        min: SLIDER_MIN,
        max: SLIDER_MAX,
        values: [min, max],
        slide: function(event, ui) {
            updateSlider(ui.values[0], ui.values[1]);
        }
    });
    updateSlider(min, max);
});