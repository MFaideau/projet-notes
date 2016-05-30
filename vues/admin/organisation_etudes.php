<div class="panel_cursus">
    <div class="panel panel-default saisie_notes">
        <div class="panel-heading">
            Choix du Cursus
            <div class="add_button_etudes">
                <a data-toggle="modal" data-target="#addCursus">
                    <i class="glyphicon glyphicon-plus"></i>
                </a>
            </div>
        </div>
        <div class="panel-body panel_cursus_choix">
            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                <?php foreach (GetCursusList() as $cursus) { ?>
                    <div class="btn-group" role="group">
                        <button id="orga_cursus_<?php echo $cursus->GetId(); ?>" type="button"
                                class="btn btn-default"><?php echo $cursus->GetNom(); ?></button>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>


<!-- Ajout d'un cursus !-->
<div class="modal fade" id="addCursus" tabindex="-1" role="dialog" aria-labelledby="addCursus">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addCursus">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Ajout d'un cursus</h4>
                </div>
                <div class="modal-body">
                    <fieldset class="form-group">
                        <label for="labelCursus">Nom du cursus :</label>
                        <input type="text" class="form-control" id="nomCursus" placeholder="Exemple : CSI3">
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


<!-- Ajout d'une compétence !-->
<div class="modal fade" id="addCompetence" tabindex="-1" role="dialog" aria-labelledby="addCompetence">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ajout d'une compétence</h4>
            </div>
            <div class="modal-body">
                Veuillez remplir le formulaire sur cette page

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </div>
</div>

<!-- Ajout d'un cours !-->
<div class="modal fade" id="addCours" tabindex="-1" role="dialog" aria-labelledby="addCours">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ajout d'un cours</h4>
            </div>
            <div class="modal-body">
                Veuillez remplir le formulaire sur cette page

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </div>
</div>

<!-- Ajout d'un type d'évaluation !-->
<div class="modal fade" id="addTypeEval" tabindex="-1" role="dialog" aria-labelledby="addTypeEval">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ajout d'un Type d'Evaluation</h4>
            </div>
            <div class="modal-body">
                Veuillez remplir le formulaire sur cette page

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </div>
</div>

<!-- Ajout d'une épreuve !-->
<div class="modal fade" id="addEpreuve" tabindex="-1" role="dialog" aria-labelledby="addEpreuve">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ajout d'une Epreuve</h4>
            </div>
            <div class="modal-body">
                Veuillez remplir le formulaire sur cette page

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </div>
</div>

