<?php defined("ROOT_ACCESS") or die();
global $listEleves;
global $autorite; ?>
<div class="panel_listing">
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
        <?php foreach ($listEleves as $eleve) { $etudiant = GetEtudiant($eleve);
            if(isset($etudiant)) { ?>
            <tr id="etudiant_tr_<?php echo $eleve->GetMail(); ?>">
                <?php
                if($autorite == 1) { ?>
                <td><a class="link" data-toggle="modal" data-target="#deleteEtudiant" id="deleteEtudiant_<?php echo $eleve->GetMail(); ?>"><span class="glyphicon glyphicon-minus-sign icone"></span></a></td><?php } ?>
                <td><a data-name="nom" data-value="<?php echo $eleve->GetNom() . $eleve->GetPrenom(); ?>"href="visualisation_eleve.php?id=<?php echo $eleve->GetMail(); ?>"><?php echo $eleve->GetNom() . ' ' . $eleve->GetPrenom(); ?></a></td>
                <td><?php echo round(GetMoyenneFromCursus($etudiant->GetCursus()->GetId(), $etudiant->GetId()),2); ?></td>
            </tr>
        <?php } } ?>
        </tbody>
        <tfoot>
        <?php if ($autorite == 1) { ?>
            <tr>
                <td class="ajoutEtudiant" colspan="3">
                    <span class="glyphicon glyphicon-plus-sign icone"></span>
                    <a class="link" data-toggle="modal" data-target="#addEtudiant" style="padding-left: 0.5%">Ajouter un étudiant</a>
                </td>
            </tr>
        <?php } ?>
        </tfoot>
    </table>
</div>
