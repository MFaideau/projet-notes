// TODO : Inclure ce fichier uniquement si on est connecté en ADMIN
var idCursus, idCompetence, idCours, idEval, idTypeEval, idEpreuve;

$(document).on("click", "a[id^=orga_cursus_]", function (e) {
    if (document.getElementById("orga_cursus_" + idCursus) != null){
        document.getElementById("orga_cursus_" + idCursus).style.fontWeight = "normal";
        document.getElementById("orga_tr_cursus_" + idCursus).style.backgroundColor = "white";
    }
    idCursus = this.id.replace("orga_cursus_", "");
    document.getElementById("orga_cursus_" + idCursus).style.fontWeight = "bold";
    document.getElementById("orga_tr_cursus_" + idCursus).style.backgroundColor = "cornsilk";
    // On place le nom du cursus choisit dans le formulaire de modification au cas où
    $.ajax({
        url: './ajax/admin_ajax_orga.php',
        type: 'POST',
        datatype: 'html',
        data: 'idCursus=' + idCursus,
        success: function (result) {
            $(".panel_competences").remove();
            $(".panel_cours").remove();
            $(".panel_eval").remove();
            $(".panel_type_eval").remove();
            $(".panel_epreuve").remove();
            $(".panel_upload_epreuve").remove();
            $(result).insertAfter(".panel_cursus");
            jQuery.getScript('./vues/assets/bootstrap/bootstrap-table.js');
        },
        error: function (result) {
            alert("Erreur lors de la récupération des compétences. Veuillez réessayer.");
        }
    });
});

$(document).on("click", "a[id^=orga_competence_]", function (e) {
    if (document.getElementById("orga_competence_" + idCompetence) != null){
        document.getElementById("orga_competence_" + idCompetence).style.fontWeight = "normal";
        document.getElementById("orga_tr_competence_" + idCompetence).style.backgroundColor = "white";
    }
    idCompetence = this.id.replace("orga_competence_", "");
    document.getElementById("orga_competence_" + idCompetence).style.fontWeight = "bold";
    document.getElementById("orga_tr_competence_" + idCompetence).style.backgroundColor = "cornsilk";
    nomCompetence = this.innerText;
    $.ajax({
        url: './ajax/admin_ajax_orga.php',
        type: 'POST',
        datatype: 'html',
        data: 'idCompetence=' + idCompetence,
        success: function (result) {
            $(".panel_cours").remove();
            $(".panel_type_eval").remove();
            $(".panel_epreuve").remove();
            $(".panel_eval").remove();
            $(".panel_upload_epreuve").remove();
            $(result).insertAfter(".panel_competences");
            jQuery.getScript('./vues/assets/bootstrap/bootstrap-table.js');
        },
        error: function (result) {
            alert("Erreur lors de la récupération des compétences. Veuillez réessayer.");
        }
    });
});

$(document).on("click", "a[id^=orga_cours]", function (e) {
    if (document.getElementById("orga_cours_" + idCours) != null){
        document.getElementById("orga_cours_" + idCours).style.fontWeight = "normal";
        document.getElementById("orga_tr_cours_" + idCours).style.backgroundColor = "white";
    }
    idCours = this.id.replace("orga_cours_", "");
    document.getElementById("orga_cours_" + idCours).style.fontWeight = "bold";
    document.getElementById("orga_tr_cours_" + idCours).style.backgroundColor = "cornsilk";
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
            jQuery.getScript('./vues/assets/bootstrap/bootstrap-table.js');
        },
    });
});

$(document).on("click", "a[id^=orga_eval]", function (e) {
    if (document.getElementById("orga_eval_" + idEval) != null){
        document.getElementById("orga_eval_" + idEval).style.fontWeight = "normal";
        document.getElementById("orga_tr_eval_" + idEval).style.backgroundColor = "white";
    }
    idEval = this.id.replace("orga_eval_", "");
    document.getElementById("orga_eval_" + idEval).style.fontWeight = "bold";
    document.getElementById("orga_tr_eval_" + idEval).style.backgroundColor = "cornsilk";
    $.ajax({
        url: './ajax/admin_ajax_orga.php',
        type: 'POST',
        datatype: 'html',
        data: 'idEval=' + this.id.replace("orga_eval_", ""),
        success: function (result) {
            $(".panel_type_eval").remove();
            $(".panel_epreuve").remove();
            $(result).insertAfter($(".panel_eval"));
            jQuery.getScript('./vues/assets/bootstrap/bootstrap-table.js');
        },
    });
});

