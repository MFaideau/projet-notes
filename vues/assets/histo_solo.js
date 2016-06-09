$(document).on("click", "a[id^=hist_comp_]", function (e) {
    var idCompetence = this.id.replace("hist_comp_","");
    $.ajax({
        url: './ajax/histo.php',
        type: 'POST',
        datatype: 'html',
        data: 'idCompetence=' + idCompetence,
        success: function (result) {
            $(result).insertAfter($(".visualisation").parent());
            $(".donnees_histo_epreuves").remove();
            $(".donnees_histo").remove();
        }
    });
});

$(document).on("click", "a[id^=hist_cours_]", function (e) {
    var idCours = this.id.replace("hist_cours_","");
    $.ajax({
        url: './ajax/histo.php',
        type: 'POST',
        datatype: 'html',
        data: 'idCours=' + idCours,
        success: function (result) {
            $(result).insertAfter($(".visualisation").parent());
            $(".donnees_histo").remove();
            $(".donnees_histo_cours").remove();
        }
    });
});
