$(document).on("click", "a[id^=releve_comp_]", function (e) {
    var idCompetence = this.id.replace("releve_comp_","");
    $.ajax({
        url: './ajax/releve.php',
        type: 'POST',
        datatype: 'html',
        data: 'idCompetence=' + idCompetence,
        success: function (result) {
            $(result).insertAfter($(".donnees_tableaux"));
            $(".donnees_tableaux").remove();
        }
    });
});

$(document).on("click", "a[id^=releve_cours_]", function (e) {
    var idCours = this.id.replace("releve_cours_","");
    $.ajax({
        url: './ajax/releve.php',
        type: 'POST',
        datatype: 'html',
        data: 'idCours=' + idCours,
        success: function (result) {
            $(result).insertAfter($(".visualisation").parent());
            $(".donnees_tableaux").remove();
            $(".donnees_tableaux_cours").remove();
        }
    });
});