$(document).on("click", "a[id^=orga_type_eval]", function (e) {
    if (document.getElementById("orga_type_eval_" + idTypeEval) != null){
        document.getElementById("orga_type_eval_" + idTypeEval).style.fontWeight = "normal";
        document.getElementById("orga_tr_type_eval_" + idTypeEval).style.backgroundColor = "white";
    }
    idTypeEval = this.id.replace("orga_type_eval_", "");
    document.getElementById("orga_type_eval_" + idTypeEval).style.fontWeight = "bold";
    document.getElementById("orga_tr_type_eval_" + idTypeEval).style.backgroundColor = "cornsilk";
    $.ajax({
        url: './ajax/admin_ajax_orga.php',
        type: 'POST',
        datatype: 'html',
        data: 'idTypeEval=' + this.id.replace("orga_type_eval_", ""),
        success: function (result) {
            $(".panel_epreuve").remove();
            $(result).insertAfter($(".panel_type_eval"));
            jQuery.getScript('./vues/assets/bootstrap/bootstrap-table.js');
            $.ajax({
                url: './ajax/admin_ajax_orga.php',
                type: 'POST',
                datatype: 'json',
                data: 'idTypeEval=' + idTypeEval +"&action=secondesession",
                success: function(result2) {
                    var current_type_eval = jQuery.parseJSON(result2);
                    $("#addEpreuve select[id=selectSecondeSession]").empty().append('<option value="0">Aucune seconde session</option>');
                    $.each(current_type_eval, function(index) {
                        $("#addEpreuve select[id=selectSecondeSession]").append("<option value=" + current_type_eval[index].id + ">" +
                            current_type_eval[index].nom + "</option>");
                    });
                }
            });
            $.ajax({
                url: './ajax/admin_ajax_orga.php',
                type: 'POST',
                datatype: 'json',
                data: 'idCours=' + idCours +"&action=substitution",
                success: function(result2) {
                    var current_cours = jQuery.parseJSON(result2);
                    $("#addEpreuve select[id=selectSubstitution]").empty().append('<option value="0">Pas de note en cas d\'absence</option>');
                    $.each(current_cours, function(index) {
                        $("#addEpreuve select[id=selectSubstitution]").append("<option value=" + current_cours[index].id + ">" +
                            current_cours[index].nom + "</option>");
                    });
                }
            });
        },
    });
});

$(document).on("click", "a[id^=orga_epreuve]", function (e) {
    if (document.getElementById("orga_epreuve_" + idEpreuve) != null){
        document.getElementById("orga_epreuve_" + idEpreuve).style.fontWeight = "normal";
        document.getElementById("orga_tr_epreuve_" + idEpreuve).style.backgroundColor = "white";
    }
    idEpreuve = this.id.replace("orga_epreuve_", "");
    document.getElementById("orga_epreuve_" + idEpreuve).style.fontWeight = "bold";
    document.getElementById("orga_tr_epreuve_" + idEpreuve).style.backgroundColor = "cornsilk";

});

$(function () {
    $('form[id=addCursus]').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: './ajax/admin_ajax_orga.php', //this is the submit URL
            type: 'POST', //or POST
            data: "action=add&nomCursus=" + $("#nomCursus").val() + "&anneeCursus=" + $("#anneeCursus").val(),
            success: function (data) {
                $("#addCursus").modal("hide");
                $(data).insertAfter($("a[id^=orga_cursus_]").parent().parent().last());
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
            $("a[id^=orga_type_eval_" + idTypeEval + "]").remove();
            $("a[id^=orga_eval_" + idEval + "]").trigger("click");
        }
    });
});

