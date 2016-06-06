<div class="panel_cursus">
    <div class="panel panel-default saisie_notes">
        <div class="panel-heading">
            Choix du Cursus
            <div class="add_button_etudes">
                <a data-toggle="modal" data-target="#verifDeleteCursus">
                    <i class="glyphicon glyphicon-remove-sign"></i>
                </a>
                <a data-toggle="modal" data-target="#modifyCursus">
                    <i class="glyphicon glyphicon-edit"></i>
                </a>
                <a data-toggle="modal" data-target="#addCursus">
                    <i class="glyphicon glyphicon-plus"></i>
                </a>
            </div>
        </div>
        <div class="panel-body panel_cursus_choix">
            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                <?php foreach (GetCursusList() as $cursus) { ?>
                    <div class="btn-group" role="group">
                        <button id="orga_cursus_<?php echo $cursus->GetId(); ?>" type="button"
                                class="btn btn-default"><?php echo $cursus->GetNom(); ?></button>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
