<?php defined("ROOT_ACCESS") or die(); ?>
<div class="panel_listing decale_admin">
<table class="table" data-toggle="table" data-sort-name="nom" data-sort-order="asc">
    <thead>
        <th><a id="insert_admin" class="link" data-toggle="modal" data-target="#insertAdmin"><span class="glyphicon glyphicon-plus icone"></span></a></th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Adresse mail</th>
        <th>Autorité</th>
    </thead>
<tbody>
<?php foreach ($usersList as $currentUser) {
    if (($currentUser->GetAutorite() > 0) && $currentUser->GetMail() == $user->GetMail()) { ?>
        <tr id="admin_tr_<?php echo $currentUser->GetMail(); ?>">
            <td></td>
            <td id="admin_nom_<?php echo $currentUser->GetMail(); ?>"><?php echo $currentUser->GetNom(); ?></td>
            <td id="admin_prenom_<?php echo $currentUser->GetMail(); ?>"><?php echo $currentUser->GetPrenom(); ?></td>
            <td id="admin_mail_<?php echo $currentUser->GetMail(); ?>"><?php echo $currentUser->GetMail(); ?></td>
            <td id="admin_autorite_<?php echo $currentUser->GetMail(); ?>">
                <?php if($currentUser->GetAutorite() == 1){ echo "Administrateur";} else if($currentUser->GetAutorite() == 2){echo "Visiteur";}; ?>
            </td>
        </tr>  <?php }} ?>
<?php foreach ($usersList as $currentUser) {
    if (($currentUser->GetAutorite() > 0) && $currentUser->GetMail() != $user->GetMail()) { ?>
        <tr id="admin_tr_<?php echo $currentUser->GetMail(); ?>">
            <td>
                <a id="delete_link_admin_<?php echo $currentUser->GetMail(); ?>" class="link" data-toggle="modal" data-target="#deleteAdmin"><span class="glyphicon glyphicon-minus-sign icone"></span></a>
                <a id="modify_link_admin_<?php echo $currentUser->GetMail(); ?>" class="link" data-toggle="modal" data-target="#modifyAdmin"><span class="glyphicon glyphicon-edit icone"></span></a>
            </td>
            <td id="admin_nom_<?php echo $currentUser->GetMail(); ?>"><?php echo $currentUser->GetNom(); ?></td>
            <td id="admin_prenom_<?php echo $currentUser->GetMail(); ?>"><?php echo $currentUser->GetPrenom(); ?></td>
            <td id="admin_mail_<?php echo $currentUser->GetMail(); ?>"><?php echo $currentUser->GetMail(); ?></td>
            <td id="admin_autorite_<?php echo $currentUser->GetMail(); ?>">
                <?php if($currentUser->GetAutorite() == 1){ echo "Administrateur";} else if($currentUser->GetAutorite() == 2){echo "Visiteur";}; ?>
            </td>
        </tr>  <?php }} ?>
</tbody>
</table>
</div>

<div class="modal fade" id="insertAdmin" tabindex="-1" role="dialog" aria-labelledby="insertAdmin">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="insertAdmin">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Ajout d'un compte</h4>
                </div>
                <div class="modal-body">
                    <fieldset class="form-group">
                        <label for="labelNom">Nom :</label>
                        <input type="text" class="form-control" id="nomCompteInsert" placeholder="Exemple : Boulinguez">
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="labelPrenom">Prénom :</label>
                        <input type="text" class="form-control" id="prenomCompteInsert" placeholder="Exemple : David">
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="labelMail">Mail (doit être une adresse Google) :</label>
                        <input type="text" class="form-control" id="mailCompteInsert" placeholder="Exemple : david.boulinguez@isen-lille.fr">
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="labelAutorite">Autorité :</label>
                        <select class="selectpicker form-control" id="autoriteCompteInsert">
                            <option value="1">Administrateur</option>
                            <option value="2">Visiteur</option>
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

<div class="modal fade" id="modifyAdmin" tabindex="-1" role="dialog" aria-labelledby="modifyAdmin">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="modifyAdmin">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modification d'un compte</h4>
                </div>
                <div class="modal-body">
                    <fieldset class="form-group">
                        <label for="labelNom">Nom :</label>
                        <input type="text" class="form-control" id="nomCompte" placeholder="Exemple : Carette">
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="labelPrenom">Prénom :</label>
                        <input type="text" class="form-control" id="prenomCompte" placeholder="Exemple : Thierry">
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="labelMail">Mail (doit être une adresse Google) :</label>
                        <input type="text" class="form-control" id="mailCompte" placeholder="Exemple : thierry.carette@isen-lille.fr">
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="labelAutorite">Autorité :</label>
                        <select class="selectpicker form-control" name="autoriteCompte" id="autoriteCompte">
                            <option value="1">Administrateur</option>
                            <option value="2">Visiteur</option>
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

<div class="modal fade" id="deleteAdmin" tabindex="-1" role="dialog" aria-labelledby="deleteAdmin">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="deleteAdmin">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modification d'un compte</h4>
                </div>
                <div class="modal-body">
                     Voulez-vous vraiment supprimer cet utilisateur ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
                    <button type="submit" class="btn btn-primary">Oui</button>
                </div>
            </form>
        </div>
    </div>
</div>