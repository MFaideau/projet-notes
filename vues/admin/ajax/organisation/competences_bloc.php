<div class="panel_competences">
    <div class="panel panel-default saisie_notes">
        <div class="panel-heading">
            Choix de la Compétence
            <div class="add_button_etudes">
                <span id="competenceEdition">
                    <a data-toggle="modal" data-target="#verifDeleteCompetences">
                        <i class="glyphicon glyphicon-remove-sign"></i>
                    </a>
                    <a data-toggle="modal" data-target="#modifyCompetence">
                        <i class="glyphicon glyphicon-edit"></i>
                    </a>
                </span>
                <a data-toggle="modal" data-target="#addCompetence">
                    <i class="glyphicon glyphicon-plus"></i>
                </a>
            </div>
        </div>
        <div class="panel-body">
            <div class="btn-group" role="group" aria-label="...">
                <?php
                foreach (GetCompetenceListFromCursus($cursus->GetId()) as $competence) { ?>
                    <button id="orga_competence_<?php echo $competence->GetId(); ?>" type="button"
                            class="btn btn-default btn-competences"
                            role="button"><?php echo html_entity_decode($competence->GetNom()); ?></button>
                <?php } ?>
            </div>
        </div>
    </div>
</div>