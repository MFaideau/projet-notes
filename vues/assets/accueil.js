$('.tableaux_logo').click(function() {
    $.ajax({
        url: './ajax/accueil.php',
        type: 'POST',
        datatype: 'html',
        data: 'button=tableaux',
        success: function(result) {
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
            $(".donnees_histo").remove();
            $(result).insertAfter($(".visualisation").parent());
        }
    });
});