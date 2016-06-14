<!-- Histogramme de données !-->

<div class="row donnees donnees_histo_cours">
    <div class="panel panel-default">
        <div class="panel-heading "><a href="releve_onglet.php"><span class="glyphicon glyphicon-arrow-left retour_prec_histo"></span></a>
            Histogramme Perso - Choix du cours
        </div>
        <table class="table" data-toggle="table">
            <thead>
            <tr>
                <th>Cours</th>
                <th>Histogramme</th>
                <th>Min</th>
                <th>Max</th>
                <th>Etudiant</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($coursList as $cours) { ?>
                <tr>
                    <td scope="row"><a class="lien_tableau" id="hist_cours_<?php echo $cours->GetId(); ?>"><b><?php echo $cours->GetNom(); ?></b></a></th>
                    <td width="50%">
                        <?php
                        $note_etudiant = GetMoyenneFromCours($cours->GetId(), GetEtudiant($user)->GetId());
                        $tab_histo = GetStat(GetTabNotesEtudiantsFromCours($cours->GetId()));
                        $moyenne = $tab_histo[0];
                        $ecart_type = $tab_histo[1];
                        $tab = showHisto($moyenne, $note_etudiant, $ecart_type);
                        include (__DIR__ . '../../modules/module_histo.php');
                        ?>
                    </td>
                    <td><?php echo round($tab_histo[2],2); ?></td>
                    <td><?php echo round($tab_histo[3],2); ?></td>
                    <td><?php echo round($note_etudiant,2); ?></td>
                </tr>
            <?php } ?>
            </tbody>
            <tfoot>
            <tr>
                <td><b>Total</b></td>
                <td width="50%"><b>
                    <?php
                    $note_etudiant = GetMoyenneFromCompetence(GetCompetenceFromCours($cours->GetId())->GetId(), GetEtudiant($user)->GetId());
                    $tab_histo_total = GetStat(GetTabNotesEtudiantsFromCompetence(GetCompetenceFromCours($cours->GetId())->GetId()));
                    $moyenne = $tab_histo_total[0];
                    $ecart_type = $tab_histo_total[1];
                    $tab = showHisto($moyenne, $note_etudiant, $ecart_type);
                    include(__DIR__ . '../../modules/module_histo.php');
                    ?>
                        </b></td>
                <td><b><?php echo round($tab_histo_total[2],2); ?></b></td>
                <td><b><?php echo round($tab_histo_total[3],2); ?></b></td>
                <td><b><?php echo round($note_etudiant,2); ?></b></td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>