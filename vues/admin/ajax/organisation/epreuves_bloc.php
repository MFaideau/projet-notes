<div class="panel_epreuve">
    <div class="panel panel-default saisie_notes">
        <div class="panel-heading">Choix de l'Epreuve
            <div class="add_button_etudes">
                <span id="epreuveEdition">
                <a data-toggle="modal" data-target="#verifDeleteEpreuve">
                    <i class="glyphicon glyphicon-remove-sign"></i>
                </a>
                <a data-toggle="modal" data-target="#modifyEpreuve">
                    <i class="glyphicon glyphicon-edit"></i>
                </a>
                </span>
                <a data-toggle="modal" data-target="#addEpreuve">
                    <i class="glyphicon glyphicon-plus"></i>
                </a>
            </div>
        </div>
        <div class="panel_listing">
            <table id="tableOrgaEpreuve" class="table" data-toggle="table">
                <thead>
                <th>Nom</th>
                <th>Coefficient</th>
                <th>Date</th>
                <th>Evaluateur</th>
                </thead>
                <tbody>
                <?php
                foreach ($epreuveList as $epreuve) { ?>
                <tr>
                    <td><a id="orga_epreuve_<?php echo $epreuve->GetId(); ?>"><?php echo $epreuve->GetNom(); ?></a></td>
                    <td><?php echo $epreuve->GetCoef(); ?></td>
                    <td><?php echo $epreuve->GetDate(); ?></td>
                    <td><?php echo $epreuve->GetEvaluateur(); ?></td>
                </tr>
                        <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>