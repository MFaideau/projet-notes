<!-- Page de données !-->

<div class="row donnees donnees_tableaux_cours">
    <div class="panel panel-default">
        <a href="releve_onglet.php"><span class="glyphicon glyphicon-arrow-left">Retour</span></a>
        <div class="panel-heading">Relevé de notes - Choix du cours</div>
        <table class="table">
            <thead>
            <tr>
                <th>Cours</th>
                <th>Moyenne</th>
                <th>ECTS</th>
                <th>Grades</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($coursList as $cours) { ?>
                    <tr>
                        <th scope="row"><a id="releve_cours_<?php echo $cours->GetId(); ?>"><?php echo $cours->GetNom(); ?></a></th>
                        <td><?php echo "10"; ?></td>
                        <td><?php echo $cours->GetCredits(); ?></td>
                        <td>A</td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
            <tr>
                <th>Total</th>
                <th>13</th>
                <th><?php echo $credits_competence; ?></th>
                <th>A</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>