$(function () {
    $('#addCompetence').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: './ajax/admin_ajax_orga.php',
            type: 'POST',
            data: 'action=add&idCursus=' + idCursus + '&nomCompetence=' + $("#nomCompetence").val(),
            success: function (data) {
                $("#addCompetence").modal("hide");
                $("a[id^=orga_cursus_"+idCursus+"]").trigger("click");
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
            data: 'action=add&idCompetence=' + idCompetence + '&nomCours=' + $("#nomCours").val() + '&nbCreditsCours=' + $("#nbCreditsCours").val() + '&semestreCours=' + $("select[id=semestreCours]").find(":selected").val(),
            success: function (data) {
                $("#addCours").modal("hide");
                $("a[id^=orga_competence_" + idCompetence + "]").trigger("click");
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
            data: 'action=add&idCours=' + idCours + '&nomEval=' + $("#nomEval").val() + '&coefEval=' + $("#coefEval").val(),
            success: function (data) {
                $("#addEval").modal("hide");
                $("a[id^=orga_cours_" + idCours + "]").trigger("click");
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
            data: 'action=add&idEval=' + idEval + '&nomTypeEval=' + $("#nomTypeEval").val() + '&coefTypeEval=' + $("#coefTypeEval").val(),
            success: function (data) {
                $("#addTypeEval").modal("hide");
                $("a[id^=orga_eval_" + idEval + "]").trigger("click");
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
            data: 'action=add&idTypeEval=' + idTypeEval + '&nomEpreuve=' + $("#nomEpreuve").val() + '&coefEpreuve=' + $("#coefEpreuve").val() + '&dateEpreuve=' + $("#dateEpreuve").val() + '&evaluateurEpreuve=' + $("#evaluateurEpreuve").val() + '&idSecondeSession=' + $("#addEpreuve select[id=selectSecondeSession] option:selected").val() + '&idEpreuveSubstitution=' + $("#addEpreuve select[id=selectSubstitution] option:selected").val(),
            success: function (data) {
                $("#addEpreuve").modal("hide");
                $("a[id^=orga_type_eval_" + idTypeEval + "]").trigger("click");
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
                $("tr[id=orga_tr_cursus_" + idCursus + "]").remove();
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
                $("tr[id=orga_tr_competence_" + idCompetence + "]").remove();
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
                $("tr[id=orga_tr_cours_" + idCours + "]").remove();
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
                $("tr[id=orga_tr_eval_" + idEval + "]").remove();
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
                $("tr[id=orga_tr_type_eval_" + idTypeEval + "]").remove();
                $(".panel_epreuve").remove();
            }
        });
    });
});
$(function () {
    $('#verifDeleteEpreuve').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: './ajax/admin_ajax_orga.php',
            type: 'POST',
            data: "action=delete&idEpreuve=" + idEpreuve,
            success: function () {
                $("#verifDeleteEpreuve").modal("hide");
                $("tr[id=orga_tr_epreuve_" + idEpreuve + "]").remove();
            }
        });
    });
});

$(function () {
    $('#modifyCursus').on('submit', function (e) {
        var newNomCursus = $("#modifyCursus input[id=nomCursus]").val();
        var newAnneeCursus = $("#modifyCursus input[id=anneeCursus]").val();
        e.preventDefault();
        $.ajax({
            url: './ajax/admin_ajax_orga.php',
            type: 'POST',
            data: "action=modify&idCursus=" + idCursus + "&nomCursus=" + newNomCursus + "&anneeCursus=" + newAnneeCursus,
            success: function () {
                $("#modifyCursus").modal("hide");
                $("#orga_cursus_" + idCursus).text(newNomCursus);
                $("#orga_cursus_annee_" + idCursus).text(newAnneeCursus);
            }
        });
    });
});

