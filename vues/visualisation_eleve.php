<div class="panel_choix_eleves">
    <div class="panel panel-default choix_cursus_eleves">
        <div class="panel-heading">Choix du Cursus</div>
        <div class="panel-body">
            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                <?php foreach (GetCursusList() as $cursus) { ?>
                    <div class="btn-group" role="group">
                        <button id="eleves_cursus_<?php echo $cursus->GetId(); ?>" type="button"
                                class="btn btn-default"><?php echo $cursus->GetNom(); ?></button>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addEtudiant" tabindex="-1" role="dialog" aria-labelledby="addEtudiant">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addEtudiantForm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Ajouter un étudiant</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_cursus_add_etudiant" value="" />
                    <fieldset class="form-group">
                        <label for="labelIdEtudiant">ID de l'étudiant :</label>
                        <input type="text" class="form-control" id="idEtudiant" />
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="labelNom">Nom de l'étudiant :</label>
                        <input type="text" class="form-control" id="nomEtudiant" />
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="labelPrenom">Prénom de l'étudiant :</label>
                        <input type="text" class="form-control" id="prenomEtudiant" />
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="labelMail">Mail de l'étudiant :</label>
                        <input type="text" class="form-control" id="mailEtudiant" placeholder="prenom.nom@isen-lille.fr" />
                    </fieldset>
                    L'étudiant sera ajouté au cursus <strong><span id="cursus_add_etudiant"></span></strong>.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>