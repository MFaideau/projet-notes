<!-- Page du listing des eleves les plus consultés !-->
<?php defined("ROOT_ACCESS") or die(); ?>
<?php global $listEleves; ?>
<div class="panel_listing decale_admin">
    <div id="topConsultations" class="panel panel-default choix_cursus_eleves">
        <div class="panel-heading">
            Etudiants les plus consultés
            <a data-toggle="modal" data-target="#deleteTopConsult" class="add_button_etudes">
                <i class="glyphicon glyphicon-remove-circle" title="Supprimer la liste des consultations"></i>
            </a>
        </div>
        <div class="panel-body">
            <table class="table" data-toggle="table">
                <thead>
                <tr>
                    <th data-field="nom" data-sortable="true">Nom</th>
                    <th data-field="moyenne" data-sortable="true">Moyenne générale</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($topConsult as $eleve) {
                    $etudiant = GetUserFromEtudiant($eleve->GetId());
                    if (isset($etudiant)) { ?>
                        <tr>
                            <td>
                                <a href="visualisation_eleve.php?id=<?php echo $etudiant->GetMail(); ?>"><?php echo $etudiant->GetNom() . ' ' . $etudiant->GetPrenom(); ?></a>
                            </td>
                            <td><?php $moyenne = round(GetMoyenneFromCursusCalc(GetEtudiant($etudiant)->GetCursus()->GetId(), $eleve->GetId()), 2);
                                if($moyenne == -1)
                                    echo "-";
                                else
                                    echo $moyenne;
                                ?></td>
                        </tr>
                    <?php }
                } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Fenetre de validation de la suppression du TOP 10 !-->
<div class="modal fade" id="deleteTopConsult" tabindex="-1" role="dialog" aria-labelledby="deleteTopConsult">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="deleteTopConsult">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Supprimer la liste des consultations</h4>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer votre liste des étudiants les plus consultés ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
                    <button type="submit" class="btn btn-primary">Oui</button>
                </div>
            </form>
        </div>
    </div>
</div>