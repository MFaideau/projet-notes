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
            $(result).insertAfter(".panel_competences");

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
            $(".panel_eval").remove();
            $(".panel_epreuve").remove();
            $(".panel_upload_epreuve").remove();
            $(result).insertAfter($(".panel_cours"));

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
            $.ajax({
                url: './ajax/admin_ajax_orga.php',
                type: 'POST',
                datatype: 'json',
                data: 'idTypeEval=' + idTypeEval +"&action=infos",
                success: function(result2) {
                    var current_type_eval = jQuery.parseJSON(result2);
                    $("#addEpreuve select[id=secondeSession]").empty().append('<option value="0">Aucune seconde session</option>');
                    $.each(current_type_eval, function(index) {
                        $("#addEpreuve #secondeSession").append("<option value=" + current_type_eval[index].id + ">" +
                            current_type_eval[index].nom + "</option>");
                    });
                }
            });
        },
    });
});

$(document).on("click", "button[id^=orga_epreuve]", function (e) {
    var idEpreuve = this.id.replace("orga_epreuve_", "");
    $.ajax({
        url: './ajax/admin_ajax_orga.php',
        type: 'POST',
        datatype: 'html',
        data: 'idEpreuve=' + idEpreuve,
        success: function (result) {
            $(result).insertAfter($(".panel_epreuve"));
            $.ajax({
                url: './ajax/admin_ajax_orga.php',
                type: 'POST',
                datatype: 'json',
                data: 'idTypeEval=' + idTypeEval +"&action=infos",
                success: function(result2) {
                    var current_type_eval = jQuery.parseJSON(result2);
                    $("#modifyEpreuve select[id=secondeSession]").empty().append('<option value="0">Aucune seconde session</option>');
                    $.each(current_type_eval, function(index) {
                        if(current_type_eval[index].id != idEpreuve) {
                            $("#modifyEpreuve #secondeSession").append("<option value=" + current_type_eval[index].id + ">" +
                                current_type_eval[index].nom + "</option>");
                        }
                    });
                }
            });
            $.ajax({
                url: './ajax/admin_ajax_orga.php',
                type: 'POST',
                datatype: 'json',
                data: 'idEpreuve=' + idEpreuve + "&action=infos",
                success: function(result2) {
                    var current_epreuve= jQuery.parseJSON(result2);

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
            data: 'idCompetence=' + idCompetence + '&nomCours=' + $("#nomCours").val() + '&nbCreditsCours=' + $("#nbCreditsCours").val() + '&semestreCours=' + $("select[id=semestreCours]").find(":selected").val(),
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
            data: 'idCours=' + idCours + '&nomEval=' + $("#nomEval").val() + '&coefEval=' + $("#coefEval").val(),
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
            data: 'idEval=' + idEval + '&nomTypeEval=' + $("#nomTypeEval").val() + '&coefTypeEval=' + $("#coefTypeEval").val(),
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
            data: 'idTypeEval=' + idTypeEval + '&nomEpreuve=' + $("#nomEpreuve").val() + '&coefEpreuve=' + $("#coefEpreuve").val() + '&dateEpreuve=' + $("#dateEpreuve").val() + '&evaluateurEpreuve=' + $("#evaluateurEpreuve").val() + '&idSecondeSession=' + $("#addEpreuve option:selected").val()+ '&idEpreuveSubstitution=' + 0,
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