// TODO : Inclure ce fichier uniquement si on est connecté en ADMIN
var idCursus, idCompetence, idCours, idEval, idTypeEval, idEpreuve;

$(document).on("click", "button[id^=orga_cursus_]", function (e) {
    idCursus = this.id.replace("orga_cursus_", "");
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
            $(".panel_cursus").append(result);
            $("#competenceEdition").hide();
            // On récupère aussi des informations pour le bloc de modifications
            $.ajax({
                url: './ajax/admin_ajax_orga.php',
                type: 'POST',
                datatype: 'json',
                data: 'idCursus=' + idCursus +"&action=infos",
                success: function(result2) {
                    var current_cursus = jQuery.parseJSON(result2);
                    $("#modifyCursus input[id=idCursus]").val(idCursus);
                    $("#modifyCursus input[id=nomCursus]").val(current_cursus.nom);
                    $("#modifyCursus input[id=anneeCursus]").val(current_cursus.annee);
                }
            });
        },
        error: function (result) {
            alert("Erreur lors de la récupération des compétences. Veuillez réessayer.");
        }
    });
});

$(document).on("click", "button[id^=orga_competence_]", function (e) {
    idCompetence = this.id.replace("orga_competence_", "");
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
            $("#competenceEdition").show();
            $(result).insertAfter(".panel_competences");
            $("#coursEdition").hide();
            // On récupère aussi des informations pour le bloc de modifications
            $("#modifyCompetence input[id=id_competence_modif]").val(idCompetence);
            $("#modifyCompetence input[id=nomCompetence]").val(nomCompetence);
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
            $("#coursEdition").show();
            $(result).insertAfter($(".panel_cours"));
            $("#evalEdition").hide();

            // On récupère aussi des informations pour le bloc de modifications
            $.ajax({
                url: './ajax/admin_ajax_orga.php',
                type: 'POST',
                datatype: 'json',
                data: 'idCours=' + idCours +"&action=infos",
                success: function(result2) {
                    var current_cours = jQuery.parseJSON(result2);
                    $("#modifyCours input[id=nomCours]").val(current_cours.nom);
                    $("#modifyCours input[id=nbCreditsCours]").val(current_cours.credits);
                    $("#modifyCours #semestreCours option[value="+current_cours.semestre + "]").prop('selected',true);
                }
            });
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
            $("#evalEdition").show();
            $(result).insertAfter($(".panel_eval"));
            $("#typeEvalEdition").hide();
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
            $("#typeEvalEdition").show();
            $(result).insertAfter($(".panel_type_eval"));
            $("#epreuveEdition").hide();
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

$(document).on("click", "button[id^=orga_epreuve]", function (e) {
    idEpreuve = this.id.replace("orga_epreuve_", "");
    $.ajax({
        url: './ajax/admin_ajax_orga.php',
        type: 'POST',
        datatype: 'html',
        data: 'idEpreuve=' + idEpreuve,
        success: function (result) {
            $("#epreuveEdition").show();
            $(result).insertAfter($(".panel_epreuve"));
            $.ajax({
                url: './ajax/admin_ajax_orga.php',
                type: 'POST',
                datatype: 'json',
                data: 'idTypeEval=' + idTypeEval +"&action=secondesession",
                success: function(result2) {
                    var current_type_eval = jQuery.parseJSON(result2);
                    $("#modifyEpreuve select[id=selectSecondeSession]").empty().append('<option value="0">Aucune seconde session</option>');
                        $.each(current_type_eval, function(index) {
                            if(current_type_eval[index].id != idEpreuve) {
                                $("#modifyEpreuve select[id=selectSecondeSession]").append("<option value=" + current_type_eval[index].id + ">" +
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
                    $("#modifyEpreuve select[id=selectSubstitution]").empty().append('<option value="0">Pas de note en cas d\'absence</option>');
                    $.each(current_cours, function(index) {
                        if(current_cours[index].id != idEpreuve) {
                            $("#modifyEpreuve select[id=selectSubstitution]").append("<option value=" + current_cours[index].id + ">" +
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
                    $("#modifyEpreuve input[id=nomEpreuve]").val(current_epreuve.nom);
                    $("#modifyEpreuve input[id=coefEpreuve]").val(current_epreuve.coef);
                    $("#modifyEpreuve input[id=dateEpreuve]").val(current_epreuve.date);
                    $("#modifyEpreuve input[id=evaluateurEpreuve]").val(current_epreuve.evaluateur);
                    $("#modifyEpreuve #selectSecondeSession option[value="+current_epreuve.idSecondeSession + "]").prop('selected',true);
                    $("#modifyEpreuve #selectSubstitution option[value="+current_epreuve.idSubstition + "]").prop('selected',true);
                }
            });
        }
    });
});

$(function () {
    $('#addCursus').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: './ajax/admin_ajax_orga.php', //this is the submit URL
            type: 'POST', //or POST
            data: "action=add&nomCursus=" + $("#nomCursus").val() + "&anneeCursus=" + $("#anneeCursus").val(),
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
            data: 'action=add&idCursus=' + idCursus + '&nomCompetence=' + $("#nomCompetence").val(),
            success: function (data) {
                $("#addCompetence").modal("hide");
                $("button[id^=orga_cursus_"+idCursus+"]").trigger("click");
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
                $("button[id^=orga_competence_" + idCompetence + "]").trigger("click");
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
                $("button[id^=orga_cours_" + idCours + "]").trigger("click");
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
                $("button[id^=orga_eval_" + idEval + "]").trigger("click");
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
                $("button[id^=orga_type_eval_" + idTypeEval + "]").trigger("click");
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
$(function () {
    $('#verifDeleteEpreuve').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: './ajax/admin_ajax_orga.php',
            type: 'POST',
            data: "action=delete&idTypeEval=" + idTypeEval,
            success: function () {
                $("#verifDeleteEpreuve").modal("hide");
                $("button[id^=orga_epreuve_" + idEpreuve + "]").remove();
                $(".panel_epreuve").remove();
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
            }
        });
    });
});