$(function () {
    $('#modifyCompetence').on('submit', function (e) {
        var newNomCompetence = $("#modifyCompetence input[id=nomCompetence]").val();
        e.preventDefault();
        $.ajax({
            url: './ajax/admin_ajax_orga.php',
            type: 'POST',
            data: "action=modify&idCompetence=" + idCompetence + "&nomCompetence=" + newNomCompetence,
            success: function () {
                $("#modifyCompetence").modal("hide");
                $("#orga_competence_" + idCompetence).text(newNomCompetence);
            }
        });
    });
});
$(function () {
    $('#modifyCours').on('submit', function (e) {
        var newNomCours = $("#modifyCours input[id=nomCours]").val();
        var newCreditsCours = $("#modifyCours input[id=nbCreditsCours]").val();
        var newSemestreCours = $("#modifyCours select[id=semestreCours]").val();
        e.preventDefault();
        $.ajax({
            url: './ajax/admin_ajax_orga.php',
            type: 'POST',
            data: "action=modify&idCours=" + idCours + "&nomCours=" + newNomCours + "&creditsCours=" + newCreditsCours + "&semestreCours=" + newSemestreCours,
            success: function () {
                $("#modifyCours").modal("hide");
                $("#orga_cours_" + idCours).text(newNomCours);
                $("#orga_cours_credits_" + idCours).text(newCreditsCours);
                if (newSemestreCours == 0)
                    $("#orga_cours_semestre_" + idCours).text("Semestres 1 et 2");
                else if (newSemestreCours == 1)
                    $("#orga_cours_semestre_" + idCours).text("Semestre 1");
                else if (newSemestreCours == 2)
                    $("#orga_cours_semestre_" + idCours).text("Semestre 2");
            }
        });
    });
});
$(function () {
    $('#modifyEval').on('submit', function (e) {
        var newNomEval = $("#modifyEval input[id=nomEval]").val();
        var newCoefEval = $("#modifyEval input[id=coefEval]").val();
        e.preventDefault();
        $.ajax({
            url: './ajax/admin_ajax_orga.php',
            type: 'POST',
            data: "action=modify&idEval=" + idEval + "&nomEval=" + newNomEval + "&coefEval=" + newCoefEval,
            success: function () {
                $("#modifyEval").modal("hide");
                $("#orga_eval_" + idEval).text(newNomEval);
                $("#orga_eval_coef_" + idEval).text(newCoefEval);
            }
        });
    });
});
$(function () {
    $('#modifyTypeEval').on('submit', function (e) {
        var newNomTypeEval = $("#modifyTypeEval input[id=nomTypeEval]").val();
        var newCoefTypeEval = $("#modifyTypeEval input[id=coefTypeEval]").val();
        e.preventDefault();
        $.ajax({
            url: './ajax/admin_ajax_orga.php',
            type: 'POST',
            data: "action=modify&idTypeEval=" + idTypeEval + "&nomTypeEval=" + newNomTypeEval + "&coefTypeEval=" + newCoefTypeEval,
            success: function () {
                $("#modifyTypeEval").modal("hide");
                $("#orga_type_eval_" + idTypeEval).text(newNomTypeEval);
                $("#orga_type_eval_coef_" + idTypeEval).text(newCoefTypeEval);
            }
        });
    });
});
$(function () {
    $('#modifyEpreuve').on('submit', function (e) {
        var newNomEpreuve = $("#modifyEpreuve input[id=nomEpreuve]").val();
        var newCoefEpreuve = $("#modifyEpreuve input[id=coefEpreuve]").val();
        var newDateEpreuve = $("#modifyEpreuve input[id=dateEpreuve]").val();
        var newEvaluateurEpreuve = $("#modifyEpreuve input[id=evaluateurEpreuve]").val();
        var newSecondeSessionEpreuve = $("#modifyEpreuve select[id=selectSecondeSession]").val();
        var newSubstitutionEpreuve = $("#modifyEpreuve select[id=selectSubstitution]").val();
        e.preventDefault();
        $.ajax({
            url: './ajax/admin_ajax_orga.php',
            type: 'POST',
            data: "action=modify&idEpreuve=" + idEpreuve + "&nomEpreuve=" + newNomEpreuve + "&coefEpreuve=" + newCoefEpreuve + "&dateEpreuve=" + newDateEpreuve + "&evaluateurEpreuve=" + newEvaluateurEpreuve + "&secondeSessionEpreuve=" + newSecondeSessionEpreuve + "&substitutionEpreuve=" + newSubstitutionEpreuve,
            success: function () {
                $("#modifyEpreuve").modal("hide");
                $("#orga_epreuve_" + idEpreuve).text(newNomEpreuve);
                $("#orga_epreuve_coef_" + idEpreuve).text(newCoefEpreuve);
                $("#orga_epreuve_date_" + idEpreuve).text(newDateEpreuve);
                $("#orga_epreuve_evaluateur_" + idEpreuve).text(newEvaluateurEpreuve);
            }
        });
    });
});
// ==========================================================
// MODIFICATION
// ==========================================================
$(document).on("click", "a[id^=orga_modify_cursus_]", function (e) {
    var idCursus = this.id.replace("orga_modify_cursus_", "");
    $("a[id^=orga_cursus_"+idCursus+"]").trigger("click");
    // On récupère aussi des informations pour le bloc de modifications
    $.ajax({
        url: './ajax/admin_ajax_orga.php',
        type: 'POST',
        datatype: 'json',
        data: 'idCursus=' + idCursus + "&action=infos",
        success: function (result2) {
            var current_cursus = jQuery.parseJSON(result2);
            $("#modifyCursus input[id=idCursus]").val(idCursus);
            $("#modifyCursus input[id=nomCursus]").val(current_cursus.nom);
            $("#modifyCursus input[id=anneeCursus]").val(current_cursus.annee);
        }
    });
});
$(document).on("click", "a[id^=orga_delete_cursus_]", function (e) {
    var idCursus = this.id.replace("orga_delete_cursus_", "");
    $("a[id^=orga_cursus_"+idCursus+"]").trigger("click");
    document.getElementById("lienSauvegardeCursus").href= "organisation_etudes.php?idCursusSauvegarde="+idCursus;
});

