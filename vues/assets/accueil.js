$('.tableaux_logo').click(function () {
    $.ajax({
        url: './ajax/accueil.php',
        type: 'POST',
        datatype: 'html',
        data: 'button=tableaux',
        success: function (result) {
            $(".donnees_tableaux").remove();
            $(".donnees_tableaux_cours").remove();
            $(".donnees_tableaux_epreuves").remove();
            $(".donnees_batons").remove();
            $(".donnees_histo").remove();
            $(".donnees_histo_cours").remove();
            $(".donnees_histo_epreuves").remove();
            $(".donnees_tableaux").remove();
            $(".absences").remove();
            $(".panel_choix_eleves").remove();
            $(".donnees_tableaux_cours").remove();
            $(".donnees_histo_com_cours").remove();
            $(".donnees_histo_com_epreuves").remove();
            $(result).insertAfter($(".visualisation").parent());
            jQuery.getScript('./vues/assets/bootstrap/bootstrap-table.js');
        }
    });
});

$('.histo_logo').click(function () {
    $.ajax({
        url: './ajax/accueil.php',
        type: 'POST',
        datatype: 'html',
        data: 'button=histog',
        success: function (result) {
            $(".donnees_tableaux").remove();
            $(".donnees_tableaux_cours").remove();
            $(".donnees_tableaux_epreuves").remove();
            $(".donnees_batons").remove();
            $(".donnees_histo").remove();
            $(".donnees_histo_cours").remove();
            $(".donnees_histo_epreuves").remove();
            $(".absences").remove();
            $(".panel_choix_eleves").remove();
            $(".donnees_histo_cours").remove();
            $(".donnees_histo_epreuves").remove();
            $(".donnees_histo_com_cours").remove();
            $(".donnees_histo_com_epreuves").remove();
            $(result).insertAfter($(".visualisation").parent());
            jQuery.getScript('./vues/assets/bootstrap/bootstrap-table.js');
        }
    });
});

$('.histo_commun').click(function () {
    $.ajax({
        url: './ajax/accueil.php',
        type: 'POST',
        datatype: 'html',
        data: 'button=batons',
        success: function (result) {
            $(".donnees_tableaux").remove();
            $(".donnees_tableaux_cours").remove();
            $(".donnees_tableaux_epreuves").remove();
            $(".donnees_batons").remove();
            $(".panel_choix_eleves").remove();
            $(".donnees_histo").remove();
            $(".donnees_histo_cours").remove();
            $(".donnees_histo_epreuves").remove();
            $(".donnees_histo_com_cours").remove();
            $(".donnees_histo_com_epreuves").remove();
            $(".absences").remove();
            $(result).insertAfter($(".visualisation").parent());
            jQuery.getScript('./vues/assets/bootstrap/bootstrap-table.js');
        }
    });
});

$('.abs').click(function () {
    $.ajax({
        url: './absence.php',
        type: 'GET',
        datatype: 'html',
        success: function (result) {
            $(".donnees_tableaux_epreuves").remove();
            $(".donnees_tableaux_cours").remove();
            $(".donnees_tableaux").remove();
            $(".donnees_batons").remove();
            $(".donnees_histo").remove();
            $(".absences").remove();
            $(".panel_choix_eleves").remove();
            $(".donnees_histo_com_cours").remove();
            $(".donnees_histo_com_epreuves").remove();
            $(result).insertAfter($(".visualisation").parent());
            jQuery.getScript('./vues/assets/bootstrap/bootstrap-table.js');
            loadAbsenceChart();
        }
    });
});


//// =================== PARTIE SIMULATION ==============================

$('.simulationmanuelle').click(function () {
    $.ajax({
        url: './simulation.php',
        type: 'GET',
        datatype: 'html',
        success: function (result) {
            $(".menu").remove();
            $(".navbar").remove();
            $(result).insertAfter($(".visualisation").parent());
        }
    });
});
