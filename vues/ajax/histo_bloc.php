<!-- Histogramme de données !-->

<div class="row donnees donnees_histo">
    <div class="panel panel-default">
        <div class="panel-heading">Graphe comparatoire</div>
        <table class="table">
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
            foreach($competenceList as $competence)
            { ?>
                <tr>
                    <th scope="row"><a class="lien_tableau" id="hist_comp_<?php echo $competence->GetId(); ?>"><?php echo $competence->GetNom(); ?></a></th>
                    <td width="50%">
                        <?php
                        $note_etudiant = GetMoyenneFromCompetence($competence->GetId(), $etudiant->GetId());
                        $tab_histo = GetStat(GetTabNotesEtudiantsFromCompetence($competence->GetId()));
                        $moyenne = $tab_histo[0];
                        $ecart_type = $tab_histo[1];
                        $tab = showHisto($moyenne, $note_etudiant, $ecart_type);
                        include('modules/module_histo.php');
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
                <th scope="row">Total</th>
                <td width="50%">
                    <?php
                    $note_etudiant = GetMoyenneFromCursus($cursus->GetId(), $etudiant->GetId());
                    $tab_histo_total = GetStat(GetTabNotesEtudiantsFromCursus($cursus->GetId()));
                    $moyenne = $tab_histo_total[0];
                    $ecart_type = $tab_histo_total[1];
                    $tab = showHisto($moyenne, $note_etudiant, $ecart_type);
                    include('modules/module_histo.php');
                    ?>
                </td>
                <td><strong><?php echo round($tab_histo_total[2],2); ?></strong></td>
                <th><?php echo round($tab_histo_total[3],2); ?></th>
                <th><?php echo round($note_etudiant,2); ?></th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>