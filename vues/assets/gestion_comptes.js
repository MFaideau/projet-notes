var mailOrigine;

$(function () {
    $('#insertAdmin').on('submit', function (e) {
        var newNom = $("#nomCompteInsert").val();
        var newPrenom = $("#prenomCompteInsert").val();
        var newMail = $("#mailCompteInsert").val();
        var newAutorite = $("#autoriteCompteInsert").val();
        if (newAutorite == "Administrateur")
            newAutorite = 1;
        else if (newAutorite == "Visiteur")
            newAutorite = 2;
        e.preventDefault();
        $.ajax({
            url: './gestion_comptes.php',
            type: 'POST',
            data: "action=insertAdmin&nom="+newNom+"&prenom="+newPrenom+"&mail="+newMail+"&autorite="+newAutorite,
            success: function () {
                $('#insertAdmin').modal("hide");
                location.reload();
            }
        });
    });
});

$(function () {
    $('#modifyAdmin').on('submit', function (e) {
        var newNom = $("#nomCompte").val();
        var newPrenom = $("#prenomCompte").val();
        var newMail = $("#mailCompte").val();
        var newAutorite = $("#autoriteCompte").val();
        if (newAutorite == "Administrateur")
            newAutorite = 1;
        else if (newAutorite == "Visiteur")
            newAutorite = 2;
        e.preventDefault();
        $.ajax({
            url: './gestion_comptes.php',
            type: 'POST',
            data: "action=modifyAdmin&mailOrigine="+mailOrigine+"&nom="+newNom+"&prenom="+newPrenom+"&mail="+newMail+"&autorite="+newAutorite,
            success: function () {
                document.getElementById("admin_tr_" + mailOrigine).id = "admin_tr_" + newMail;
                document.getElementById("delete_link_admin_" + mailOrigine).id = "delete_link_admin_" + newMail;
                document.getElementById("modify_link_admin_" + mailOrigine).id = "modify_link_admin_" + newMail;
                document.getElementById("admin_nom_" + mailOrigine).innerText = newNom;
                document.getElementById("admin_prenom_" + mailOrigine).innerText = newPrenom;
                document.getElementById("admin_mail_" + mailOrigine).innerText = newMail;
                if (newAutorite == 1)
                {
                    newAutorite = "Administrateur";
                }
                else if (newAutorite == 2)
                {
                    newAutorite = "Visiteur";
                }
                document.getElementById("admin_autorite_" + mailOrigine).innerText = newAutorite;
                document.getElementById("admin_nom_" + mailOrigine).id="admin_nom_" + newMail;
                document.getElementById("admin_prenom_" + mailOrigine).id="admin_prenom_" + newMail;
                document.getElementById("admin_mail_" + mailOrigine).id="admin_mail_" + newMail;
                document.getElementById("admin_autorite_" + mailOrigine).id="admin_autorite_" + newMail;
                $('#modifyAdmin').modal("hide");
            }
        });
    });
});

$(document).on("click", "a[id^=modify_link_admin_]", function (e) {
    mailOrigine = this.id.replace("modify_link_admin_", "");
    $("#nomCompte").val(document.getElementById("admin_nom_" + mailOrigine).innerText);
    $("#prenomCompte").val(document.getElementById("admin_prenom_" + mailOrigine).innerText);
    $("#mailCompte").val(mailOrigine);
    var autorite = document.getElementById("admin_autorite_" + mailOrigine).innerText;
    if (autorite == "Administrateur")
    {
        $("#autoriteCompte").val(1);
    }
    else if (autorite == "Visiteur")
    {
        $("#autoriteCompte").val(2);
    }
});

$(document).on("click", "a[id^=delete_link_admin_]", function (e) {
    mailOrigine = this.id.replace("delete_link_admin_", "");
});

$(function () {
    $('#deleteAdmin').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: './gestion_comptes.php',
            type: 'POST',
            data: "action=deleteAdmin&mail="+mailOrigine,
            success: function () {
                document.getElementById("admin_tr_" + mailOrigine).remove();
                $('#deleteAdmin').modal("hide");
            }
        });
    });
});