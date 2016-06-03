$(document).on("click", "button[id^=eleves_cursus_]", function (e) {
    idCursus = this.id.replace("eleves_cursus_", "");
    $.ajax({
        url: './ajax/visualisation_eleves.php',
        type: 'POST',
        datatype: 'html',
        data: 'idCursus=' + this.id.replace("eleves_cursus_", ""),
        success: function (result) {
            $(".panel_listing").remove();
            $(result).insertAfter($(".panel_choix_eleves"));
            jQuery.getScript('./vues/assets/bootstrap/bootstrap-table.js');
        },
        error: function (result) {
            alert("Erreur lors de la récupération des compétences. Veuillez réessayer.");
        }
    });
});