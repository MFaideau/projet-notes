<div class="panel_type_eval">
    <div class="panel panel-default saisie_notes">
        <div class="panel-heading">Choix du Type d'Evaluation
            <div class="add_button_etudes">
                <a id="removeTypeEval">
                    <i class="glyphicon glyphicon-remove-sign"></i>
                </a>
                <a data-toggle="modal" data-target="#modifyTypeEval">
                    <i class="glyphicon glyphicon-edit"></i>
                </a>
                <a data-toggle="modal" data-target="#addTypeEval">
                    <i class="glyphicon glyphicon-plus"></i>
                </a>
            </div>
        </div>
        <div class="panel-body">
            <div class="btn-group" role="group" aria-label="...">
                <div class="btn-group" role="group">
                    <?php
                    foreach ($typeEvalList as $typeEval) { ?>
                        <button id="orga_type_eval_<?php echo $typeEval->GetId(); ?>" type="button"
                                class="btn btn-default"><?php echo html_entity_decode($typeEval->GetNom()); ?></button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>