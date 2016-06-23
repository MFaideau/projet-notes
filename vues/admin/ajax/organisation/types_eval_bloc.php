<?php defined("ROOT_ACCESS") or die(); ?>
<div class="panel_type_eval decale_admin">
    <div class="panel panel-default saisie_notes">
        <div class="panel-heading">Choix du Type d'Evaluation
            <div class="add_button_etudes">
                <a data-toggle="modal" data-target="#addTypeEval">
                    <i class="glyphicon glyphicon-plus"></i>
                </a>
            </div>
        </div>
        <div class="panel_listing">
            <table id="tableOrgaTypeEval" class="table" data-toggle="table">
                <thead>
                <th>Nom</th>
                <th>Coefficient</th>
                </thead>
                <tbody>
                <?php
                foreach ($typeEvalList as $typeEval) { ?>
                <tr id="orga_tr_type_eval_<?php echo $typeEval->GetId(); ?>">
                    <td>
                         <span class="orgaEdition">
                             <a class="link" data-toggle="modal" data-target="#verifDeleteTypeEval" id="orga_delete_type_eval_<?php echo $typeEval->GetId(); ?>"><span class="glyphicon glyphicon-minus-sign icone"></span></a>
                             <a class="link" data-toggle="modal" data-target="#modifyTypeEval" id="orga_modify_type_eval_<?php echo $typeEval->GetId(); ?>"><span class="glyphicon glyphicon-edit icone"></span></a>
                         </span>
                        <a class="link" id="orga_type_eval_<?php echo $typeEval->GetId(); ?>"><?php echo $typeEval->GetNom(); ?></a>
                    </td>
                    <td id="orga_type_eval_coef_<?php echo $typeEval->GetId(); ?>"><?php echo $typeEval->GetCoef(); ?></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>