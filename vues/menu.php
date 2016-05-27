<?php
/**
 * @Auteur : Joël Guillem
 * @Description : Fichier de vue pour la page menu visible après la connexion
 */
include_once ('./modeles/authentification/utilisateur.class.php');
$user = unserialize($_SESSION['user']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Menu</title>
    <link href="vues/assets/bootstrap/bootstrap.css" rel="stylesheet"/>
    <link href="vues/assets/style.css" rel="stylesheet"/>
    <link href="vues/assets/page_principale.css" rel="stylesheet"/>
    <script src="vues/assets/js/jquery-1.12.4.min.js"></script>
    <script src="vues/assets/js/bootstrap.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="container">
    <div class="col-sm-8 col-sm-offset-2">
        <div class="row">
            <div class="col-lg-3 identite">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row"><span><strong><?php echo $user->GetPrenom() . ' ' . $user->GetNom(); ?></strong></span></div>
                        <div class="row"><span><?php echo $user->GetCursusTexte(); ?></span></div>
                        <div class="row">
                            <a href="index.php?action=disconnect">
                                <div class="disconnect">Se déconnecter</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 menu_rapide">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <a href="accueil.php">
                            <div class="col-md-2">
                                <span class="glyphicon glyphicon-home"></span>
                            </div>
                        </a>
                        <a href="#Competences">
                            <div class="col-md-5 bouton_competences">Gérer les compétences</div>
                        </a>
                        <a href="saisie_notes.php">
                            <div class="col-md-5 bouton_notes">Saisie des notes</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>