$(document).on("click", "a[id^=orga_modify_competence_]", function (e) {
    var idCompetence = this.id.replace("orga_modify_competence_", "");
    $("a[id^=orga_competence_"+idCompetence+"]").trigger("click");
    // On récupère aussi des informations pour le bloc de modifications
    $.ajax({
        url: './ajax/admin_ajax_orga.php',
        type: 'POST',
        datatype: 'json',
        data: 'idCompetence=' + idCompetence + "&action=infos",
        success: function (result2) {
            var current_competence = jQuery.parseJSON(result2);
            $("#modifyCompetence input[id=id_competence_modif]").val(idCompetence);
            $("#modifyCompetence input[id=nomCompetence]").val(current_competence.nom);
        }
    });
});
$(document).on("click", "a[id^=orga_delete_competence_]", function (e) {
    var idCompetence = this.id.replace("orga_delete_competence_", "");
    $("a[id^=orga_competence_"+idCompetence+"]").trigger("click");
});


$(document).on("click", "a[id^=orga_modify_cours_]", function (e) {
    var idCours = this.id.replace("orga_modify_cours_", "");
    $("a[id^=orga_cours_"+idCours+"]").trigger("click");
    // On récupère aussi des informations pour le bloc de modifications
    $.ajax({
        url: './ajax/admin_ajax_orga.php',
        type: 'POST',
        datatype: 'json',
        data: 'idCours=' + idCours + "&action=infos",
        success: function (result2) {
            var current_cours = jQuery.parseJSON(result2);
            $("#modifyCours input[id=nomCours]").val(current_cours.nom);
            $("#modifyCours input[id=nbCreditsCours]").val(current_cours.credits);
            $("#modifyCours #semestreCours option[value=" + current_cours.semestre + "]").prop('selected', true);
        }
    });
});
$(document).on("click", "a[id^=orga_delete_cours_]", function (e) {
    var idCours = this.id.replace("orga_delete_cours_", "");
    $("a[id^=orga_cours_"+idCours+"]").trigger("click");
});

$(document).on("click", "a[id^=orga_modify_eval_]", function (e) {
    var idEval = this.id.replace("orga_modify_eval_", "");
    $("a[id^=orga_eval_"+idEval+"]").trigger("click");
    // On récupère aussi des informations pour le bloc de modifications
    // On récupère aussi des informations pour le bloc de modifications
    $.ajax({
        url: './ajax/admin_ajax_orga.php',
        type: 'POST',
        datatype: 'json',
        data: 'idEval=' + idEval +"&action=infos",
        success: function(result2) {
            var current_eval = jQuery.parseJSON(result2);

            $("#modifyEval input[id=nomEval]").val(current_eval.nom);
            $("#modifyEval input[id=coefEval]").val(current_eval.coef);
        }
    });
});
$(document).on("click", "a[id^=orga_delete_eval_]", function (e) {
    var idEval = this.id.replace("orga_delete_eval_", "");
    $("a[id^=orga_eval_"+idEval+"]").trigger("click");
});

