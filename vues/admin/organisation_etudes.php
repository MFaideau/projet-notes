<div class="panel_cursus">
    <div class="panel panel-default saisie_notes">
        <div class="panel-heading">
            Choix du Cursus
            <div class="add_button_etudes">
                <span id="cursusEdition" style="display: none;">
                <a data-toggle="modal" data-target="#verifDeleteCursus">
                    <i class="glyphicon glyphicon-remove-sign"></i>
                </a>
                <a data-toggle="modal" data-target="#modifyCursus">
                    <i class="glyphicon glyphicon-edit"></i>
                </a>
                </span>
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
                    <tr>
                        <td><a id="orga_cursus_<?php echo $cursus->GetId(); ?>"><?php echo $cursus->GetNom(); ?></a></td>
                        <td><?php echo $cursus->GetAnnee(); ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
