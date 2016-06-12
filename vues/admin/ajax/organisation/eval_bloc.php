<div class="panel_eval">
    <div class="panel panel-default saisie_notes">
        <div class="panel-heading">Choix de l'Evaluation
            <div class="add_button_etudes">
                <span id="evalEdition">
                <a data-toggle="modal" data-target="#verifDeleteEval">
                    <i class="glyphicon glyphicon-remove-sign"></i>
                </a>
                <a data-toggle="modal" data-target="#modifyEval">
                    <i class="glyphicon glyphicon-edit"></i>
                </a>
                </span>
                <a data-toggle="modal" data-target="#addEval">
                    <i class="glyphicon glyphicon-plus"></i>
                </a>
            </div>
        </div>
        <div class="panel_listing">
            <table id="tableOrgaEval" class="table" data-toggle="table">
                <thead>
                <th>Nom</th>
                <th>Coefficient</th>
                </thead>
                <tbody>
                <?php
                foreach ($eval as $current_eval) { ?>
                    <tr>
                        <td><a id="orga_eval_<?php echo $current_eval->GetId(); ?>"><?php echo $current_eval->GetNom(); ?></a></td>
                        <td id="orga_eval_coef_<?php echo $current_eval->GetId(); ?>"><?php echo $current_eval->GetCoef(); ?>
                    <tr/>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>