<?php defined("ROOT_ACCESS") or die(); ?>
<!-- Modification d'un cursus !-->
<div class="modal fade" id="modifyCursus" tabindex="-1" role="dialog" aria-labelledby="modifyCursus">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="modifyCursus">
                <input type="hidden" id="idCursus" value="" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modification d'un cursus</h4>
                </div>
                <div class="modal-body">
                    <fieldset class="form-group">
                        <label for="labelCursus">Nom du cursus :</label>
                        <input type="text" class="form-control" id="nomCursus" placeholder="Exemple : CSI3">
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="labelAnnee">Année du cursus :</label>
                        <input type="text" class="form-control" id="anneeCursus"
                               placeholder="Exemple : 2015 pour année 2015-2016">
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modification d'une compétence !-->
<div class="modal fade" id="modifyCompetence" tabindex="-1" role="dialog" aria-labelledby="modifyCompetence">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="modifyCompetence">
                <input type="hidden" id="id_competence_modif" value="" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modification d'une compétence</h4>
                </div>
                <div class="modal-body">
                    <fieldset class="form-group">
                        <label for="labelCompetence">Nom de la compétence :</label>
                        <input type="text" class="form-control" id="nomCompetence"
                               placeholder="Exemple : Physique, Electronique et Nanotechnologies">
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modification d'un cours !-->
<div class="modal fade" id="modifyCours" tabindex="-1" role="dialog" aria-labelledby="modifyCours">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="modifyCours">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modification d'un cours</h4>
                </div>
                <div class="modal-body">
                    <fieldset class="form-group">
                        <label for="labelCours">Nom du cours :</label>
                        <input type="text" class="form-control" id="nomCours"
                               placeholder="Exemple : Mécanique Quantique">
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="labelCreditsCours">Nombre de crédits ECTS :</label>
                        <input type="text" class="form-control" id="nbCreditsCours" placeholder="Exemple : 2.5">
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="labelSemestreCours">Semestre :</label>
                        <select class="selectpicker form-control" name="semestreCours" id="semestreCours">
                            <option value="0">Semestres 1 et 2</option>
                            <option value="1">Semestre 1</option>
                            <option value="2">Semestre 2</option>
                        </select>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modification de l'évaluation !-->
<div class="modal fade" id="modifyEval" tabindex="-1" role="dialog" aria-labelledby="modifyEval">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="modifyEval">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modification d'une évaluation</h4>
                </div>
                <div class="modal-body">
                    <fieldset class="form-group">
                        <label for="labelEval">Nom de l'évaluation :</label>
                        <input type="text" class="form-control" id="nomEval" placeholder="Exemple : Théorie">
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="labelCoefEval">Coefficient de l'évaluation :</label>
                        <input type="text" class="form-control" id="coefEval" placeholder="Exemple : 0.5 (pour 50%)">
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modification d'un type d'évaluation !-->
<div class="modal fade" id="modifyTypeEval" tabindex="-1" role="dialog" aria-labelledby="modifyTypeEval">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="modifyTypeEval">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modification d'un type d'évaluation</h4>
                </div>
                <div class="modal-body">
                    <fieldset class="form-group">
                        <label for="labelTypeEval">Nom du type d'évaluation :</label>
                        <input type="text" class="form-control" id="nomTypeEval"
                               placeholder="Exemple : Partiel">
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="labelCoefTypeEval">Coefficient du type d'évaluation :</label>
                        <input type="text" class="form-control" id="coefTypeEval" placeholder="Exemple : 0.5 (pour 50%)">
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modification d'une épreuve !-->
<div class="modal fade" id="modifyEpreuve" tabindex="-1" role="dialog" aria-labelledby="modifyEpreuve">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="modifyEpreuve">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modification d'une épreuve</h4>
                </div>
                <div class="modal-body">
                    <fieldset class="form-group">
                        <label for="labelNomEpreuve">Nom de l'épreuve :</label>
                        <input type="text" class="form-control" id="nomEpreuve"
                               placeholder="Exemple : DS Base de Données">
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="labelCoefEpreuve">Coefficient de l'épreuve :</label>
                        <input type="text" class="form-control" id="coefEpreuve" placeholder="Exemple : 0.5 (pour 50%)">
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="labelDateEpreuve">Date de l'épreuve :</label>
                        <div class="input-group input-append date" id="datePicker2">
                            <input id="dateEpreuve" type="text" class="form-control">
                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="labelEvaluation">Évaluateur(s) de l'épreuve :</label>
                        <input type="text" class="form-control" id="evaluateurEpreuve" placeholder="Exemple : Xavier Wallart">
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="labelSecondeSession">Épreuve correspondant à la seconde session :</label>
                        <select class="selectpicker form-control" name="secondeSessions" id="selectSecondeSession">
                            <option value="0">Aucune seconde session</option>
                        </select>
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="labelSubstitution">Épreuve qui prime en cas d'absence excusée :</label>
                        <select class="selectpicker form-control" id="selectSubstitution" name="substitution">
                            <option value="0">Pas de note en cas d'absence</option>
                        </select>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>