// TODO : Inclure ce fichier uniquement si on est connecté en ADMIN
var idCursus, idCompetence, idCours, idEval, idTypeEval, idEpreuve;

$(document).on("click", "button[id^=orga_cursus_]", function (e) {
    idCursus = this.id.replace("orga_cursus_", "");
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
//            $(".panel_cours").append(result);
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


// TODO : Gérer le cas où aucun bouton n'a été coché
$(document).on("click", "a[id^=removeCursus]", function (e) {
    e.preventDefault();
    $.ajax({
        url: './ajax/admin_ajax_orga.php', //this is the submit URL
        type: 'POST', //or POST
        data: "action=delete&idCursus=" + idCursus,
        success: function (result) {
            $("button[id^=orga_cursus_" + idCursus + "]").remove();
        }
    });
});

$(document).on("click", "a[id^=removeCompetence]", function (e) {
    e.preventDefault();
    $.ajax({
        url: './ajax/admin_ajax_orga.php', //this is the submit URL
        type: 'POST', //or POST
        data: "action=delete&idCompetence=" + idCompetence,
        success: function () {
            $("button[id^=orga_competence_" + idCompetence + "]").remove();
        }
    });
});

$(document).on("click", "a[id^=removeCours]", function (e) {
    e.preventDefault();
    $.ajax({
        url: './ajax/admin_ajax_orga.php', //this is the submit URL
        type: 'POST', //or POST
        data: "action=delete&idCours=" + idCours,
        success: function () {
            $("button[id^=orga_cours_" + idCours + "]").remove();
            $("button[id^=orga_competence_" + idCompetence + "]").trigger("click");
        }
    });
});

$(document).on("click", "a[id^=removeEval]", function (e) {
    e.preventDefault();
    $.ajax({
        url: './ajax/admin_ajax_orga.php', //this is the submit URL
        type: 'POST', //or POST
        data: "action=delete&idEval=" + idEval,
        success: function () {
            $("button[id^=orga_eval_" + idEval + "]").remove();
            $("button[id^=orga_cours_" + idCours + "]").trigger("click");
        }
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
                var btn_orga_competence = $("button[id^=orga_competence_]");
                if (btn_orga_competence.length == 0) {
                    $(data).insertAfter($(".panel_competences .panel-body .btn-group"));
                }
                // Sinon, on le met dans le contenu du panel (sans btn-group, il se rajoutera tout seul après refresh).
                else {
                    $(data).insertAfter((btn_orga_competence).last());
                }
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
                // S'il y a déjà au moins 1 bouton, il le met à la fin.
                var btn_orga_cours = $("button[id^=orga_cours_]");
                if (btn_orga_cours.length == 0) {
                    alert("test1");
                    $(data).insertAfter($(".panel_cours .panel-body .btn-group"));
                }
                // Sinon, on le met dans le contenu du panel (sans btn-group, il se rajoutera tout seul après refresh).
                else {
                    alert("test");
                    $(data).insertAfter((btn_orga_cours).last());
                }
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
                var btn_orga_eval = $("button[id^=orga_eval_]");
                if (btn_orga_eval.length == 0) {
                    $(data).insertAfter($(".panel_eval .panel-body .btn-group"));
                }
                // Sinon, on le met dans le contenu du panel (sans btn-group, il se rajoutera tout seul après refresh).
                else {
                    $(data).insertAfter((btn_orga_eval).last());
                }
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
                var btn_orga_type = $("button[id^=orga_type_eval_]");
                if (btn_orga_type.length == 0) {
                    $(data).insertAfter($(".panel_type_eval .panel-body .btn-group"));
                }
                // Sinon, on le met dans le contenu du panel (sans btn-group, il se rajoutera tout seul après refresh).
                else {
                    $(data).insertAfter((btn_orga_type).last());
                }
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
            data: 'idTypeEval=' + idTypeEval + '&nomEpreuve=' + $("#nomEpreuve").val() + '&coefEpreuve=' + $("#coefEpreuve").val(),
            success: function (data) {
                $("#addEpreuve").modal("hide");
                var btn_orga_epreuve = $("button[id^=orga_epreuve_]");
                if (btn_orga_epreuve.length == 0) {
                    $(data).insertAfter($(".panel_epreuve .panel-body .btn-group"));
                }
                // Sinon, on le met dans le contenu du panel (sans btn-group, il se rajoutera tout seul après refresh).
                else {
                    $(data).insertAfter((btn_orga_epreuve).last());
                }
            }
        });
    });
});