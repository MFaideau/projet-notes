<div class="panel_eval">
    <div class="panel panel-default saisie_notes">
        <div class="panel-heading">Choix de l'Evaluation
            <div class="add_button_etudes">
                <a data-toggle="modal" data-target="#verifDeleteEval">
                    <i class="glyphicon glyphicon-remove-sign"></i>
                </a>
                <a data-toggle="modal" data-target="#modifyEval">
                    <i class="glyphicon glyphicon-edit"></i>
                </a>
                <a data-toggle="modal" data-target="#addEval">
                    <i class="glyphicon glyphicon-plus"></i>
                </a>
            </div>
        </div>
        <div class="panel-body">
            <div class="btn-group" role="group" aria-label="...">
                <div class="btn-group" role="group">
                    <?php
                    foreach ($eval as $current_eval) { ?>
                        <button id="orga_eval_<?php echo $current_eval->GetId(); ?>" type="button"
                                class="btn btn-default"><?php echo html_entity_decode($current_eval->GetNom()); ?></button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>