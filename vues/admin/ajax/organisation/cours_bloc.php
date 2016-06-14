<div class="panel_cours">
    <div class="panel panel-default saisie_notes">
        <div class="panel-heading">Choix du Cours
            <div class="add_button_etudes">
                <a data-toggle="modal" data-target="#addCours">
                    <i class="glyphicon glyphicon-plus"></i>
                </a>
            </div>
        </div>
        <div class="panel_listing">
            <table id="tableOrgaCours" class="table" data-toggle="table">
                <thead>
                <th>Nom</th>
                <th>Crédits ECTS</th>
                <th>Semestre(s)</th>
                </thead>
                <tbody>
                <?php
                foreach ($cours as $current_cours) { ?>
                <tr id="orga_tr_cours_<?php echo $current_cours->GetId(); ?>">
                    <td>
                        <span class="orgaEdition">
                                <a data-toggle="modal" data-target="#verifDeleteCours" id="orga_delete_cours_<?php echo $current_cours->GetId(); ?>">
                                    <span class="glyphicon glyphicon-minus-sign icone"></span>
                                </a>
                                <a data-toggle="modal" data-target="#modifyCours" id="orga_modify_cours_<?php echo $current_cours->GetId(); ?>">
                                    <span class="glyphicon glyphicon-edit icone"></span>
                                </a>
                        </span>
                        <a id="orga_cours_<?php echo $current_cours->GetId(); ?>"><?php echo $current_cours->GetNom(); ?>
                        </a>
                    </td>
                    <td id="orga_cours_credits_<?php echo $current_cours->GetId(); ?>"><?php echo $current_cours->GetCredits(); ?></td>
                    <td id="orga_cours_semestre_<?php echo $current_cours->GetId(); ?>">
                    <?php
                        $semestre=$current_cours->GetSemestre();
                        if ($semestre == 0)
                            echo "Semestres 1 et 2";
                        elseif ($semestre == 1)
                            echo "Semestre 1";
                        elseif ($semestre == 2)
                            echo "Semestre 2"; ?>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>