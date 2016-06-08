<!-- Page de données !-->

<div class="row donnees donnees_tableaux_epreuves">
    <div class="panel panel-default">
        <a id="releve_cours_<?php echo $_POST['idCours']; ?>"><span class="glyphicon glyphicon-arrow-left">Retour</span></a>
        <div class="panel-heading">Relevé de notes - Choix du cours</div>
        <table class="table">
            <thead>
            <tr>
                <th>Cours</th>
                <th>Moyenne</th>
                <th>Coefficient</th>
                <th>Grades</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($epreuvesList as $epreuve) { ?>
                <tr>
                    <th scope="row"><a id="releve_cours_<?php echo $epreuve->GetId(); ?>"><?php echo $epreuve->GetNom(); ?></a></th>
                    <td><?php echo "10"; ?></td>
                    <td><?php echo $epreuve->GetCoef(); ?></td>
                    <td>A</td>
                </tr>
            <?php } ?>
            </tbody>
            <tfoot>
            <tr>
                <th>Total</th>
                <th>13</th>
                <th><?php echo $credits_cours; ?></th>
                <th>A</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>