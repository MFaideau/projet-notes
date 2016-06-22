<?php defined("ROOT_ACCESS") or die(); ?>
<div class="panel_cursus decale_admin">
    <div class="panel panel-default saisie_notes">
        <div class="panel-heading">
            Choix du Cursus
            <div class="add_button_etudes">
                <a data-toggle="modal" data-target="#addCursus">
                    <i class="glyphicon glyphicon-plus"></i>
                </a>
            </div>
        </div>
        <div class="panel_listing">
            <table id="tableOrgaCursus" class="table" data-toggle="table">
                <thead>
                    <th data-field="nom">Nom</th>
                    <th data-field="annee">Année</th>
                </thead>
                <tbody>
                <?php foreach (GetCursusList() as $cursus) { ?>
                    <tr id="orga_tr_cursus_<?php echo $cursus->GetId(); ?>">
                        <td>
                            <span class="orgaEdition">
                                <a class="link" data-toggle="modal" data-target="#verifDeleteCursus" id="orga_delete_cursus_<?php echo $cursus->GetId(); ?>"><span class="glyphicon glyphicon-minus-sign icone"></span></a>
                                <a class="link" data-toggle="modal" data-target="#modifyCursus" id="orga_modify_cursus_<?php echo $cursus->GetId(); ?>"><span class="glyphicon glyphicon-edit icone"></span></a>
                                <a class="link" href="visualisation_eleve.php?listIdCursus=<?php echo $cursus->GetId(); ?>"><span class="glyphicon glyphicon-th-list icone"></span></a>
                            </span>
                            <a class="link" id="orga_cursus_<?php echo $cursus->GetId(); ?>"><?php echo $cursus->GetNom(); ?></a>
                        </td>
                        <td id="orga_cursus_annee_<?php echo $cursus->GetId(); ?>"><?php echo $cursus->GetAnnee(); ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
