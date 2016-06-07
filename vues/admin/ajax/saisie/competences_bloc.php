<div class="panel_competences">
    <div class="panel panel-default saisie_notes">
        <div class="panel-heading">Choix de la Compétence</div>
        <div class="panel-body">
            <div class="btn-group" role="group" aria-label="...">
                <div class="btn-group" role="group">
                    <?php
                    foreach (GetCompetenceListFromCursus($cursus->GetId()) as $competence) { ?>
                        <button id="competence_<?php echo $competence->GetId(); ?>" type="button"
                                class="btn btn-default btn-competences"><?php echo html_entity_decode($competence->GetNom()); ?></button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>