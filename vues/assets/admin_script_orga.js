// TODO : Inclure ce fichier uniquement si on est connecté en ADMIN

$(document).on("click","button[id^=orga_cursus_]", function(e) {
    $.ajax({
        url: './ajax/admin_ajax_orga.php',
        type: 'POST',
        datatype: 'html',
        data: 'idCursus=' + this.id.replace("orga_cursus_",""),
        success: function(result){
            $(".panel_competences").remove();
            $(".panel_cours").remove();
            $(".panel_type_eval").remove();
            $(".panel_epreuve").remove();
            $(".panel_upload_epreuve").remove();
            $(".panel_cursus").append(result);},
        error: function(result) {
            alert("Erreur lors de la récupération des compétences. Veuillez réessayer.");
        }
    });
});

$(document).on("click","button[id^=orga_competence_]",function(e){
    $.ajax({
        url: './ajax/admin_ajax_orga.php',
        type: 'POST',
        datatype: 'html',
        data: 'idCompetence=' + this.id.replace("orga_competence_",""),
        success: function(result){
            $(".panel_cours").remove();
            $(".panel_type_eval").remove();
            $(".panel_epreuve").remove();
            $(".panel_upload_epreuve").remove();
            $(result).insertAfter(".panel_competences"); },
        error: function(result) {
            alert("Erreur lors de la récupération des compétences. Veuillez réessayer.");
        }
    });
});

$(document).on("click","button[id^=orga_cours]", function(e) {
    $.ajax({
        url: './ajax/admin_ajax_orga.php',
        type: 'POST',
        datatype: 'html',
        data: 'idCours=' + this.id.replace("orga_cours_",""),
        success: function(result) {
            $(".panel_type_eval").remove();
            $(".panel_epreuve").remove();
            $(".panel_upload_epreuve").remove();
            $(result).insertAfter($(".panel_cours"));
        },
    });
});

$(document).on("click","button[id^=orga_type_eval]", function(e) {
    $.ajax({
        url: './ajax/admin_ajax_orga.php',
        type: 'POST',
        datatype: 'html',
        data: 'idTypeEval=' + this.id.replace("orga_type_eval_",""),
        success: function(result) {
            $(".panel_epreuve").remove();
            $(".panel_upload_epreuve").remove();
            $(result).insertAfter($(".panel_type_eval"));
        },
    });
});

$(document).on("click","button[id^=orga_epreuve]", function(e) {
    $.ajax({
        url: './ajax/admin_ajax_orga.php',
        type: 'POST',
        datatype: 'html',
        data: 'idEpreuve=' + this.id.replace("orga_epreuve_",""),
        success: function(result) {
            $(".panel_upload_epreuve").remove();
            $(result).insertAfter($(".panel_epreuve"));
//            $(".panel_cours").append(result);
        },
    });
});

$(function(){
    $('#addCursus').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: './ajax/admin_ajax_orga.php', //this is the submit URL
            type: 'POST', //or POST
            data: "nomCursus=" + $("#nomCursus").val() + "&anneeCursus=" + $("#anneeCursus").val(),
            success: function(data){
                $("#addCursus").modal("hide");
                $(data).insertAfter($("button[id^=orga_cursus_]").parent().last());
            }
        });
    });
});