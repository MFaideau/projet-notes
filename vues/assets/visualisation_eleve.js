$(document).on("click", "button[id^=eleves_cursus_]", function (e) {
    idCursus = this.id.replace("orga_cursus_", "");
    $.ajax({
        url: './ajax/visualisation_eleves.php',
        type: 'POST',
        datatype: 'html',
        data: 'idCursus=' + this.id.replace("orga_cursus_", ""),
        success: function (result) {
            $(".panel_listing").remove();
        },
        error: function (result) {
            alert("Erreur lors de la récupération des compétences. Veuillez réessayer.");
        }
    });
});