<!-- Page de données !-->

<div class="row donnees donnees_tableaux_epreuves">
    <div class="panel panel-default">
        <div class="panel-heading"><a href="#" class="lien_tableau"
                                      id="releve_comp_<?php echo $competence->GetId(); ?>"><span
                    class="glyphicon glyphicon-arrow-left retour_prec_releve"></span></a>
            Relevé de notes - Détail des Notes
        </div>
        <div class="panel_listing">
            <table class="table" data-toggle="table">
                <thead>
                <tr>
                    <th>Cours</th>
                    <th>Moyenne</th>
                    <th>Coefficient</th>
                    <th>Grades</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($epreuvesList as $epreuve) { ?>
                    <tr>
                        <td id="releve_epreuve_<?php echo $epreuve->GetId(); ?>"><b><?php echo $epreuve->GetNom(); ?></b></a></td>
                        <td><?php echo GetEtudiantNoteFromEtudiantEpreuve(GetEtudiant($user)->GetId(), $epreuve->GetId())->GetNoteFinale(); ?></td>
                        <td><?php echo $epreuve->GetCoef(); ?></td>
                        <td>A</td>
                    </tr>
                <?php } ?>
                </tbody>
                <?php
                if (!empty($epreuvesList)) {
                    ?>
                    <tfoot>
                    <tr>
                        <td><b>Moyenne Générale</b></td>
                        <td><b>
                            <?php
                            $note_etudiant = round(GetEtudiantNoteFromEtudiantEpreuve(GetEtudiant($user)->GetId(), $epreuve->GetId())->GetNoteFinale(),2);
                            echo $note_etudiant;
                            ?>
                            </b></td>
                        <td><b><?php echo $credits_cours; ?></b></td>
                        <td><b>A</b></td>
                    </tr>
                    </tfoot>
                <?php } ?>
            </table>
        </div>
    </div>
</div>