$(document).on("click","a[id^=note_simulee_]", function(e) {
    var idEpreuve = this.id.replace("note_simulee_","");
    var note = $("input[id^=number_" + idEpreuve + "]").val();
    $.ajax({
        url: './ajax/simulation.php',
        type: 'POST',
        datatype: 'html',
        data: 'idEpreuve=' + idEpreuve + '&note=' + note,
        success: function(result) {
            $("span[id=note_" + idEpreuve + "]").html(note);
        }
    });
});

$(document).on("click", "a[id^=simu_comp]", function (e) {
    var idCompetence = this.id.replace("simu_comp_","");
    $.ajax({
        url: './ajax/simulation.php',
        type: 'POST',
        datatype: 'html',
        data: 'idCompetence=' + idCompetence,
        success: function (result) {
            $(".panel_simu_cours").remove();
            $(".panel_simu_epreuves").remove();
            $(result).insertAfter($(".panel_simu_comp"));
        }
    });
});

$(document).on("click", "a[id^=simu_cours]", function (e) {
    var idCours = this.id.replace("simu_cours_","");
    $.ajax({
        url: './ajax/simulation.php',
        type: 'POST',
        datatype: 'html',
        data: 'idCours=' + idCours,
        success: function (result) {
            $(".panel_simu_epreuves").remove();
            $(result).insertAfter($(".panel_simu_cours"));
        }
    });
});