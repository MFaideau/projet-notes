<?php defined("ROOT_ACCESS") or die();
global $listEleves;
global $autorite; ?>
<div class="panel_listing decale_admin">
    <table class="table" data-toggle="table" data-sort-name="nom" data-sort-order="asc">
        <thead>
        <tr>
            <?php if ($autorite == 1) { ?>
                <th data-field="action" data-sortable="false">Action</th>
            <?php } ?>
            <th data-field="nom" data-sortable="true">Nom</th>
            <th data-field="moyenne" data-sortable="true">Moyenne générale</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($listEleves as $eleve) {
            $etudiant = GetEtudiant($eleve);
            if (isset($etudiant)) { ?>
                <tr id="etudiant_tr_<?php echo $eleve->GetMail(); ?>">
                    <?php
                    if ($autorite == 1) { ?>
                        <td><a class="link" data-toggle="modal" data-target="#deleteEtudiant"
                               id="deleteEtudiant_<?php echo $eleve->GetMail(); ?>"><span
                                class="glyphicon glyphicon-minus-sign icone"></span></a></td><?php } ?>
                    <td><a data-name="nom" data-value="<?php echo $eleve->GetNom() . $eleve->GetPrenom(); ?>"
                           href="visualisation_eleve.php?id=<?php echo $eleve->GetMail(); ?>"><?php echo $eleve->GetNom() . ' ' . $eleve->GetPrenom(); ?></a>
                    </td>
                    <td><?php $moyenne = round(GetMoyenneFromCursusCalc($etudiant->GetCursus()->GetId(), $etudiant->GetId()), 2);
                        if ($moyenne == "-1")
                            echo "-";
                        else
                            echo $moyenne;
                        ?>
                    </td>
                </tr>
            <?php }
        } ?>
        </tbody>
        <tfoot>
        <?php if ($autorite == 1) { ?>
            <tr>
                <td class="ajoutEtudiant" colspan="3">
                    <span class="glyphicon glyphicon-plus-sign icone"></span>
                    <a class="link" data-toggle="modal" data-target="#addEtudiant" style="padding-left: 0.5%">Ajouter un
                        étudiant</a>
                </td>
            </tr>
            <tr>
                <td class="ajoutEtudiant" colspan="3">
                    <span class="glyphicon glyphicon-open-file icone"></span>
                    <a class="link" data-toggle="modal" data-target="#importListEtudiant" style="padding-left: 0.5%">Importer
                        une liste d'étudiants</a>
                </td>
            </tr>
        <?php } ?>
        </tfoot>
    </table>
</div>

<div class="modal fade" id="importListEtudiant" tabindex="-1" role="dialog" aria-labelledby="importListEtudiant">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="visualisation_eleve.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Importer une liste d'étudiants</h4>
                </div>
                <div class="modal-body">
                    <fieldset class="form-group">
                        <label for="nomUpload">Saisie du fichier d'étudiants:</label>
                        <input type="hidden" name="MAX_FILE_SIZE" value="1048576"/>
                        <input type="hidden" name="idCursusUpload" id="idCursusUpload" value=""/>
                        <input type="file" name="fichier_eleves" id="fichier_eleves"/><br/>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <input type="submit" name="submit" class="btn btn-primary" value="Enregistrer"/>
                </div>
            </form>
        </div>
    </div>
</div>