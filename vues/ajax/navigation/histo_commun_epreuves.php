<?php defined("ROOT_ACCESS") or die(); ?>
<!-- Histogramme Promo !-->

<div class="row donnees donnees_histo_com_epreuves">
    <div class="panel panel-default">
        <div class="panel-heading ">
            <a href="#" id="hist_com_comp_<?php echo $competence->GetId(); ?>"><span class="glyphicon glyphicon-arrow-left retour_prec_histo"></span></a>
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
            <?php foreach ($epreuvesList as $epreuve) {
                        $idEpreuve = $epreuve->GetId();
                        $etudiantNote = GetEtudiantNoteFromEtudiantEpreuve($idEtudiant, $idEpreuve);
                        if(isset($etudiantNote)) {
                            $note_etudiant = round($etudiantNote->GetNoteFinale(), 2);
                            $tab_histo = GetStat(GetTabNotesEtudiantsFromEpreuve($idEpreuve));
                            $min = round($tab_histo[2], 2);
                            $max = round($tab_histo[3], 2);
                        }
                        else {
                            $min = "-";
                            $max = "-";
                            $note_etudiant = "-";
                        }
                ?>
                <tr>
                    <td scope="row"><a class="lien_tableau" id="hist_com_epreuves_<?php echo $epreuve->GetId(); ?>"><?php echo $epreuve->GetNom(); ?></a></td>
                    <td><?php echo $min; ?></td>
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
                <td><b>Moyenne Générale</b></td>
                <td><b>
                <?php
                $note_etudiant = round(GetMoyenneFromCours($idCours, $idEtudiant),2);
                $tab_histo_total = GetStat(GetTabNotesEtudiantsFromCours($idCours));
                $min = round($tab_histo_total[2],2);
                $max = round($tab_histo_total[3],2);
                echo $min;
                ?>
                </b></td>
                <td><b><?php echo $max; ?></b></td>
                <td><b><?php echo $note_etudiant; ?></b></td>
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