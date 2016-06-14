<div class="panel_epreuve">
    <div class="panel panel-default saisie_notes">
        <div class="panel-heading">Choix de l'Epreuve
            <div class="add_button_etudes">
                <a data-toggle="modal" data-target="#addEpreuve">
                    <i class="glyphicon glyphicon-plus"></i>
                </a>
            </div>
        </div>
        <div class="panel_listing">
            <table id="tableOrgaEpreuve" class="table" data-toggle="table">
                <thead>
                <th>Nom</th>
                <th>Coefficient</th>
                <th>Date</th>
                <th>Evaluateur</th>
                </thead>
                <tbody>
                <?php
                foreach ($epreuveList as $epreuve) { ?>
                <tr id="orga_tr_epreuve_<?php echo $epreuve->GetId(); ?>">
                    <td>
                         <span class="orgaEdition">
                             <a data-toggle="modal" data-target="#verifDeleteEpreuve" id="orga_delete_epreuve_<?php echo $epreuve->GetId(); ?>"><span class="glyphicon glyphicon-minus-sign icone"></span></a>
                             <a data-toggle="modal" data-target="#modifyEpreuve" id="orga_modify_epreuve_<?php echo $epreuve->GetId(); ?>"><span class="glyphicon glyphicon-edit icone"></span></a>
                         </span>
                        <a id="orga_epreuve_<?php echo $epreuve->GetId(); ?>"><?php echo $epreuve->GetNom(); ?></a>
                    </td>
                    <td id="orga_epreuve_coef_<?php echo $epreuve->GetId(); ?>"><?php echo $epreuve->GetCoef(); ?></td>
                    <td id="orga_epreuve_date_<?php echo $epreuve->GetId(); ?>"><?php echo $epreuve->GetDate(); ?></td>
                    <td id="orga_epreuve_evaluateur_<?php echo $epreuve->GetId(); ?>"><?php echo $epreuve->GetEvaluateur(); ?></td>
                </tr>
                        <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>