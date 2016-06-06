<?php global $listEleves; ?>
<div class="panel_listing">
    <table class="table" data-toggle="table" data-sort-name="nom" data-sort-order="asc">
        <thead>
        <tr>
            <th data-field="action" data-sortable="false">Action</th>
            <th data-field="nom" data-sortable="true">Nom</th>
            <th data-field="moyenne" data-sortable="true">Moyenne générale</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($listEleves as $eleve) { ?>
            <tr>
                <td width="2%"><a href="#deleteEtudiant"><span class="glyphicon glyphicon-minus-sign icone"></span></a></td>
                <td><a data-name="nom" data-value="<?php echo $eleve->GetNom() . $eleve->GetPrenom(); ?>"
                       href="visualisation_eleve.php?id=<?php echo $eleve->GetMail(); ?>">
                        <?php echo $eleve->GetNom() . ' ' . $eleve->GetPrenom(); ?></a></td>
                <td><?php echo rand(0,20); ?></td>
            </tr>
        <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td class="ajoutEtudiant" colspan="3"><span class="glyphicon glyphicon-plus-sign icone"></span>
                <a href="#" data-toggle="modal" data-target="#ajoutEtudiant">Ajouter un étudiant</a></td>
            </tr>
        </tfoot>
    </table>
</div>

<!-- Modification d'une compétence !-->
<div class="modal fade" id="ajoutEtudiant" tabindex="-1" role="dialog" aria-labelledby="ajoutEtudiant">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="ajoutEtudiant">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Ajouter un étudiant</h4>
                </div>
                <div class="modal-body">
                    <form id="addEtudiantForm">
                        <input type="hidden" id="id_cursus_add_etudiant" value="" />
                        <fieldset class="form-group">
                            <label for="labelNom">Nom de l'étudiant :</label>
                            <input type="text" class="form-control" id="nomEtudiant">
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="labelPrenom">Prénom de l'étudiant :</label>
                            <input type="text" class="form-control" id="prenomEtudiant">
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="labelMail">Mail de l'étudiant :</label>
                            <input type="text" class="form-control" id="mailEtudiant" placeholder="prenom.nom@isen-lille.fr">
                        </fieldset>
                        L'étudiant sera ajouté au cursus <strong><span id="cursus_add_etudiant"></span></strong>.
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
