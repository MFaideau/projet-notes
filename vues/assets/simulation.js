var idCompetence, idCours, idTypeEval, idEpreuve;

$(document).ready(function() {
    $("tr[class^=simu_cours_comp_]").hide();
    $("td[id^=nom_comp_]").parent().hide();
    $("td[id^=nom_type_eval]").parent().hide();
    $("td[id^=nom_epreuve]").parent().hide();
});

// Pour le déroulé de la compétence
$(document).on("click", "a[id^=simu_comp_id_]", function (e) {
    idCompetence = this.id.replace("simu_comp_id_","");
    if($("tr[class^=simu_cours_comp_" + idCompetence + ']').is(":hidden")) {
        $("tr[class^=simu_cours_comp_" + idCompetence + "_id_]").show();
    }
    else {
        $("tr[class^=simu_cours_comp_" + idCompetence + "_id_]").hide();
        $("span[id^=typeEval_comp_]").hide();
        $("tr[class^=simu_type_eval_]").hide();
        $("tr[id=typeEval_comp_" + idCompetence + "]").hide();
    }
});

// Pour le déroulé du cours
$(document).on("click", "a[id^=simu_cours_]", function (e) {
    idCours = this.id.replace("simu_cours_", "");
    if ($("tr[class^=simu_cours_" + idCours + "_type_eval_]").is(":hidden")) {
        $("tr[class^=simu_cours_" + idCours + "_type_eval_]").show();
    }
    else {
        $("tr[class^=simu_cours_" + idCours + "_type_eval_").hide();
        $("tr[class^=simu_type_eval_]").hide();
    }
});

// Pour le déroulé du type eval
$(document).on("click", "a[id^=simu_type_eval_]", function (e) {
    idTypeEval = this.id.replace("simu_type_eval_","");
    if($("tr[class^=simu_type_eval_"+ idTypeEval + "_epreuve_]").is(":hidden"))
        $("tr[class^=simu_type_eval_"+ idTypeEval + "_epreuve_]").show();
    else
        $("tr[class^=simu_type_eval_"+ idTypeEval + "_epreuve_]").hide();
});

// ***************** Enregistrement des valeurs saisies *****************

$("input[name^=note_epreuve_]").keypress(function(e) {
    if(e.which == 13) {
        var idEpreuveSim = this.name.replace("note_epreuve_","");
        setNoteSimulee(idEpreuveSim, $(this).val());
    }
});

function setNoteSimulee(idEpreuve, valeurNote) {
    if ((valeurNote > 20 || valeurNote < 0) && valeurNote != -1)
        return;

    $.ajax({
        url: './ajax/calculSimulation.php',
        type: 'POST',
        datatype: 'json',
        data: 'action=changeNoteEpreuve&idEpreuve=' + idEpreuve + '&noteSimulee=' + valeurNote,
        success: function (result) {
            changeNotes(result);
        }
    });
}

function changeNotes(resultat) {
    // On parse le JSON reçu
    var changes = jQuery.parseJSON(resultat);
    for(var k in changes) {
        var note = changes[k];
        if(note.type == "competence") {
            var competenceBloc = $("a[id=simu_comp_id_" + note.id + "]").parent().parent().find($("td"))[2];
            if(note.value == -1)
                competenceBloc.innerHTML = "<b>-</b>";
            else
                competenceBloc.innerHTML = "<b>"+ note.value +"</b>";
        }
        if(note.type == "cours") {
            var blocCours = $("a[id=simu_cours_" + note.id + "]").parent().parent().find($("td"))[2];
            if(note.value == -1)
                blocCours.innerHTML = "<b>-</b>";
            else
                blocCours.innerHTML = "<b>" + note.value + "</b>";
        }
        if(note.type == "typeEval") {
            var blocTypeEval = $("a[id=simu_type_eval_" + note.id + "]").parent().parent().find($("td"))[2];
            if(note.value == -1)
                blocTypeEval.innerHtml = "<b>-</b>";
            else
                blocTypeEval.innerHTML = "<b>" + note.value + "</b>";
        }
        if(note.type == "moyenne") {
            var blocEpreuve = $("#moyenne_generale")[0];
            if(note.value == -1)
                blocEpreuve.innerHTML = "<b>-</b>";
            else
                blocEpreuve.innerHTML = "<b>" + note.value + "</b>";
        }

    }
}