<!-- Histogramme de données !-->

<div class="row donnees donnees_histo">
    <div class="panel panel-default">
        <div class="panel-heading">Histogramme Personnel</div>
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
            foreach($competenceList as $competence)
            { ?>
                <tr>
                    <td scope="row"><a class="lien_tableau" id="hist_comp_<?php echo $competence->GetId(); ?>"><b><?php echo $competence->GetNom(); ?></b></a></td>
                    <td width="50%">
                        <?php
                        $note_etudiant = GetMoyenneFromCompetence($competence->GetId(), GetEtudiant($user)->GetId());
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
                <td scope="row"><b>Total</b></td>
                <td width="50%">
                    <?php
                    $note_etudiant = GetMoyenneFromCursus(GetEtudiant($user)->GetCursus()->GetId(), GetEtudiant($user)->GetId());
                    $tab_histo_total = GetStat(GetTabNotesEtudiantsFromCursus(GetEtudiant($user)->GetCursus()->GetId()));
                    $moyenne = $tab_histo_total[0];
                    $ecart_type = $tab_histo_total[1];
                    $tab = showHisto($moyenne, $note_etudiant, $ecart_type);
                    include('modules/module_histo.php');
                    ?>
                </td>
                <td><b><?php echo round($tab_histo_total[2],2); ?></b></td>
                <td><b><?php echo round($tab_histo_total[3],2); ?></b></td>
                <td><b><?php echo round($note_etudiant,2); ?></b></td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>