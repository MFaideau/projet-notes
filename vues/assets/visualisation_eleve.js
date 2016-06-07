$(document).on("click", "button[id^=eleves_cursus_]", function (e) {
    idCursus = this.id.replace("eleves_cursus_", "");
    var nomCursus = $(this).text();
    $.ajax({
        url: './ajax/visualisation_eleves.php',
        type: 'POST',
        datatype: 'html',
        data: 'idCursus=' + this.id.replace("eleves_cursus_", ""),
        success: function (result) {
            $(".panel_listing").remove();
            $(result).insertAfter($(".panel_choix_eleves"));
            $("input[id=id_cursus_add_etudiant]").val(idCursus);
            $("#cursus_add_etudiant").empty().append(nomCursus);
            jQuery.getScript('./vues/assets/bootstrap/bootstrap-table.js');
        },
        error: function (result) {
            alert("Erreur lors de la récupération des compétences. Veuillez réessayer.");
        }
    });
});

$(function () {
    $('#addEtudiantForm').on("submit", function (e) {
        e.preventDefault();
        $("#addEtudiant").modal("hide");
        $.ajax({
            url: './ajax/visualisation_eleves.php',
            type: 'POST',
            datatype: 'html',
            data: 'idEtudiant='+ $("#idEtudiant").val() + '&nom=' + $("#nomEtudiant").val() + "&prenom=" + $("#prenomEtudiant").val() + "&mail=" + $("#mailEtudiant").val() + "&idCursus=" + $("#id_cursus_add_etudiant").val(),
            success: function (result) {
                $("button[id=eleves_cursus_" + $("#id_cursus_add_etudiant").val() + "]").trigger("click");
            },
            error: function (result) {
                alert("Erreur lors de la récupération des compétences. Veuillez réessayer.");
            }
        });
    });
});