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