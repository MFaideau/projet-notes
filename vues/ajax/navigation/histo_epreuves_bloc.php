<!-- Histogramme de données !-->

<div class="row donnees donnees_histo_epreuves">
    <div class="panel panel-default">
        <div class="panel-heading"><a href="#" id="histo_comp_<?php echo $competence->GetId(); ?>"><span
                    class="glyphicon glyphicon-arrow-left retour_prec_histo"></span></a>
            Histogramme Perso - Détail des Notes
        </div>
        <table class="table" data-toggle="table">
            <?php
            if (empty($epreuveList)) {
            } else { ?>
                <thead>
                <tr>
                    <th>Cours</th>
                    <th>Histogramme</th>
                    <th>Min</th>
                    <th>Max</th>
                    <th>Etudiant</th>
                </thead>
                <tbody>
                <?php
                foreach ($epreuvesList as $epreuve) { ?>
                    <tr>
                        <td scope="row"><a class="lien_tableau"><?php echo $epreuve->GetNom(); ?></a></td>
                        <td width="50%">
                            <?php
                            $note_etudiant = GetEtudiantNoteFromEtudiantEpreuve(GetEtudiant($user)->GetId(), $epreuve->GetId())->GetNoteFinale();
                            $tab_histo = GetStat(GetTabNotesEtudiantsFromEpreuve($epreuve->GetId()));
                            $moyenne = $tab_histo[0];
                            $ecart_type = $tab_histo[1];
                            $tab = showHisto($moyenne, $note_etudiant, $ecart_type);
                            include(__DIR__ . '../../modules/module_histo.php');
                            ?>
                        </td>
                        <td><?php echo round($tab_histo[2], 2); ?></td>
                        <td><?php echo round($tab_histo[3], 2); ?></td>
                        <td><?php echo round($note_etudiant, 2); ?></td>
                    </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                    <td>Total</td>
                    <td width="50%">
                        <?php
                        $note_etudiant = GetEtudiantNoteFromEtudiantEpreuve(GetEtudiant($user)->GetId(), $epreuve->GetId())->GetNoteFinale();
                        $tab_histo_total = GetStat(GetTabNotesEtudiantsFromEpreuve($epreuve->GetId()));
                        $moyenne = $tab_histo_total[0];
                        $ecart_type = $tab_histo_total[1];
                        $tab = showHisto($moyenne, $note_etudiant, $ecart_type);
                        include(__DIR__ . '../../modules/module_histo.php');
                        ?>
                    </td>
                    <td><b><?php echo round($tab_histo_total[2], 2); ?></b></td>
                    <td><?php echo round($tab_histo_total[3], 2); ?></td>
                    <td><?php echo round($note_etudiant, 2); ?></td>
                </tr>
                </tfoot>
            <?php } ?>
        </table>
    </div>
</div>