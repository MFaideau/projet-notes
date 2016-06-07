<!-- Simulateur Manuel !-->
<div class="row donnees donnees_tableaux panel_simu_epreuves">
    <div class="panel panel-default">
        <div class="panel-heading">Simulation des épreuves</div>
        <table class="table">
            <thead>
            <tr>
                <th>Type interro</th>
                <th>Note</th>
                <th>Coefficient</th>
                <th>Simulation</th>
                <th>Validation</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($epreuvesList as $epreuve) { ?>
                <tr>
                    <td><?php echo $epreuve->GetNom(); ?></td>
                    <td><span id="note_<?php echo $epreuve->GetId(); ?>">-</span></td>
                    <td><?php echo $epreuve->GetCoef(); ?></td>
                    <td> <input id="number_<?php echo $epreuve->GetId(); ?>" type="number" value="10" min="0" max="20"/> </td>
                    <td><a id="note_simulee_<?php echo $epreuve->GetId(); ?>" <span class="glyphicon glyphicon-ok"> </span> </a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>


