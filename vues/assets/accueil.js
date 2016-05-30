$('.tableaux_logo').click(function() {
    $(".donnees_tableaux").show();
    $(".donnees_histo").hide();
});
$('.histo_logo').click(function() {
    $(".donnees_tableaux").hide();
    $(".donnees_histo").show();
});