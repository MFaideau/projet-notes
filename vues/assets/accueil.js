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
                url: './vues/ajax/modules/conversion_js.php',
                type: 'GET',
                datatype: 'json',
                success: function (resultDataHisto) {
                    $(".donnees_tableaux").remove();
                    $(".donnees_batons").remove();
                    $(".donnees_histo").remove();
                    $(".absences").remove();
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
            $(result).insertAfter($(".visualisation").parent());
        }
    });
});