<!-- Histogramme de données !-->

<div class="row donnees donnees_histo_epreuves">
    <div class="panel panel-default">
        <div class="panel-heading"><a href="#" id="histo_comp_<?php echo $competence->GetId(); ?>"><span
                    class="glyphicon glyphicon-arrow-left retour_prec_histo"></span></a>
            Histogramme Perso - Détail des Notes
        </div>
        <table class="table" data-toggle="table">
            <thead>
            <tr>
                <th>Epreuve</th>
                <th>Histogramme</th>
                <th>Min</th>
                <th>Max</th>
                <th>Etudiant</th>
            </thead>
            <tbody>
            <?php
            foreach ($epreuvesList as $epreuve) {
                $etudiantnote = GetEtudiantNoteFromEtudiantEpreuve($idEtudiant, $epreuve->GetId()); ?>
            <tr>
                <td scope="row"><a class="lien_tableau"><b><?php echo $epreuve->GetNom(); ?></b></a></td>
                <td width="50%">
                    <?php
                    $idEpreuve = $epreuve->GetId();
                    $note_etudiant = round(GetEtudiantNoteFromEtudiantEpreuve($idEtudiant, $idEpreuve)->GetNoteFinale(),2);
                    $tab_histo = GetStat(GetTabNotesEtudiantsFromEpreuve($idEpreuve));
                    $moyenne = $tab_histo[0];
                    $ecart_type = $tab_histo[1];
                    $min = round($tab_histo[2],2);
                    $max = round($tab_histo[3],2);
                    $tab = showHisto($moyenne, $note_etudiant, $ecart_type);
                    include(__DIR__ . '../../modules/module_histo.php');
                    ?>
                </td>
                <td><?php echo $min; ?></td>
                <td><?php echo $max; ?></td>
                <td><?php
                    if (!empty($etudiantnote)) {
                        $note_etudiant = $etudiantnote->GetNoteFinale();
                        echo $note_etudiant;
                    }
                    else {
                        echo "-";
                    }?></td>
            </tr>
            <?php } ?>
            </tbody>
            <tfoot>
            <tr>
                <td><b>Moyenne Générale</b></td>
                <td width="50%"><b>
                    <?php
                    $note_etudiant = round(GetMoyenneFromCours($idCours, $idEtudiant),2);
                    $tab_histo_total = GetStat(GetTabNotesEtudiantsFromCours($idCours));
                    $moyenne = $tab_histo_total[0];
                    $ecart_type = $tab_histo_total[1];
                    $min = round($tab_histo_total[2], 2);
                    $max = round($tab_histo_total[3],2);
                    $tab = showHisto($moyenne, $note_etudiant, $ecart_type);
                    include(__DIR__ . '../../modules/module_histo.php');
                    ?>
                </b></td>
                <td><b><?php echo $min; ?></b></td>
                <td><b><?php echo $max; ?></b></td>
                <td><b><?php echo $note_etudiant; ?></b></td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>