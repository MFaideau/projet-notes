// TODO : Inclure ce fichier uniquement si on est connecté en ADMIN

$("button").click(function() {
    $.ajax({
        url: './ajax/admin_ajax_infos.php',
        type: 'POST',
        datatype: 'html',
        data: 'idCursus=' + this.id.replace("cursus_",""),
        success: function(result){
            $(".panel_competences").remove();
            $(".panel_cursus").append(result);
    }});
});