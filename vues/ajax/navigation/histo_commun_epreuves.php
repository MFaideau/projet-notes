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
            <?php foreach ($coursList as $cours) { ?>
                <tr>
                    <th scope="row"><a class="lien_tableau" id="hist_com_epreuves_<?php echo $cours->GetId(); ?>"><?php echo $cours->GetNom(); ?></a></th>
                    <td><?php echo round($tab_histo[2],2); ?></td>
                    <td><?php echo round($tab_histo[3],2); ?></td>
                    <td><?php echo round($note_etudiant,2); ?></td>
                    <td class="button_show_histo">
                        <a data-toggle="modal" data-target="#showHisto1">
                            <span class="glyphicon glyphicon-stats icone histo_button"></span>
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
            <tfoot>
            <tr>
                <th>Total</th>
                <td>
                <?php
                $note_etudiant = round(GetMoyenneFromCursus(GetEtudiant($user)->GetCursus()->GetId(), GetEtudiant($user)->GetId()),2);
                $tab_histo_total = GetStat(GetTabNotesEtudiantsFromCursus(GetEtudiant($user)->GetCursus()->GetId()));
                $min = round($tab_histo_total[2],2);
                $max = round($tab_histo_total[3],2);
                echo $min;
                ?>
                </td>
                <td><strong><?php echo round($tab_histo_total[2],2); ?></strong></td>
                <th><?php echo round($tab_histo_total[3],2); ?></th>
                <th><?php echo round($note_etudiant,2); ?></th>
                <td class="button_show_histo">
                    <a data-toggle="modal" data-target="#showHisto1">
                        <span class="glyphicon glyphicon-stats icone histo_button"></span>
                    </a>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>