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
            <?php
            foreach($competenceList as $competence)
            { ?>
            <tr>
                <th scope="row"><a class="lien_tableau" id="hist_com_<?php echo $competence->GetId(); ?>"><?php echo $competence->GetNom(); ?></a></th>
                <td><?php echo $competence->GetCredits(); ?></td>
                <td>
                    <?php
                    $note_etudiant = GetMoyenneFromCompetence($competence->GetId(), GetEtudiant($user)->GetId());
                    $tab_histo = GetStat(GetTabNotesEtudiantsFromCompetence($competence->GetId()));
                    $min = round($tab_histo[2],2);
                    $max = round($tab_histo[3],2);
                    echo $min;
                    ?>
                </td>
                <td><?php echo $max; ?></td>
                <td><?php echo round($note_etudiant,2); ?></td>
                <td>A</td>
                <td class="button_show_histo">
                    <a id="histo_batons_<?php echo $competence->GetNom(); ?>" data-toggle="modal" data-target="#showHisto1">
                        <span class="glyphicon glyphicon-stats icone histo_button"></span>
                    </a>
                </td>
            </tr>
            <?php } ?>
            </tbody>
            <tfoot>
            <tr>
                <th scope="row">Moyenne Gé.</th>
                <td><?php echo $cursus->GetCredits(); ?></td>
                <td>
                    <?php
                    $note_etudiant = round(GetMoyenneFromCursus(GetEtudiant($user)->GetCursus()->GetId(), GetEtudiant($user)->GetId()),2);
                    $tab_histo_total = GetStat(GetTabNotesEtudiantsFromCursus(GetEtudiant($user)->GetCursus()->GetId()));
                    $min = round($tab_histo_total[2],2);
                    $max = round($tab_histo_total[3],2);
                    echo $min;
                    ?>
                </td>
                <td><?php echo $max; ?></td>
                <td><?php echo round($note_etudiant,2); ?></td>
                <td>A</td>
                <td class="button_show_histo">
                    <a id="histo_batons_generale" data-toggle="modal" data-target="#showHisto1">
                        <span class="glyphicon glyphicon-stats icone histo_button"></span>
                    </a>
                </td>
            </tr>
            </tfoot>
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