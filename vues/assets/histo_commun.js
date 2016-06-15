$(document).on("click", "a[id^=hist_com_]", function (e) {
    var idCompetence = this.id.replace("hist_com_","");
    $.ajax({
        url: './ajax/histo.php',
        type: 'POST',
        datatype: 'html',
        data: 'type=histo_vert&idCompetence=' + idCompetence,
        success: function (result) {
            $(result).insertAfter($(".visualisation").parent());
            $(".donnees_histo_commun_epreuves").remove();
            $(".donnees_histo").remove();
        }
    });
});

$(document).on("click", "a[id^=hist_com_cours_]", function (e) {
    var idCours = this.id.replace("hist_com_cours_","");
    $.ajax({
        url: './ajax/histo.php',
        type: 'POST',
        datatype: 'html',
        data: 'type=histo_cours_vert&idCours=' + idCours,
        success: function (result) {
            $(result).insertAfter($(".visualisation").parent());
            $(".donnees_histo").remove();
            $(".donnees_histo_commun_cours").remove();
        }
    });
});

$(document).on("click", "a[id^=histo_batons_comp_]", function (e) {
    var idComp = this.id.replace("histo_batons_comp_","");
    $.ajax({
        url: './ajax/conversion_js.php',
        type: 'POST',
        datatype: 'json',
        data: 'action=getHistoComp&idComp=' + idComp,
        success: function (result) {
            loadBar(result);
            $("#showHisto1").modal("show");
        }
    });
});

$(document).on("click", "a[id^=histo_moyenne_ge_batons_cursus_]", function (e) {
    var idCursus = this.id.replace("histo_moyenne_ge_batons_cursus_","");
    $.ajax({
        url: './ajax/conversion_js.php',
        type: 'POST',
        datatype: 'json',
        data: 'action=getHistoCursus&idCursus=' + idCursus,
        success: function (result) {
            loadBar(result);
            $("#showHisto1").modal("show");
        }
    })
});

$(document).on("click", "a[id^=histo_batons_cours_]", function (e) {
    var idCours = this.id.replace("histo_batons_cours_","");
    $.ajax({
        url: './ajax/conversion_js.php',
        type: 'POST',
        datatype: 'json',
        data: 'action=getHistoCours&idCours=' + idCours,
        success: function (result) {
            loadBar(result);
            $("#showHisto1").modal("show");
        }
    })
});

