<!-- Page de données !-->

<div class="row donnees donnees_tableaux_epreuves">
    <div class="panel panel-default">
        <div class="panel-heading"><a href="#" class="lien_tableau" id="releve_comp_<?php echo $competence->GetId(); ?>"><span class="glyphicon glyphicon-arrow-left retour_prec_releve"></span></a>
            Relevé de notes - Détail des Notes</div>
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
                    <th id="releve_epreuve_<?php echo $epreuve->GetId(); ?>"><?php echo $epreuve->GetNom(); ?></a></th>
                    <td><?php echo GetEtudiantNoteFromEtudiantEpreuve(GetEtudiant($user)->GetId(), $epreuve->GetId())->GetNoteFinale(); ?></td>
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