<!-- Histogramme en bâtons de données !-->

<div class="row donnees donnees_histo">
    <div class="panel panel-default">
        <div class="panel-heading">Histogramme Commun</div>
        <table class="table">
            <thead>
            <tr>
                <th>Compétences</th>
                <th>ECTS</th>
                <th>Max</th>
                <th>Etudiant</th>
                <th>Grade</th>
                <th>Hist.</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">Informatique</th>
                <td>13</td>
                <td>16.5</td>
                <td>15</td>
                <td>A</td>
                <td class="button_show_histo">
                    <a data-toggle="modal" data-target="#showHisto1">
                        <span class="glyphicon glyphicon-stats icone"></span>
                    </a>
                </td>
            </tr>
            <tr>
            <tr>
                <th scope="row">Electronique</th>
                <td>13</td>
                <td>16.5</td>
                <td>15</td>
                <td>A</td>
                <td class="button_show_histo">
                    <a data-toggle="modal" data-target="#showHisto1">
                        <span class="glyphicon glyphicon-stats icone"></span>
                    </a>
                </td>
            </tr>
            <tr>
                <th scope="row">Management</th>
                <td>13</td>
                <td>16.5</td>
                <td>15</td>
                <td>A</td>
                <td class="button_show_histo">
                    <a data-toggle="modal" data-target="#showHisto1">
                        <span class="glyphicon glyphicon-stats icone"></span>
                    </a>
                </td>
            </tr>
            <tr>
                <th scope="row">Signaux</th>
                <td>13</td>
                <td>16.5</td>
                <td>15</td>
                <td>A</td>
                <td class="button_show_histo">
                    <a data-toggle="modal" data-target="#showHisto1">
                        <span class="glyphicon glyphicon-stats icone"></span>
                    </a>
                </td>
            </tr>
            <tr>
                <th scope="row">Total</th>
                <td>13</td>
                <td>16.5</td>
                <td>15</td>
                <td>A</td>
                <td class="button_show_histo">
                    <a data-toggle="modal" data-target="#showHisto1">
                        <span class="glyphicon glyphicon-stats icone"></span>
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>


<!-- Fenêtres pour afficher les pop-ups des histogrammes !-->

<div class="modal fade" id="showHisto1" tabindex="-1" role="dialog" aria-labelledby="showHisto">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Histogramme de la Promo</h4>
            </div>
            <div class="modal-body">
                <div class="row donnees donnees_batons">
                    <canvas id="myChart" width="100%" height="40%"></canvas>
                </div>
            </div>
            <?php include_once("modules/module_histo.php"); ?>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>