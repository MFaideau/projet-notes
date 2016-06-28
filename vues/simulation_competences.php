<?php defined("ROOT_ACCESS") or die(); ?>
<!-- Page de données !-->
<div class="row donnees donnees_tableaux">
    <div class="panel panel-default">
        <div class="panel-heading">
            <a href="javascript:impressionReleve();"><span
                    class="glyphicon glyphicon glyphicon-print retour_prec_histo"></span></a>
            Relevé de notes
        </div>
        <div class="panel_listing">
            <table class="table">
                <thead>
                <tr>
                    <th>Libellé</th>
                    <th>Coef</th>
                    <th>Note</th>
                    <?php if ($user->GetAutorite()!=0){ ?>
                    <th>Excusé</th><?php } ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($competences as $competence) { ?>
                    <tr>
                        <td class="lien_tableau" scope="row">
                            <a class="lien_tableau" id="simu_comp_id_<?php echo $competence->GetId(); ?>">
                                <b><?php echo $competence->GetNom();?></b>
                            </a>
                        </td>
                        <td class="lien_tableau"><b><?php echo $competence->GetCredits(); ?></b></td>
                        <td class="lien_tableau"><b>
                                <?php
                                $note_etudiant = round(GetMoyenneFromCompetence($competence->GetId(), $idEtudiant, true), 2);
                                if ($note_etudiant == "-1")
                                    echo "-";
                                else
                                    echo round($note_etudiant, 2);
                                ?></b>
                        </td>
                        <?php if ($user->GetAutorite()!=0){ ?>
                            <td></td><?php } ?>
                    </tr>
                    <?php foreach (GetCoursListFromCompetence($competence->GetId()) as $cours) { ?>
                        <tr class="simu_cours_comp_<?php echo $competence->GetId(); ?>_id_<?php echo $cours->GetId(); ?>">
                            <td style="color: #337ab7;" id="nom_cours"><a
                                    id="simu_cours_<?php echo $cours->GetId(); ?>"><?php echo $cours->GetNom(); ?></a>
                            </td>
                            <td style="color: #337ab7;"><b><?php echo $cours->GetCredits(); ?></b></td>
                            <td style="color: #337ab7;">
                                <b><?php $note = GetMoyenneFromCours($cours->GetId(), $idEtudiant, true);
                                    if ($note == "-1")
                                        echo "-";
                                    else
                                        echo round($note, 2);
                                    ?>
                                </b>
                            </td>
                            <?php if ($user->GetAutorite()!=0){ ?>
                                <td></td><?php } ?>
                        </tr>
                        <?php foreach (GetTypeEvalListFromCours($cours->GetId()) as $typeEval) { ?>
                            <tr id="typeEval_comp_<?php echo $competence->GetId(); ?>"
                                class="simu_cours_<?php echo $cours->GetId(); ?>_type_eval_<?php echo $typeEval->GetId(); ?>">
                                <td id="nom_type_eval"><a style="color: black;"
                                                          id="simu_type_eval_<?php echo $typeEval->GetId(); ?>">
                                        <b><?php echo $typeEval->GetNom(); ?></b></a>
                                </td>
                                <td><b><?php echo $typeEval->GetCoef() * 100; ?></b></td>
                                <td>
                                    <b><?php
                                        $note = GetMoyenneFromTypeEval($typeEval->GetId(), $idEtudiant, true);
                                        if ($note == "-1")
                                            echo "-"; // Pas de note disponible pour le moment pour les épreuves de ce type eval
                                        else
                                            echo round($note, 2);
                                        ?>
                                    </b>
                                </td>
                                <?php if ($user->GetAutorite()!=0){ ?>
                                    <td></td><?php } ?>
                            </tr>
                            <?php foreach (GetEpreuveListFromTypeEval($typeEval->GetId()) as $epreuve) {
                                $etudiantNote = GetEtudiantNoteFromEtudiantEpreuve($idEtudiant, $epreuve->GetId()); ?>
                                <tr id="bloc_simu_comp_<?php echo $competence->GetId(); ?>_epreuve_<?php echo $epreuve->GetId(); ?>"
                                    class="simu_type_eval_<?php echo $typeEval->GetId(); ?>_epreuve_<?php echo $epreuve->GetId(); ?>">
                                    <td id="nom_epreuve_<?php echo $epreuve->GetId(); ?>">
                                        <span id="nom_epreuve"><a style="color: black;">
                                            <?php echo $epreuve->GetNom(); ?>
                                        </a
                                        </span></td>
                                    <td><?php echo $epreuve->GetCoef() * 100; ?></td>
                                    <td>
                                        <?php
                                        if (isset($etudiantNote)) {
                                            $note = $etudiantNote->GetNoteFinale();
                                            if ($note != "-1" && $user->GetAutorite() == 0) {
                                                echo $note;
                                            } else {
                                                // Si l'étudiant n'a pas de note, on lui crée un champ
                                                ?>
                                                <input type="number" min="0" max="20"
                                                       name="note_epreuve_<?php echo $epreuve->GetId(); ?>"
                                                       value="<?php
                                                       if ($user->GetAutorite() == 1)
                                                           echo $note;
                                                       else
                                                           echo $etudiantNote->GetNotePrevue(); ?>"
                                                />
                                                <?php
                                            }
                                        } else {
                                            // Si l'étudiant n'a pas de note, on lui crée un champ
                                            ?>
                                            <input type="number" min="0" max="20"
                                                   name="note_epreuve_<?php echo $epreuve->GetId(); ?>"
                                                   value=""
                                            />
                                            <?php
                                        } ?>
                                    </td>
                                    <td>
                                    <?php // Menu d'absence
                                    if ($user->GetAutorite() != 0) {
                                        if (isset($etudiantNote)) { ?>
                                            <input type="checkbox" id="absence_epreuve_<?php echo $epreuve->GetId(); ?>"
                                            <?php if ($etudiantNote->GetAbsence() == 1) echo " checked" ?>
                                            <?php
                                        }
                                    }
                                    ?>
                                    </td>
                                </tr>
                            <?php }
                        } ?>
                    <?php }
                } ?>
                </tbody>
                <?php
                if (!empty($competences)) {
                    ?>
                    <tfoot>
                    <tr>
                        <td><strong>Total</strong></td>
                        <td><strong><?php echo $cursus->GetCredits(); ?></strong></td>
                        <td id="moyenne_generale"><strong>
                                <?php
                                $note_etudiant = round(GetMoyenneFromCursus($cursus->GetId(), $etudiant->GetId(), true), 2);
                                echo $note_etudiant;
                                ?>
                            </strong>
                        </td>
                        <td></td>
                    </tr>
                    </tfoot>
                <?php } ?>
            </table>
        </div>
    </div>
</div>