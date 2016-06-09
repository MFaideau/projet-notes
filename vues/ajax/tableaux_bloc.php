<!-- Page de données !-->

<div class="row donnees donnees_tableaux">
    <div class="panel panel-default">
        <div class="panel-heading">Relevé de notes</div>
        <table class="table">
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
                    <th scope="row"><a class="lien_tableau" id="releve_comp_<?php echo $competence->GetId(); ?>"><?php echo $competence->GetNom(); ?></a></th>
                    <td>13</td>
                    <td><?php echo $competence->GetCredits(); ?></td>
                    <td>A</td>
                </tr>
            <?php } ?>
            </tbody>
            <tfoot>
            <tr>
                <th>Total</th>
                <th>13</th>
                <th><?php echo $cursus->GetCredits(); ?></th>
                <th>A</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>