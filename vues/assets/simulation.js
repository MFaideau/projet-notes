$(document).on("click","a[id^=note_simulee_]", function(e) {
    var idEpreuve = this.id.replace("note_simulee_","");
    var note = $("input[id^=number_" + idEpreuve + "]").val();
    $.ajax({
        url: './ajax/simulation.php',
        type: 'POST',
        datatype: 'html',
        data: 'idEpreuve=' + idEpreuve + '&note=' + note,
        success: function(result) {
            $("span[id=note_" + idEpreuve + "]").html(note);
        }
    });
});