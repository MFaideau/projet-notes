<?php defined("ROOT_ACCESS") or die(); ?>
<!-- Page de données !-->
<div class="row donnees donnees_tableaux">
    <div class="panel panel-default">
        <div class="panel-heading">Relevé de notes</div>
        <div class="panel_listing">
            <table class="table" data-toggle="table">
                <thead>
                <tr>
                    <th>Compétences</th>
                    <th>Moyenne</th>
                    <th>ECTS</th>
                    <th>Grades</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($competenceList as $competence) { ?>
                    <tr>
                        <td class="lien_tableau" scope="row">
                            <a class="lien_tableau" id="releve_comp_<?php echo $competence->GetId(); ?>">
                                <b><?php echo $competence->GetNom(); ?></b>
                            </a>
                        </td>
                        <td>
                            <?php
                            $note_etudiant = round(GetMoyenneFromCompetence($competence->GetId(), $idEtudiant), 2);
                            echo $note_etudiant;
                            ?>
                        </td>
                        <td><?php echo $competence->GetCredits(); ?></td>
                        <td>A</td>
                    </tr>
                <?php } ?>
                </tbody>
                <?php
                if (!empty($competenceList)) {
                    ?>
                    <tfoot>
                    <tr>
                        <td><b>Moyenne Générale</b></td>
                        <td><b>
                            <?php
                            $note_etudiant = round(GetMoyenneFromCursus(GetEtudiant($user)->GetCursus()->GetId(), $idEtudiant), 2);
                            echo $note_etudiant;
                            ?>
                            </b></td>
                        <td><b><?php echo $cursus->GetCredits(); ?></b></td>
                        <td><b>A</b></td>
                    </tr>
                    </tfoot>
                <?php } ?>
            </table>
        </div>
    </div>
</div>