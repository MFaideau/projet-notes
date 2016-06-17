<div class="panel_competences">
    <div class="panel panel-default saisie_notes">
        <div class="panel-heading">
            Choix de la Compétence
            <div class="add_button_etudes">
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
                    <tr id="orga_tr_competence_<?php echo $competence->GetId(); ?>">
                        <td>
                            <span class="orgaEdition">
                                <a class="link" data-toggle="modal" data-target="#verifDeleteCompetences" id="orga_delete_competence_<?php echo $competence->GetId(); ?>"><span class="glyphicon glyphicon-minus-sign icone"></span></a>
                                <a class="link" data-toggle="modal" data-target="#modifyCompetence" id="orga_modify_competence_<?php echo $competence->GetId(); ?>"><span class="glyphicon glyphicon-edit icone"></span></a>
                                <a class="link" href="visualisation_eleve.php?listIdCompetence=<?php echo $competence->GetId(); ?>" id="orga_list_competence_<?php echo $competence->GetId(); ?>"><span class="glyphicon glyphicon-th-list icone"></span></a>
                            </span>
                            <a class="link" id="orga_competence_<?php echo $competence->GetId(); ?>"><?php echo $competence->GetNom(); ?></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>