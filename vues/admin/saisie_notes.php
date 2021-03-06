<?php defined("ROOT_ACCESS") or die(); !defined("AJOUT_NOTES") or die(); ?>
<div class="panel_cursus decale_admin">
    <div class="panel panel-default saisie_notes">
        <div class="panel-heading">Choix du Cursus</div>
        <div class="panel-body">
            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                <?php foreach (GetCursusList() as $cursus) { ?>
                    <div class="btn-group" role="group">
                        <button id="cursus_<?php echo $cursus->GetId(); ?>" type="button"
                                class="btn btn-default"><?php echo $cursus->GetNom(); ?></button>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>