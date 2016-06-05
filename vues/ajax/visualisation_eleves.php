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
                <td>Mark</td>
            </tr>
        <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td class="ajoutEtudiant" colspan="3"><span class="glyphicon glyphicon-plus-sign icone"></span>
                <a href="#ajoutEtudiant">Ajouter un étudiant</a></td>
            </tr>
        </tfoot>
    </table>
</div>