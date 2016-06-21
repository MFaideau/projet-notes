<?php defined("ROOT_ACCESS") or die(); ?>
<!-- Histogramme Promo !-->

<div class="row donnees donnees_histo_com_cours">
    <div class="panel panel-default">
        <div class="panel-heading ">
            <a href="#" id="prec_cours_histo_commun"><span class="glyphicon glyphicon-arrow-left retour_prec_histo"></span></a>
            Histogramme De La Promo - Choix du cours
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>Cours</th>
                <th>Min</th>
                <th>Max</th>
                <th>Etudiant</th>
                <th>Hist.</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($coursList as $cours) { ?>
                <tr>
                    <th scope="row"><a class="lien_tableau" id="hist_com_cours_<?php echo $cours->GetId(); ?>"><?php echo $cours->GetNom(); ?></a></th>
                    <td>
                        <?php
                        $idCours = $cours->GetId();
                        $note_etudiant = round(GetMoyenneFromCours($idCours, $idEtudiant),2);
                        $tab_histo = GetStat(GetTabNotesEtudiantsFromCours($idCours));
                        $min = round($tab_histo[2],2);
                        $max = round($tab_histo[3],2);
                        echo TestValidite($min); ?></td>
                    <td><?php echo TestValidite($max); ?></td>
                    <td><?php echo TestValidite($note_etudiant); ?></td>
                    <td class="button_show_histo">
                        <a id="histo_batons_cours_<?php echo $idCours; ?>">
                            <span class="glyphicon glyphicon-stats icone histo_button"></span>
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
            <tfoot>
            <tr>
                <th>Moyenne Générale</th>
               <td><b> <?php
                $note_etudiant = round(GetMoyenneFromCompetence($idCompetence, $idEtudiant),2);
                $tab_histo_total = GetStat(GetTabNotesEtudiantsFromCompetence($idCompetence));
                $min = round($tab_histo_total[2],2);
                $max = round($tab_histo_total[3],2);
                echo TestValidite($min);
                ?>
               </b></td>
                <td><b><?php echo TestValidite($max); ?></b></td>
                <td><b><?php echo TestValidite($note_etudiant); ?></b></td>
                <td class="button_show_histo">
                    <a id="histo_batons_comp_<?php echo $idCompetence; ?>">
                        <span class="glyphicon glyphicon-stats icone histo_button"></span>
                    </a>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>