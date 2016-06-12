<!-- Page de données !-->

<div class="row donnees donnees_tableaux_cours">
    <div class="panel panel-default">
        <div class="panel-heading "><a onclick="location.reload();" href="#"><span class="glyphicon glyphicon-arrow-left retour_prec_releve"></span></a>
            Relevé de notes - Choix du cours
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>Cours</th>
                <th>Moyenne</th>
                <th>ECTS</th>
                <th>Grades</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($coursList as $cours) { ?>
                <tr>
                    <th scope="row"><a class="lien_tableau"
                            id="releve_cours_<?php echo $cours->GetId(); ?>"><?php echo $cours->GetNom(); ?></a></th>
                    <td><?php
                        $moyenne = GetMoyenneFromCours($cours->GetId(), $idEtudiant);
                        if($moyenne == -1)
                            echo "-";
                        else
                            echo $moyenne;
                        ?></td>
                    <td><?php echo $cours->GetCredits(); ?></td>
                    <td>A</td>
                </tr>
            <?php } ?>
            </tbody>
            <tfoot>
            <tr>
                <th>Total</th>
                <th>13</th>
                <th><?php echo $credits_competence; ?></th>
                <th>A</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>