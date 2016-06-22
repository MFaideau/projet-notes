<?php defined("ROOT_ACCESS") or die(); ?>
<!-- Histogramme de données !-->

<div class="row donnees donnees_histo">
    <div class="panel panel-default">
        <div class="panel-heading">
            Histogramme Personnel
            <div class="add_button_etudes">
                <a data-toggle="modal" data-target="#legendeHisto">
                    <i class="glyphicon glyphicon-info-sign"></i>
                </a>
            </div>
        </div>
        <table class="table" data-toggle="table">
            <thead>
            <tr>
                <th>Compétences</th>
                <th>Histogramme</th>
                <th>Min</th>
                <th>Max</th>
                <th>Etudiant</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($competenceList as $competence) { ?>
                <tr>
                    <td scope="row"><a class="lien_tableau"
                                       id="hist_comp_<?php echo $competence->GetId(); ?>"><b><?php echo $competence->GetNom(); ?></b></a>
                    </td>
                    <td width="50%">
                        <?php
                        $note_etudiant = GetMoyenneFromCompetence($competence->GetId(), $idEtudiant);
                        $tab_histo = GetStat(GetTabNotesEtudiantsFromCompetence($competence->GetId()));
                        $moyenne = $tab_histo[0];
                        $ecart_type = $tab_histo[1];
                        $min = round($tab_histo[2], 2);
                        $max = round($tab_histo[3], 2);
                        $tab = showHisto($moyenne, $note_etudiant, $ecart_type);
                        include('modules/module_histo.php');
                        ?>
                    </td>
                    <td><?php echo TestValidite($min); ?></td>
                    <td><?php echo TestValidite($max); ?></td>
                    <td><?php echo TestValidite(round($note_etudiant, 2)); ?></td>
                </tr>
            <?php } ?>
            </tbody>
            <tfoot>
            <tr>
                <td scope="row"><b>Moyenne Générale</b></td>
                <td width="50%">
                    <?php
                    $note_etudiant = GetMoyenneFromCursus($cursus->GetId(), $idEtudiant);
                    $tab_histo_total = GetStat(GetTabNotesEtudiantsFromCursus($cursus->GetId()));
                    $moyenne = $tab_histo_total[0];
                    $ecart_type = $tab_histo_total[1];
                    $min = round($tab_histo_total[2], 2);
                    $max = round($tab_histo_total[3], 2);
                    $tab = showHisto($moyenne, $note_etudiant, $ecart_type);
                    include('modules/module_histo.php');
                    ?>
                </td>
                <td><b><?php echo TestValidite($min); ?></b></td>
                <td><b><?php echo TestValidite($max); ?></b></td>
                <td><b><?php echo TestValidite(round($note_etudiant, 2)); ?></b></td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>

<!-- Formulaire d'aide histogramme !-->

<div class="modal fade" id="legendeHisto" tabindex="-1" role="dialog" aria-labelledby="legendeHisto">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addCompetence">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Légende des histogrammes</h4>
                </div>
                <div class="modal-body">
                    <svg width="100%" height="16px">
                        <defs>
                            <linearGradient id="histo" x1="0%" y1="0%" x2="123.73770356571%" y2="0%">
                                <stop offset="0%" style="stop-color:red;"></stop>
                                <stop offset="50%" style="stop-color:yellow;"></stop>
                                <stop offset="100%" style="stop-color:green;"></stop>
                            </linearGradient>
                        </defs>
                        <rect x="1" y="1" width="81%" height="15" fill="url(#histo)"></rect>
                        <rect x="1" y="1" width="99%" height="14.2" stroke-width="0.8" stroke="black" fill="transparent"></rect>
                        <g stroke="black">
                            <line x1="39%" y1="7.5" x2="69%" y2="7.5" stroke-width="1" stroke="black"></line>
                            <line x1="39%" y1="4.5" x2="39%" y2="10.5" stroke-width="1" stroke="black"></line>
                            <line x1="69%" y1="4.5" x2="69%" y2="10.5" stroke-width="1" stroke="black"></line>
                            <circle cx="54%" cy="7.5" r="2" stroke="black" stroke-width="3" fill="black"></circle>
                        </g>
                    </svg>

                    <ul>
                        <li>Le rond noir correspond à la moyenne de la promo</li>
                        <li>Les deux barres sur les cotés correspondent à l'écart-type</li>
                        <li>Le degradé correspond à votre note (Rouge: 0/20 ; Vert: 20/20)</li>
                    </ul>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>