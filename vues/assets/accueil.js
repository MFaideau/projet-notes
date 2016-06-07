$('.tableaux_logo').click(function() {
    $.ajax({
        url: './ajax/accueil.php',
        type: 'POST',
        datatype: 'html',
        data: 'button=tableaux',
        success: function(result) {
            $(".donnees_batons").remove();
            $(".donnees_histo").remove();
            $(".donnees_tableaux").remove();
            $(".absences").remove();
            $(".panel_choix_eleves").remove();
            $(result).insertAfter($(".visualisation").parent());
        }
    });
});

$('.histo_logo').click(function() {
    $.ajax({
        url: './ajax/accueil.php',
        type: 'POST',
        datatype: 'html',
        data: 'button=histog',
        success: function (result) {
            $(".donnees_tableaux").remove();
            $(".donnees_batons").remove();
            $(".donnees_histo").remove();
            $(".absences").remove();
            $(".panel_choix_eleves").remove();
            $(result).insertAfter($(".visualisation").parent());
        }
    });
});

$('.histo_commun').click(function() {
    $.ajax({
        url: './ajax/accueil.php',
        type: 'POST',
        datatype: 'html',
        data: 'button=batons',
        success: function (result) {
            $.ajax({
                url: './conversion_js.php',
                type: 'GET',
                datatype: 'json',
                success: function (resultDataHisto) {
                    $(".donnees_tableaux").remove();
                    $(".donnees_batons").remove();
                    $(".donnees_histo").remove();
                    $(".absences").remove();
                    $(".panel_choix_eleves").remove();
                    $(result).insertAfter($(".visualisation").parent());
                    loadBar(resultDataHisto);
                }
            });
        }
    });
});

$('.abs').click(function() {
    $.ajax({
        url: './absence.php',
        type: 'GET',
        datatype: 'html',
        success: function (result) {
            $(".donnees_tableaux").remove();
            $(".donnees_batons").remove();
            $(".donnees_histo").remove();
            $(".absences").remove();
            $(".panel_choix_eleves").remove();
            $(result).insertAfter($(".visualisation").parent());
        }
    });
});


//// =================== PARTIE SIMULATION ==============================

$('.simulationmanuelle').click(function() {
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
