<!-- Simulateur Manuel !-->
<div class="row donnees donnees_tableaux panel_simu_cours">
    <div class="panel panel-default">
        <div class="panel-heading">Simulateur Manuel</div>
        <table class="table">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Moyenne</th>
                <th>Semestre</th>
                <th>ECTS</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($coursList as $cours) { ?>
                <tr>
                    <td><a href="#" id="simu_cours_<?php echo $cours->GetId(); ?>"><?php echo $cours->GetNom(); ?></a></td>
                    <td><?php echo "20"; ?></td>
                    <td><?php echo $cours->GetSemestre(); ?></td>
                    <td><?php echo $cours->GetCredits(); ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>