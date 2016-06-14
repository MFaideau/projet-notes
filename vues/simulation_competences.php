<!-- Page de données !-->
<div class="row donnees donnees_tableaux">
    <div class="panel panel-default">
        <div class="panel-heading">Relevé de notes</div>
        <div class="panel_listing">
            <table class="table" data-toggle="table">
                <thead>
                    <tr>
                        <th>Compétences</th>
                        <th>ECTS</th>
                        <th>Moyenne</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($competences as $competence) { ?>
                        <tr>
                            <td class="lien_tableau" scope="row">
                                <a class="lien_tableau" href="simulateur_onglet.php?idCompetence=<?php echo $competence->GetId(); ?>">
                                    <b><?php echo $competence->GetNom(); ?></b>
                                </a>
                            </td>
                            <td><?php echo $competence->GetCredits(); ?></td>
                            <td>
                                <?php
                                $note_etudiant = round(GetMoyenneFromCompetence($competence->GetId(), GetEtudiant($user)->GetId()), 2);
                                echo $note_etudiant;
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
                <?php
                if (!empty($competences)) {
                    ?>
                    <tfoot>
                        <tr>
                            <td><b>Total</b></td>
                            <td><b><?php echo $cursus->GetCredits(); ?></b></td>
                            <td><b>
                                    <?php
                                    $note_etudiant = round(GetMoyenneFromCursus(GetEtudiant($user)->GetCursus()->GetId(), GetEtudiant($user)->GetId()), 2);
                                    echo $note_etudiant;
                                    ?>
                                </b>
                            </td>
                        </tr>
                    </tfoot>
                <?php } ?>
            </table>
        </div>
    </div>
</div>