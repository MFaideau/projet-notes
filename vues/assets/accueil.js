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
            $(".donnees_histo").remove();
            $(".donnees_tableaux").remove();
            $(".donnees_batons").remove();
            $(result).insertAfter($(".visualisation").parent());
            loadBar();
        }
    })
})
