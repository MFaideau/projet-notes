<div class="panel_eval">
    <div class="panel panel-default saisie_notes">
        <div class="panel-heading">Choix de l'Evaluation
            <div class="add_button_etudes">
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
                    <tr id="orga_tr_eval_<?php echo $current_eval->GetId(); ?>">
                        <td>
                            <span class="orgaEdition">
                                <a data-toggle="modal" data-target="#verifDeleteEval" id="orga_delete_eval_<?php echo $current_eval->GetId(); ?>"><span class="glyphicon glyphicon-minus-sign icone"></span></a>
                                <a data-toggle="modal" data-target="#modifyEval" id="orga_modify_eval_<?php echo $current_eval->GetId(); ?>"><span class="glyphicon glyphicon-edit icone"></span></a>
                            </span>
                            <a id="orga_eval_<?php echo $current_eval->GetId(); ?>"><?php echo $current_eval->GetNom(); ?></a>
                        </td>
                        <td id="orga_eval_coef_<?php echo $current_eval->GetId(); ?>"><?php echo $current_eval->GetCoef(); ?>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>