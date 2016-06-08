$(document).on("click", "a[id^=releve_comp_]", function (e) {
    var idCompetence = this.id.replace("releve_comp_","");
    $.ajax({
        url: './ajax/releve.php',
        type: 'POST',
        datatype: 'html',
        data: 'idCompetence=' + idCompetence,
        success: function (result) {
            $(result).insertAfter($(".donnees_tableaux"));
            $(".donnees_tableaux").remove();
        }
    });
});