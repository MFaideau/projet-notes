<?php
/**
 * @Auteur : Joël Guillem
 * @Description : Fichier de vue pour la page menu visible après la connexion
 */
?>
<!DOCTYPE html>
<html>
<head>
    <title>Menu</title>
    <link href="vues/assets/bootstrap/bootstrap.css" rel="stylesheet"/>
    <link href="vues/assets/page_principale.css" rel="stylesheet"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <!-- IF ADMIN !-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-6 col-md-offset-3">
                                <a href="#Gérer"><div class="connect_button">Gérer les compétences</div></a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-6 col-md-offset-3">
                                <a href="#Notes"><div class="connect_button">Rentrer les notes</div></a>
                            </div>
                        </div>
                    </div>
                    <!-- ELSE !-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-6 col-md-offset-3">
                                <a href="#Notes"><div class="connect_button">Relevé de notes</div></a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-6 col-md-offset-3">
                                <a href="#Simulation"><div class="connect_button">Simulation</div></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <span class="glyphicon glyphicon-list-alt"></span>
                </div>
            </div>
        </div>

    </div>
</div>
</body>
</html>