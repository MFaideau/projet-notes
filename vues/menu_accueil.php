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
    <link href="vues/assets/style.css" rel="stylesheet"/>
    <link href="vues/assets/page_principale.css" rel="stylesheet"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<div class="container">
    <div class="col-sm-8 col-sm-offset-2">
        <div class="row">
            <div class="col-lg-3 identite">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row"><span><strong>Joël GUILLEM</strong></span></div>
                        <div class="row"><span>CSI3</span></div>
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
                        <a href="#Competences">
                            <div class="col-md-6 bouton_competences">Gérer les compétences</div>
                        </a>
                        <a href="#Notes">
                            <div class="col-md-6 bouton_notes">Saisie des notes</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Selection entre les Tableaux et les Histogrammes !-->
        <div class="row">
            <div class="col-md-2 col-md-offset-10 visualisation">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <a href="#tableau_notes">
                            <span class="glyphicon glyphicon-list-alt icone"></span>
                        </a>
                        <a href="#histogramme_notes">
                            <span class="glyphicon glyphicon-align-left icone"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page de données !-->

        <div class="row donnees">
            <div class="panel panel-default">
                <div class="panel-heading">Relevé de notes</div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Compétences</th>
                        <th>Moyennes</th>
                        <th>ECTS</th>
                        <th>Grades</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">Informatique</th>
                        <td>12.2</td>
                        <td>15</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <th scope="row">Electronique</th>
                        <td>13.4</td>
                        <td>15</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <th scope="row">Management</th>
                        <td>13</td>
                        <td>15</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <th scope="row">Signaux</th>
                        <td>15</td>
                        <td>15</td>
                        <td>A</td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Total</th>
                        <th>XX</th>
                        <th>60</th>
                        <th>A</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Histogramme de données !-->
        <div>
            
        </div>
    </div>
</div>

</body>
</html>