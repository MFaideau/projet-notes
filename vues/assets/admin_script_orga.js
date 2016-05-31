// TODO : Inclure ce fichier uniquement si on est connecté en ADMIN
var idCursus, idCompetence, idCours, idEval, idTypeEval, idEpreuve;

$(document).on("click","button[id^=orga_cursus_]", function(e) {
    idCursus = this.id.replace("orga_cursus_","");
    $.ajax({
        url: './ajax/admin_ajax_orga.php',
        type: 'POST',
        datatype: 'html',
        data: 'idCursus=' + this.id.replace("orga_cursus_",""),
        success: function(result){
            $(".panel_competences").remove();
            $(".panel_cours").remove();
            $(".panel_eval").remove();
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
    idCompetence = this.id.replace("orga_competence_","");
    $.ajax({
        url: './ajax/admin_ajax_orga.php',
        type: 'POST',
        datatype: 'html',
        data: 'idCompetence=' + this.id.replace("orga_competence_",""),
        success: function(result){
            $(".panel_cours").remove();
            $(".panel_type_eval").remove();
            $(".panel_epreuve").remove();
            $(".panel_eval").remove();
            $(".panel_upload_epreuve").remove();
            $(result).insertAfter(".panel_competences"); },
        error: function(result) {
            alert("Erreur lors de la récupération des compétences. Veuillez réessayer.");
        }
    });
});

$(document).on("click","button[id^=orga_cours]", function(e) {
    idCours = this.id.replace("orga_cours_","");
    $.ajax({
        url: './ajax/admin_ajax_orga.php',
        type: 'POST',
        datatype: 'html',
        data: 'idCours=' + this.id.replace("orga_cours_",""),
        success: function(result) {
            $(".panel_eval").remove();
            $(".panel_type_eval").remove();
            $(".panel_eval").remove();
            $(".panel_epreuve").remove();
            $(".panel_upload_epreuve").remove();
            $(result).insertAfter($(".panel_cours"));
        },
    });
});

$(document).on("click","button[id^=orga_eval]", function(e) {
    idEval = this.id.replace("orga_eval_","");
    $.ajax({
        url: './ajax/admin_ajax_orga.php',
        type: 'POST',
        datatype: 'html',
        data: 'idEval=' + this.id.replace("orga_eval_",""),
        success: function(result) {
            $(".panel_epreuve").remove();
            $(result).insertAfter($(".panel_eval"));
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

$(function() {
    $('#addCompetence').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: './ajax/admin_ajax_orga.php',
            type: 'POST',
            data: 'idCursus=' + idCursus + '&nomCompetence=' + $("#nomCompetence").val(),
            success: function (data) {
                $("#addCompetence").modal("hide");
                $(data).insertAfter($("button[id^=orga_competence_]").last());
            }
        });
    });
});

$(function() {
    $('#addCours').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: './ajax/admin_ajax_orga.php',
            type: 'POST',
            data: 'idCompetence=' + idCompetence + '&nomCours=' + $("#nomCours").val() + '&nbCreditsCours=' + $("#nbCreditsCours").val() + '&semestreCours=' + $("select[id=semestreCours]").find(":selected").val(),
            success: function (data) {
                $("#addCours").modal("hide");
                // TODO : Gérer le cas où il n'y a pas de cours déjà créé (donc pas de last)
                $(data).insertAfter($("button[id^=orga_cours_]").last());
            }
        });
    });
});

$(function() {
    $('#addEval').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: './ajax/admin_ajax_orga.php',
            type: 'POST',
            data: 'idCours=' + idCours + '&nomEval=' + $("#nomEval").val() + '&coefEval=' + $("#coefEval").val(),
            success: function (data) {
                $("#addEval").modal("hide");
                // TODO : Gérer le cas où il n'y a pas de cours déjà créé (donc pas de last)
                $(data).insertAfter($("button[id^=orga_eval_]").last());
            }
        });
    });
});

$(function() {
    $('#addTypeEval').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: './ajax/admin_ajax_orga.php',
            type: 'POST',
            data: 'idEval=' + idEval + '&nomTypeEval=' + $("#nomTypeEval").val() + '&coefTypeEval=' + $("#coefTypeEval").val(),
            success: function (data) {
                $("#addTypeEval").modal("hide");
                // TODO : Gérer le cas où il n'y a pas de cours déjà créé (donc pas de last)
                $(data).insertAfter($("button[id^=orga_type_eval_]").last());
            }
        });
    });
});