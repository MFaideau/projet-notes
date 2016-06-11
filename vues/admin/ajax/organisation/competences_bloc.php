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
        <div class="panel_listing">
            <table id="tableOrgaCompetence" class="table" data-toggle="table">
                <thead>
                <th>Nom</th>
                </thead>
                <tbody>
                <?php
                foreach (GetCompetenceListFromCursus($cursus->GetId()) as $competence) { ?>
                    <tr>
                        <td><a id="orga_competence_<?php echo $competence->GetId(); ?>"><?php echo $competence->GetNom();?></a></td>
                    <tr/>
                <?php }?>
                </tbody>
            </table>
        </div>
    </div>

</div>