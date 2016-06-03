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
    <link href="vues/assets/bootstrap/bootstrap-table.css" rel="stylesheet"/>
    <link href="vues/assets/style.css" rel="stylesheet"/>
    <link href="vues/assets/Page_principale.css" rel="stylesheet"/>
    <script src="vues/assets/js/jquery-1.12.4.min.js"></script>
    <script src="vues/assets/js/chart.js"></script>
    <script src="vues/assets/js/histo.js"></script>
    <script src="vues/assets/bootstrap/bootstrap-table.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="container">
    <div class="col-sm-8 col-sm-offset-2">
        <div class="row">
            <?php include_once ("infos.php"); ?>
            <?php include_once ("navbar.php"); ?>
        </div>