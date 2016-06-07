<!-- Histogramme en bâtons de données !-->

<div class="row donnees donnees_histo">
    <div class="panel panel-default">
        <div class="panel-heading">Histogramme Commun</div>
        <table class="table">
            <thead>
            <tr>
                <th>Compétences</th>
                <th>ECTS</th>
                <th>Min</th>
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
                <td><?php echo $tab_histo_info[2]; ?></td>
                <td><?php echo $tab_histo_info[3]; ?></td>
                <td><?php echo $tab_info[0]; ?></td>
                <td>A</td>
                <td class="button_show_histo">
                    <a data-toggle="modal" data-target="#showHisto1">
                        <span class="glyphicon glyphicon-stats icone histo_button"></span>
                    </a>
                </td>
            </tr>
            <tr>
            <tr>
                <th scope="row">Electronique</th>
                <td>13</td>
                <td><?php echo $tab_histo_elec[2]; ?></td>
                <td><?php echo $tab_histo_elec[3]; ?></td>
                <td><?php echo $tab_elec[0]; ?></td>
                <td>A</td>
                <td class="button_show_histo">
                    <a data-toggle="modal" data-target="#showHisto1">
                        <span class="glyphicon glyphicon-stats icone histo_button"></span>
                    </a>
                </td>
            </tr>
            <tr>
                <th scope="row">Management</th>
                <td>13</td>
                <td><?php echo $tab_histo_manage[2]; ?></td>
                <td><?php echo $tab_histo_manage[3]; ?></td>
                <td><?php echo $tab_manage[0]; ?></td>
                <td>A</td>
                <td class="button_show_histo">
                    <a data-toggle="modal" data-target="#showHisto1">
                        <span class="glyphicon glyphicon-stats icone histo_button"></span>
                    </a>
                </td>
            </tr>
            <tr>
                <th scope="row">Signaux</th>
                <td>13</td>
                <td><?php echo $tab_histo_signaux[2]; ?></td>
                <td><?php echo $tab_histo_signaux[3]; ?></td>
                <td><?php echo $tab_signaux[0]; ?></td>
                <td>A</td>
                <td class="button_show_histo">
                    <a data-toggle="modal" data-target="#showHisto1">
                        <span class="glyphicon glyphicon-stats icone histo_button"></span>
                    </a>
                </td>
            </tr>
            <tr>
                <th scope="row">Total</th>
                <td>13</td>
                <td><?php echo $tab_histo_total[2]; ?></td>
                <td><?php echo $tab_histo_total[3]; ?></td>
                <td><?php echo $tab_total[0]; ?></td>
                <td>A</td>
                <td class="button_show_histo">
                    <a data-toggle="modal" data-target="#showHisto1">
                        <span class="glyphicon glyphicon-stats icone histo_button"></span>
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
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>