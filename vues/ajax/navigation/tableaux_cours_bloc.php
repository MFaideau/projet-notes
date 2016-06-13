<!-- Page de données !-->

<div class="row donnees donnees_tableaux_cours">
    <div class="panel panel-default">
        <div class="panel-heading "><a href="releve_onglet.php"><span
                    class="glyphicon glyphicon-arrow-left retour_prec_releve"></span></a>
            Relevé de notes - Choix du cours
        </div>
        <div class="panel_listing">
            <table class="table" data-toggle="table">
                <thead>
                <tr>
                    <th>Cours</th>
                    <th>Moyenne</th>
                    <th>ECTS</th>
                    <th>Grades</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($coursList as $cours) { ?>
                    <tr>
                        <td scope="row"><a class="lien_tableau"
                                           id="releve_cours_<?php echo $cours->GetId(); ?>"><b><?php echo $cours->GetNom(); ?></b></a>
                        </td>
                        <td><?php
                            $moyenne = GetMoyenneFromCours($cours->GetId(), $idEtudiant);
                            if ($moyenne == -1)
                                echo "-";
                            else
                                echo $moyenne;
                            ?></td>
                        <td><?php echo $cours->GetCredits(); ?></td>
                        <td>A</td>
                    </tr>
                <?php } ?>
                </tbody>
                <?php
                if (!empty($coursList)) {
                    ?>
                    <tfoot>
                    <tr>
                        <td><b>Total</b></td>
                        <td><b>
                            <?php
                            $note_etudiant = round(GetMoyenneFromCompetence(GetCompetenceFromCours($cours->GetId())->GetId(), GetEtudiant($user)->GetId()),2);
                            echo $note_etudiant;
                            ?>
                            </b></td>
                        <td><b><?php echo $credits_competence; ?></b></td>
                        <td><b>A</b></td>
                    </tr>
                    </tfoot>
                <?php } ?>
            </table>
        </div>
    </div>
</div>