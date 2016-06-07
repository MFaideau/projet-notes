<div class="panel_cours">
    <div class="panel panel-default saisie_notes">
        <div class="panel-heading">Choix du Cours
            <div class="add_button_etudes">
                <a data-toggle="modal" data-target="#verifDeleteCours">
                    <i class="glyphicon glyphicon-remove-sign"></i>
                </a>
                <a data-toggle="modal" data-target="#modifyCours">
                    <i class="glyphicon glyphicon-edit"></i>
                </a>
                <a data-toggle="modal" data-target="#addCours">
                    <i class="glyphicon glyphicon-plus"></i>
                </a>
            </div>
        </div>
        <div class="panel-body">
            <div class="btn-group" role="group" aria-label="...">
                <?php
                foreach ($cours as $current_cours) { ?>
                    <button id="orga_cours_<?php echo $current_cours->GetId(); ?>" type="button"
                            class="btn btn-default"><?php echo html_entity_decode($current_cours->GetNom()); ?></button>
                <?php } ?>
            </div>
        </div>
    </div>
</div>