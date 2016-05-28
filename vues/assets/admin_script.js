// TODO : Inclure ce fichier uniquement si on est connecté en ADMIN

$(".panel_cursus .panel_body button").click(function() {
    $.ajax({
        url: './ajax/admin_ajax_infos.php',
        type: 'POST',
        datatype: 'html',
        data: 'idCursus=' + this.id.replace("cursus_",""),
        success: function(result){
            $(".panel_competences").remove();
            $(".panel_cours").remove();
            $(".panel_type_eval").remove();
            $(".panel_epreuve").remove();
            $(".panel_cursus").append(result);
            $(".panel_upload_epreuve").remove(); },
        error: function(result) {
            alert("Erreur lors de la récupération des compétences. Veuillez réessayer.");
        }
    });
});

$(document).on("click",".panel_competences button",function(e){
    $.ajax({
        url: './ajax/admin_ajax_infos.php',
        type: 'POST',
        datatype: 'html',
        data: 'idCompetence=' + this.id.replace("competence_",""),
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

$(document).on("click",".panel_cours .panel_body button", function(e) {
    $.ajax({
        url: './ajax/admin_ajax_infos.php',
        type: 'POST',
        datatype: 'html',
        data: 'idCours=' + this.id.replace("cours_",""),
        success: function(result) {
            $(".panel_type_eval").remove();
            $(".panel_epreuve").remove();
            $(".panel_upload_epreuve").remove();
            $(result).insertAfter($(".panel_cours"));
//            $(".panel_cours").append(result);
        },
    });
});

$(document).on("click",".panel_type_eval .panel_body button", function(e) {
    $.ajax({
        url: './ajax/admin_ajax_infos.php',
        type: 'POST',
        datatype: 'html',
        data: 'idTypeEval=' + this.id.replace("type_eval_",""),
        success: function(result) {
            $(".panel_epreuve").remove();
            $(".panel_upload_epreuve").remove();
            $(result).insertAfter($(".panel_type_eval"));
//            $(".panel_cours").append(result);
        },
    });
});

$(document).on("click",".panel_epreuve .panel_body button", function(e) {
   $.ajax({
       url: './ajax/admin_ajax_infos.php',
       type: 'POST',
       datatype: 'html',
       data: 'idEpreuve=' + this.id.replace("epreuve_",""),
       success: function(result) {
           $(".panel_upload_epreuve").remove();
           $(result).insertAfter($(".panel_epreuve"));
//            $(".panel_cours").append(result);
       },
   });
});