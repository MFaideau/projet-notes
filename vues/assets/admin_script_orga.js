// TODO : Inclure ce fichier uniquement si on est connecté en ADMIN
var idCursus, idCompetence, idCours, idEval, idTypeEval, idEpreuve;

$(document).on("click", "button[id^=orga_cursus_]", function (e) {
    idCursus = this.id.replace("orga_cursus_", "");
    // On place le nom du cursus choisit dans le formulaire de modification au cas où
    $("#modifyCursus input[id=nomCursus]").val($(this).text());

    $.ajax({
        url: './ajax/admin_ajax_orga.php',
        type: 'POST',
        datatype: 'html',
        data: 'idCursus=' + this.id.replace("orga_cursus_", ""),
        success: function (result) {
            $(".panel_competences").remove();
            $(".panel_cours").remove();
            $(".panel_eval").remove();
            $(".panel_type_eval").remove();
            $(".panel_epreuve").remove();
            $(".panel_upload_epreuve").remove();
            $(".panel_cursus").append(result);
        },
        error: function (result) {
            alert("Erreur lors de la récupération des compétences. Veuillez réessayer.");
        }
    });
});

$(document).on("click", "button[id^=orga_competence_]", function (e) {
    idCompetence = this.id.replace("orga_competence_", "");
    $.ajax({
        url: './ajax/admin_ajax_orga.php',
        type: 'POST',
        datatype: 'html',
        data: 'idCompetence=' + this.id.replace("orga_competence_", ""),
        success: function (result) {
            $(".panel_cours").remove();
            $(".panel_type_eval").remove();
            $(".panel_epreuve").remove();
            $(".panel_eval").remove();
            $(".panel_upload_epreuve").remove();
            $(result).insertAfter(".panel_competences");
        },
        error: function (result) {
            alert("Erreur lors de la récupération des compétences. Veuillez réessayer.");
        }
    });
});

$(document).on("click", "button[id^=orga_cours]", function (e) {
    idCours = this.id.replace("orga_cours_", "");
    $.ajax({
        url: './ajax/admin_ajax_orga.php',
        type: 'POST',
        datatype: 'html',
        data: 'idCours=' + this.id.replace("orga_cours_", ""),
        success: function (result) {
            $(".panel_eval").remove();
            $(".panel_type_eval").remove();
            $(".panel_eval").remove();
            $(".panel_epreuve").remove();
            $(".panel_upload_epreuve").remove();
            $(result).insertAfter($(".panel_cours"));
        },
    });
});

$(document).on("click", "button[id^=orga_eval]", function (e) {
    idEval = this.id.replace("orga_eval_", "");
    $.ajax({
        url: './ajax/admin_ajax_orga.php',
        type: 'POST',
        datatype: 'html',
        data: 'idEval=' + this.id.replace("orga_eval_", ""),
        success: function (result) {
            $(".panel_type_eval").remove();
            $(".panel_epreuve").remove();
            $(result).insertAfter($(".panel_eval"));
        },
    });
});

$(document).on("click", "button[id^=orga_type_eval]", function (e) {
    idTypeEval = this.id.replace("orga_type_eval_", "");
    $.ajax({
        url: './ajax/admin_ajax_orga.php',
        type: 'POST',
        datatype: 'html',
        data: 'idTypeEval=' + this.id.replace("orga_type_eval_", ""),
        success: function (result) {
            $(".panel_epreuve").remove();
            $(result).insertAfter($(".panel_type_eval"));
        },
    });
});

$(document).on("click", "button[id^=orga_epreuve]", function (e) {
    $.ajax({
        url: './ajax/admin_ajax_orga.php',
        type: 'POST',
        datatype: 'html',
        data: 'idEpreuve=' + this.id.replace("orga_epreuve_", ""),
        success: function (result) {
            $(result).insertAfter($(".panel_epreuve"));
        }
    });
});

