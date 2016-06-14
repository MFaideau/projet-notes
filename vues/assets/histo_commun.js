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
