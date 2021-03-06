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
            jQuery.getScript('./vues/assets/bootstrap/bootstrap-table.js');
            $(result).insertAfter($(".panel_choix_eleves"));
            $("input[id=idCursusUpload]").val(idCursus);
            $("input[id=id_cursus_add_etudiant]").val(idCursus);
            $("#cursus_add_etudiant").empty().append(nomCursus);
        },
        error: function (result) {
            alert("Erreur lors de la récupération des étudiants. Veuillez réessayer.");
        }
    });
});
var mail;
$(document).on("click", "a[id^=deleteEtudiant_]", function (e) {
    mail = this.id.replace("deleteEtudiant_","");
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
                alert("Erreur lors de l'ajout de l'étudiant. Veuillez réessayer.");
            }
        });
    });
});

$(function () {
    $('#deleteEtudiantForm').on("submit", function (e) {
        e.preventDefault();
        $("#deleteEtudiant").modal("hide");
        $.ajax({
            url: './ajax/visualisation_eleves.php',
            type: 'POST',
            datatype: 'html',
            data: 'action=delete&mail=' + mail,
            success: function (result) {
                document.getElementById("etudiant_tr_"+mail).remove();
            },
            error: function (result) {
                alert("Erreur lors de la suppression de l'étudiant. Veuillez réessayer.");
            }
        });
    });
});


$(function () {
    $('#deleteTopConsult').on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: './ajax/visualisation_eleves.php',
            type: 'POST',
            datatype: 'html',
            data: 'action=deleteTopConsult',
            success: function (result) {
                $("#deleteTopConsult").modal("hide");
                window.location.reload();
            }
        });
    });
});

$(document).on("click", "a[id=linkVueEleve]", function (e) {
    document.getElementById("panelChoixEleves").style.display="initial";
});