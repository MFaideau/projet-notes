<!-- Page de données !-->
<div class="row donnees donnees_tableaux">
    <div class="panel panel-default">
        <div class="panel-heading">Relevé de notes</div>
        <div class="panel_listing">
            <table class="table" data-toggle="table">
                <thead>
                    <tr>
                        <th>Libellé</th>
                        <th>Coef</th>
                        <th>Note</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($competences as $competence) { ?>
                        <tr>
                            <td class="lien_tableau" scope="row">
                                <a class="lien_tableau" id="simu_comp_id_<?php echo $competence->GetId(); ?>">
                                    <b><?php echo $competence->GetNom(); ?></b>
                                </a>
                            </td>
                            <td><?php echo $competence->GetCredits(); ?></td>
                            <td>
                                <?php
                                $note_etudiant = round(GetMoyenneFromCompetence($competence->GetId(), $idEtudiant), 2);
                                echo $note_etudiant;
                                ?>
                            </td>
                        </tr>
                        <?php foreach (GetCoursListFromCompetence($competence->GetId()) as $cours) { ?>
                        <tr class="simu_cours_comp_<?php echo $competence->GetId(); ?>_id_<?php echo $cours->GetId(); ?>">
                            <td id="nom_cours"><a id="simu_cours_<?php echo $cours->GetId(); ?>"><?php echo $cours->GetNom(); ?></a></td>
                            <td><?php echo $cours->GetCredits(); ?></td>
                            <td><?php echo GetMoyenneFromCours($cours->GetId(), $idEtudiant); ?></td>
                        </tr>
                            <?php foreach (GetTypeEvalListFromCours($cours->GetId()) as $typeEval) { ?>
                            <tr class="simu_cours_<?php echo $cours->GetId(); ?>_id_<?php echo $typeEval->GetId(); ?>">
                                <td id="nom_type_eval"><a style="color: black;" id="simu_type_eval_<?php echo $competence->GetId(); ?>"><?php echo $typeEval->GetNom(); ?></a></td>
                                <td><?php echo $typeEval->GetCoef() * 100; ?></td>
                                <td>-</td>
                            </tr>
                                <?php foreach (GetEpreuveListFromTypeEval($typeEval->GetId()) as $epreuve) { ?>
                                <tr>
                                    <td id="nom_epreuve"><?php echo $epreuve->GetNom(); ?></td>
                                    <td><?php echo $epreuve->GetCoef() * 100; ?></td>
                                    <td>
                                        <?php
                                            $note = GetEtudiantNoteFromEtudiantEpreuve($idEtudiant, $epreuve->GetId())->GetNoteFinale();
                                            
                                        ?>
                                    </td>
                                </tr>
                    <?php } } ?>
                            <?php } } ?>
                </tbody>
                <?php
                if (!empty($competences)) {
                    ?>
                    <tfoot>
                        <tr>
                            <td><b>Total</b></td>
                            <td><b><?php echo $cursus->GetCredits(); ?></b></td>
                            <td><b>
                                    <?php
                                    $note_etudiant = round(GetMoyenneFromCursus(GetEtudiant($user)->GetCursus()->GetId(), GetEtudiant($user)->GetId()), 2);
                                    echo $note_etudiant;
                                    ?>
                                </b>
                            </td>
                        </tr>
                    </tfoot>
                <?php } ?>
            </table>
        </div>
    </div>
</div>