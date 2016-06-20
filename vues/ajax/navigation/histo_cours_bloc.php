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
                        $idCours = $cours->GetId();
                        $note_etudiant = round(GetMoyenneFromCours($idCours, $idEtudiant),2);
                        $tab_histo = GetStat(GetTabNotesEtudiantsFromCours($idCours));
                        $moyenne = $tab_histo[0];
                        $ecart_type = $tab_histo[1];
                        $min = round($tab_histo[2],2);
                        $max = round($tab_histo[3],2);
                        $tab = showHisto($moyenne, $note_etudiant, $ecart_type);
                        include (__DIR__ . '../../modules/module_histo.php');
                        ?>
                    </td>
                    <td><?php echo TestValidite($min); ?></td>
                    <td><?php echo TestValidite($max); ?></td>
                    <td><?php echo TestValidite($note_etudiant); ?></td>
                </tr>
            <?php } ?>
            </tbody>
            <tfoot>
            <tr>
                <td><b>Moyenne Générale</b></td>
                <td width="50%"><b>
                    <?php
                    $note_etudiant = round(GetMoyenneFromCompetence($idCompetence, $idEtudiant),2);
                    $tab_histo_total = GetStat(GetTabNotesEtudiantsFromCompetence($idCompetence));
                    $moyenne = $tab_histo_total[0];
                    $ecart_type = $tab_histo_total[1];
                    $min = round($tab_histo_total[2],2);
                    $max = round($tab_histo_total[3],2);
                    $tab = showHisto($moyenne, $note_etudiant, $ecart_type);
                    include(__DIR__ . '../../modules/module_histo.php');
                    ?>
                        </b></td>
                <td><b><?php echo TestValidite($min); ?></b></td>
                <td><b><?php echo TestValidite($max); ?></b></td>
                <td><b><?php echo TestValidite($note_etudiant); ?></b></td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>