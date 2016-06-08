<!-- Page de données !-->

<div class="row donnees donnees_tableaux_cours">
    <div class="panel panel-default">
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
                        <th scope="row"><?php echo $cours->GetNom(); ?></th>
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
                <th></th>
                <th>A</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>