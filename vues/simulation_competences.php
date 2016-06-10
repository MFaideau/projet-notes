<!-- Simulateur Manuel !-->
<div class="row donnees donnees_tableaux panel_simu_comp">
    <div class="panel panel-default">
        <div class="panel-heading">Simulateur Manuel</div>
        <table class="table">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Moyenne</th>
                <th>Coefficient</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($competenceList as $competence) { ?>
                <tr>
                    <td><a id="simu_comp_<?php echo $competence->GetId(); ?>"><?php echo $competence->GetNom(); ?></a></td>
                    <td><?php echo GetMoyenneFromCompetence($competence->GetId(), GetEtudiant($user)->GetId()); ?></td>
                    <td><?php echo "12"; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>


