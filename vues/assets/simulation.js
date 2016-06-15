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
    if($("tr[class^=simu_cours_comp_" + idCompetence + ']').is(":hidden"))
        $("tr[class^=simu_cours_comp_"+ idCompetence + "_id_]").show();
    else
        $("tr[class^=simu_cours_comp_" + idCompetence + "_id_]").hide();
});

// Pour le déroulé du cours
$(document).on("click", "a[id^=simu_cours_]", function (e) {
    idCours = this.id.replace("simu_cours_","");

    if($("tr[class^=simu_cours_" + idCours + "_id_]").is(":hidden"))
        $("tr[class^=simu_cours_"+ idCours + "_id_]").show();
    else
        $("tr[class^=simu_cours_" + idCours + "_id_").hide();
});

// Pour le déroulé du type eval
$(document).on("click", "a[id^=simu_cours_comp_" + idCompetence + "_id_]", function (e) {
    idTypeEval = this.id.replace("simu_cours_comp_" + idCompetence + "_id_","");
    alert(idTypeEval);
    if($("tr[class^=simu_cours_comp_" + idCompetence + ']').is(":hidden"))
        $("tr[class^=simu_cours_comp_"+ idCompetence + "_id_]").show();
    else
        $("tr[class^=simu_cours_comp_" + idCompetence + "_id_]").hide();
});

// Pour le déroulé de l'épreuve
$(document).on("click", "a[id^=simu_cours_comp_" + idCompetence + "_id_]", function (e) {
    idEpreuve = this.id.replace("simu_cours_comp_" + idCompetence + "_id_","");
    alert(idCours);
    if($("tr[class^=simu_cours_comp_" + idCompetence + ']').is(":hidden"))
        $("tr[class^=simu_cours_comp_"+ idCompetence + "_id_]").show();
    else
        $("tr[class^=simu_cours_comp_" + idCompetence + "_id_]").hide();
});
