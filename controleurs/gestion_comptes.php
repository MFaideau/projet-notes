<?php
include_once (__DIR__ . '/../modeles/sqlConnection.php');
include_once (__DIR__ . '/../modeles/authentification/utilisateur.class.php');

defined("ROOT_ACCESS") or die();
if (!isset($_SESSION['user'])) {
   header('Location: index.php');
    die();
}
else {
    $user = unserialize($_SESSION['user']);
    if ($user->GetAutorite() != 1) {
        header('Location: accueil.php');
        die();
    }
    $usersList = GetAdmins();
    include_once ('./vues/menu.php');
    include_once ('./vues/gestion_comptes.php');
    include_once ('./vues/footer.php');
    
    if (isset($_POST['action'])) {
        if (($_POST['action']=="modifyAdmin") && isset($_POST['mailOrigine']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['autorite'])) {
            ModifyUser($_POST['mailOrigine'], $_POST['nom'], $_POST['prenom'],$_POST['mail'],$_POST['autorite'] );
        }
        if (($_POST['action']=="deleteAdmin") && isset($_POST['mail'])) {
            DeleteUser($_POST['mail']);
        }
        if (($_POST['action']=="insertAdmin") && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['autorite'])) {
            InsertUser($_POST['nom'],$_POST['prenom'],$_POST['mail'],$_POST['autorite']);
        }
    }
}

