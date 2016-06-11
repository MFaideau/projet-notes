<div class="panel_type_eval">
    <div class="panel panel-default saisie_notes">
        <div class="panel-heading">Choix du Type d'Evaluation
            <div class="add_button_etudes">
                <span id="typeEvalEdition">
                <a data-toggle="modal" data-target="#verifDeleteTypeEval">
                    <i class="glyphicon glyphicon-remove-sign"></i>
                </a>
                <a data-toggle="modal" data-target="#modifyTypeEval">
                    <i class="glyphicon glyphicon-edit"></i>
                </a>
                </span>
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
                <tr>
                    <td><a id="orga_type_eval_<?php echo $typeEval->GetId(); ?>"><?php echo $typeEval->GetNom(); ?></a></td>
                    <td><?php echo $typeEval->GetCoef(); ?></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>