$(function () {
    $('#addCursus').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: './ajax/admin_ajax_orga.php', //this is the submit URL
            type: 'POST', //or POST
            data: "nomCursus=" + $("#nomCursus").val() + "&anneeCursus=" + $("#anneeCursus").val(),
            success: function (data) {
                $("#addCursus").modal("hide");
                $(data).insertAfter($("button[id^=orga_cursus_]").parent().last());
            }
        });
    });
});

$(document).on("click", "a[id^=removeTypeEval]", function (e) {
    e.preventDefault();
    $.ajax({
        url: './ajax/admin_ajax_orga.php', //this is the submit URL
        type: 'POST', //or POST
        data: "action=delete&idTypeEval=" + idTypeEval,
        success: function () {
            $("button[id^=orga_type_eval_" + idTypeEval + "]").remove();
            $("button[id^=orga_eval_" + idEval + "]").trigger("click");
        }
    });
});

$(function () {
    $('#addCompetence').on('submit', function (e) {
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

$(function () {
    $('#addCours').on('submit', function (e) {
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

$(function () {
    $('#addEval').on('submit', function (e) {
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

$(function () {
    $('#addTypeEval').on('submit', function (e) {
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

$(function () {
    $('#addEpreuve').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: './ajax/admin_ajax_orga.php',
            type: 'POST',
            data: 'idTypeEval=' + idTypeEval + '&nomEpreuve=' + $("#nomEpreuve").val() + '&coefEpreuve=' + $("#coefEpreuve").val() + '&dateEpreuve=' + $("#dateEpreuve").val(),
            success: function (data) {
                $("#addEpreuve").modal("hide");
                // TODO : Gérer le cas où il n'y a pas de cours déjà créé (donc pas de last)
                $(data).insertAfter($("button[id^=orga_epreuve_]").last());
            }
        });
    });
});

// Partie qui vérifie que l'utilisateur veut vraiment supprimer son choix

$(function () {
    $('#verifDeleteCursus').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: './ajax/admin_ajax_orga.php', //this is the submit URL
            type: 'POST',
            data: "action=delete&idCursus=" + idCursus,
            success: function (result) {
                $("#verifDeleteCursus").modal("hide");
                $("button[id^=orga_cursus_" + idCursus + "]").remove();
                $(".panel_competences").remove();
                $(".panel_cours").remove();
                $(".panel_eval").remove();
                $(".panel_type_eval").remove();
                $(".panel_epreuve").remove();
            }
        });
    });
});

$(function () {
    $('#verifDeleteCompetences').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: './ajax/admin_ajax_orga.php',
            type: 'POST',
            data: "action=delete&idCompetence=" + idCompetence,
            success: function () {
                $("#verifDeleteCompetences").modal("hide");
                $("button[id^=orga_competence_" + idCompetence + "]").remove();
                $(".panel_cours").remove();
                $(".panel_type_eval").remove();
                $(".panel_epreuve").remove();
                $(".panel_eval").remove();
            }
        });
    });
});

$(function () {
    $('#verifDeleteCours').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: './ajax/admin_ajax_orga.php',
            type: 'POST', //or POST
            data: "action=delete&idCours=" + idCours,
            success: function () {
                $("#verifDeleteCours").modal("hide");
                $("button[id^=orga_cours_" + idCours + "]").remove();
                $(".panel_eval").remove();
                $(".panel_type_eval").remove();
                $(".panel_epreuve").remove();
            }
        });
    });
});

$(function () {
    $('#verifDeleteEval').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: './ajax/admin_ajax_orga.php',
            type: 'POST', 
            data: "action=delete&idEval=" + idEval,
            success: function () {
                $("#verifDeleteEval").modal("hide");
                $("button[id^=orga_eval_" + idEval + "]").remove();
                $(".panel_type_eval").remove();
                $(".panel_epreuve").remove();
            }
        });
    });
});

$(function () {
    $('#verifDeleteTypeEval').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: './ajax/admin_ajax_orga.php',
            type: 'POST',
            data: "action=delete&idTypeEval=" + idTypeEval,
            success: function () {
                $("#verifDeleteTypeEval").modal("hide");
                $("button[id^=orga_type_eval_" + idTypeEval + "]").remove();
                $(".panel_epreuve").remove();
            }
        });
    });
});