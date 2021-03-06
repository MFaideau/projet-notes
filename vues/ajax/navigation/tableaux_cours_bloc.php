<?php defined("ROOT_ACCESS") or die(); ?>
<!-- Page de données !-->

<div class="row donnees donnees_tableaux_cours">
    <div class="panel panel-default">
        <div class="panel-heading "><a onclick="location.reload();" href="#"><span class="glyphicon glyphicon-arrow-left retour_prec_releve"></span></a>
            Relevé de notes - Choix du cours
        </div>
        <div class="panel_listing">
            <table class="table" data-toggle="table">
                <thead>
                <tr>
                    <th>Cours</th>
                    <th>Note</th>
                    <th>ECTS</th>
                    <th>Grades</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($coursList as $cours) { 
                    $idCours = $cours->GetId(); ?>
                    <tr>
                        <td scope="row">
                            <a class="lien_tableau" id="releve_cours_<?php echo $idCours; ?>">
                                <b><?php echo $cours->GetNom(); ?></b>
                            </a>
                        </td>
                        <td><?php
                            $moyenne = round(GetMoyenneFromCoursCalc($idCours, $idEtudiant),2);
                            if ($moyenne == -1)
                                echo "-";
                            else
                                echo TestValidite($moyenne);
                            ?></td>
                        <td><?php echo $cours->GetCredits(); ?></td>
                        <td><?php echo GetGradeFromCours($idCours, $idEtudiant); ?></td>
                    </tr>
                <?php } ?>
                </tbody>
                <?php
                if (!empty($coursList)) {
                    ?>
                    <tfoot>
                    <tr>
                        <td><b>Moyenne Générale</b></td>
                        <td><b>
                            <?php
                            $note_etudiant = round(GetMoyenneFromCompetenceCalc($idCompetence, $idEtudiant),2);
                            echo TestValidite($note_etudiant);
                            ?>
                            </b></td>
                        <td><b><?php echo $credits_competence; ?></b></td>
                        <td><b><?php echo GetGradeFromCompetence($idCompetence, $idEtudiant); ?></b></td>
                    </tr>
                    </tfoot>
                <?php } ?>
            </table>
        </div>
    </div>
</div>