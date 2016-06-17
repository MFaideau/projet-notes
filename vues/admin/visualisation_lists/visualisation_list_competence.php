<div class="panel_listing">
    <table class="table" data-toggle="table" data-sort-name="nom" data-sort-order="asc">
        <thead>
        <tr>
            <th data-field="nom" data-sortable="true">Nom</th>
            <th data-field="moyenne" data-sortable="true">Moyenne générale</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($listEleves as $eleve) {
        $etudiantAssocie = GetEtudiant($eleve);
        if (isset($etudiantAssocie)) {?>
            <tr>
                <td><a data-name="nom" data-value="<?php echo $eleve->GetNom() . $eleve->GetPrenom(); ?>"href="visualisation_eleve.php?id=<?php echo $eleve->GetMail(); ?>"><?php echo $eleve->GetNom() . ' ' . $eleve->GetPrenom(); ?></a></td>
                <td><?php echo round(GetMoyenneFromCompetence($listIdCompetence,$etudiantAssocie->GetId()),2); ?></td>
            </tr>
        <?php }} ?>
        </tbody>
    </table>
</div>