$(document).on("click", "a[id^=orga_modify_type_eval_]", function (e) {
    var idTypeEval = this.id.replace("orga_modify_type_eval_", "");
    $("a[id^=orga_type_eval_"+idTypeEval+"]").trigger("click");
    // On récupère aussi des informations pour le bloc de modifications
    $.ajax({
        url: './ajax/admin_ajax_orga.php',
        type: 'POST',
        datatype: 'json',
        data: 'idTypeEval=' + idTypeEval +"&action=infos",
        success: function(result2) {
            var current_eval = jQuery.parseJSON(result2);
            $("#modifyTypeEval input[id=nomTypeEval]").val(current_eval.nom);
            $("#modifyTypeEval input[id=coefTypeEval]").val(current_eval.coef);
        }
    });
});
$(document).on("click", "a[id^=orga_delete_type_eval_]", function (e) {
    var idTypeEval = this.id.replace("orga_delete_type_eval_", "");
    $("a[id^=orga_type_eval_"+idTypeEval+"]").trigger("click");
});

$(document).on("click", "a[id^=orga_modify_epreuve_]", function (e) {
    var idEpreuve = this.id.replace("orga_modify_epreuve_", "");
    $("a[id^=orga_epreuve_"+idEpreuve+"]").trigger("click");
    var modifyEpreuveDiv = $("#modifyEpreuve");
    // On récupère aussi des informations pour le bloc de modifications
    $.ajax({
        url: './ajax/admin_ajax_orga.php',
        type: 'POST',
        datatype: 'json',
        data: 'idTypeEval=' + idTypeEval +"&action=secondesession",
        success: function(result2) {
            var current_type_eval = jQuery.parseJSON(result2);
            modifyEpreuveDiv.find("select[id=selectSecondeSession]").empty().append('<option value="0">Aucune seconde session</option>');
            $.each(current_type_eval, function(index) {
                if(current_type_eval[index].id != idEpreuve) {
                    modifyEpreuveDiv.find("select[id=selectSecondeSession]").append("<option value=" + current_type_eval[index].id + ">" +
                        current_type_eval[index].nom + "</option>");
                }
            });
        }
    });
    $.ajax({
        url: './ajax/admin_ajax_orga.php',
        type: 'POST',
        datatype: 'json',
        data: 'idCours=' + idCours +"&action=substitution",
        success: function(result2) {
            var current_cours = jQuery.parseJSON(result2);
            modifyEpreuveDiv.find("select[id=selectSubstitution]").empty().append('<option value="0">Pas de note en cas d\'absence</option>');
            $.each(current_cours, function(index) {
                if(current_cours[index].id != idEpreuve) {
                    modifyEpreuveDiv.find("select[id=selectSubstitution]").append("<option value=" + current_cours[index].id + ">" +
                        current_cours[index].nom + "</option>");
                }
            });
        }
    });
    $.ajax({
        url: './ajax/admin_ajax_orga.php',
        type: 'POST',
        datatype: 'json',
        data: 'idEpreuve=' + idEpreuve +"&action=infos",
        success: function(result2) {
            var current_epreuve = jQuery.parseJSON(result2);
            modifyEpreuveDiv.find("input[id=nomEpreuve]").val(current_epreuve.nom);
            modifyEpreuveDiv.find("input[id=coefEpreuve]").val(current_epreuve.coef);
            modifyEpreuveDiv.find("input[id=dateEpreuve]").val(current_epreuve.date);
            modifyEpreuveDiv.find("input[id=evaluateurEpreuve]").val(current_epreuve.evaluateur); modifyEpreuveDiv.find("#selectSecondeSession option[value="+current_epreuve.idSecondeSession + "]").prop('selected',true);
            modifyEpreuveDiv.find("#selectSubstitution option[value="+current_epreuve.idSubstition + "]").prop('selected',true);
        }
    });
});
$(document).on("click", "a[id^=orga_delete_epreuve_]", function (e) {
    var idEpreuve = this.id.replace("orga_delete_epreuve_", "");
    $("a[id^=orga_epreuve_"+idEpreuve+"]").trigger("click");
});