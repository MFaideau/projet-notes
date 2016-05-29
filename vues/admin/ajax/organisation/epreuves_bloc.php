<div class="panel_epreuve">
    <div class="panel panel-default saisie_notes">
        <div class="panel-heading">Choix de l'Epreuve
            <div class="add_button_etudes">
                <a data-toggle="modal" data-target="#addEpreuve">
                    <i class="glyphicon glyphicon-plus"></i>
                </a>
            </div>
        </div>
        <div class="panel-body">
            <div class="btn-group" role="group" aria-label="...">

                <div class="btn-group" role="group">
                    <?php
                    foreach ($epreuveList as $epreuve) { ?>
                        <button id="orga_epreuve_<?php echo $epreuve->GetId(); ?>" type="button"
                                class="btn btn-default"><?php echo html_entity_decode($epreuve->GetNom()); ?></button>

                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>