<div class="panel_cours">
    <div class="panel panel-default saisie_notes">
        <div class="panel-heading">Choix du Cours
            <div class="add_button_etudes">
                <span id="coursEdition">
                    <a data-toggle="modal" data-target="#verifDeleteCours">
                        <i class="glyphicon glyphicon-remove-sign"></i>
                    </a>
                    <a data-toggle="modal" data-target="#modifyCours">
                        <i class="glyphicon glyphicon-edit"></i>
                    </a>
                </span>
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
                <tr>
                    <td><a id="orga_cours_<?php echo $current_cours->GetId(); ?>"><?php echo $current_cours->GetNom(); ?></a></td>
                    <td><?php echo $current_cours->GetCredits(); ?></td><td>
                    <?php
                        $semestre=$current_cours->GetSemestre();
                        if ($semestre == 0)
                            echo "Semestres 1 et 2";
                        elseif ($semestre == 1)
                            echo "Semestre 1";
                        elseif ($semestre == 2)
                            echo "Semestre 2"; ?>
                    </td>
                <tr/>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>