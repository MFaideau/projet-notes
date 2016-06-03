<div class="panel_cursus">
    <div class="panel panel-default choix_cursus_eleves">
        <div class="panel-heading">Choix du Cursus</div>
        <div class="panel-body">
            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                <?php foreach (GetCursusList() as $cursus) { ?>
                    <div class="btn-group" role="group">
                        <button id="eleves_cursus_<?php echo $cursus->GetId(); ?>" type="button"
                                class="btn btn-default"><?php echo $cursus->GetNom(); ?></button>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>