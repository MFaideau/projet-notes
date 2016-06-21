$(document).on("click", "a[id^=hist_comp_]", function (e) {
    var idCompetence = this.id.replace("hist_comp_","");
    $.ajax({
        url: './ajax/histo.php',
        type: 'POST',
        datatype: 'html',
        data: 'type=histo_hor&idCompetence=' + idCompetence,
        success: function (result) {
            $(result).insertAfter($(".visualisation").parent());
            jQuery.getScript('./vues/assets/bootstrap/bootstrap-table.js');
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
        data: 'type=histo_cours_hor&idCours=' + idCours,
        success: function (result) {
            $(result).insertAfter($(".visualisation").parent());
            jQuery.getScript('./vues/assets/bootstrap/bootstrap-table.js');
            $(".donnees_histo").remove();
            $(".donnees_histo_cours").remove();
        }
    });
});

$(document).on("click", "a[id=prec_cours_histo_commun]", function() {
    $(".histo_commun").trigger("click");
});

$(document).on("click", "a[id=prec_cours_histo_perso]", function() {
    $(".histo_logo").trigger("click");
});

$(document).on("click", "a[id^=prec_hist_perso_comp_]", function() {
    var idCompetence = this.id.replace("prec_hist_perso_comp_","");
   $("a[id=hist_comp_" + idCompetence + "]").trigger("click");
});