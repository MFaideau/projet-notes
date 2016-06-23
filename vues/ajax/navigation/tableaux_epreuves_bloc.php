<?php defined("ROOT_ACCESS") or die(); ?>
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
                    <th>Epreuve</th>
                    <th>Note</th>
                    <th>Coefficient</th>
                    <th>Grades</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($epreuvesList as $epreuve) {
                    $idEpreuve = $epreuve->GetId();
                    $etudiantnote = GetEtudiantNoteFromEtudiantEpreuve($idEtudiant, $idEpreuve); ?>
                    <tr>
                        <td id="releve_epreuve_<?php echo $idEpreuve; ?>"><b><?php echo $epreuve->GetNom(); ?></b></td>
                        <td><?php
                            if (!empty($etudiantnote)) {
                                $note_etudiant = round($etudiantnote->GetNoteFinale(),2);
                                echo TestValidite($note_etudiant);
                            }
                            else {
                                echo "-";
                            }?>
                        </td>
                        <td><?php echo $epreuve->GetCoef(); ?></td>
                        <td><?php echo GetGradeFromEpreuve($idEpreuve, $idEtudiant); ?></td>
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
                            $idCours = $cours->GetId();
                            $studentNote = GetMoyenneFromCoursCalc($idCours, $idEtudiant);
                            if (isset($studentNote))
                                $note_etudiant = round($studentNote, 2);
                            else
                                $note_etudiant = "-";
                            echo TestValidite($note_etudiant);
                            ?>
                            </b></td>
                        <td><b><?php echo $credits_cours; ?></b></td>
                        <td><b><?php echo GetGradeFromCours($idCours, $idEtudiant); ?></b></td>
                    </tr>
                    </tfoot>
                <?php } ?>
            </table>
        </div>
    </div>
</div>