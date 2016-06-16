<!-- Histogramme Promo !-->

<div class="row donnees donnees_histo_com_epreuves">
    <div class="panel panel-default">
        <div class="panel-heading "><a href="releve_onglet.php"><span class="glyphicon glyphicon-arrow-left retour_prec_histo"></span></a>
            Histogramme De La Promo - Choix De L'Epreuve
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>Epreuve</th>
                <th>Min</th>
                <th>Max</th>
                <th>Etudiant</th>
                <th>Hist.</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($epreuvesList as $epreuve) { ?>
                <tr>
                    <td scope="row"><a class="lien_tableau" id="hist_com_epreuves_<?php echo $epreuve->GetId(); ?>"><?php echo $epreuve->GetNom(); ?></a></td>
                    <td><?php
                        $idEpreuve = $epreuve->GetId();
                        $note_etudiant = round(GetEtudiantNoteFromEtudiantEpreuve($idEtudiant, $idEpreuve)->GetNoteFinale(),2);
                        $tab_histo = GetStat(GetTabNotesEtudiantsFromEpreuve($idEpreuve));
                        $min = round($tab_histo[2],2);
                        $max = round($tab_histo[3],2);
                        echo $min; ?></td>
                    <td><?php echo $max; ?></td>
                    <td><?php echo $note_etudiant; ?></td>
                    <td class="button_show_histo">
                        <a id="histo_batons_epreuve_<?php echo $idEpreuve; ?>">
                            <span class="glyphicon glyphicon-stats icone histo_button"></span>
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
            <tfoot>
            <tr>
                <td>Moyenne Générale</td>
                <td>
                <?php
                $note_etudiant = round(GetMoyenneFromCours($idCours, $idEtudiant),2);
                $tab_histo_total = GetStat(GetTabNotesEtudiantsFromCours($idCours));
                $min = round($tab_histo_total[2],2);
                $max = round($tab_histo_total[3],2);
                echo $min;
                ?>
                </td>
                <td><?php echo $max; ?></td>
                <td><?php echo $note_etudiant; ?></td>
                <td class="button_show_histo">
                    <a id="histo_batons_cours_<?php echo $idCours; ?>">
                        <span class="glyphicon glyphicon-stats icone histo_button"></span>
                    </a>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>