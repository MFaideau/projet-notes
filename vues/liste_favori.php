<!-- Page du listing des eleves les plus consultés !-->
<?php defined("ROOT_ACCESS") or die(); ?>
<?php global $listEleves; ?>
<div class="panel_listing">
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
            if(isset($etudiant)) { ?>
            <tr>
                <td><a href="visualisation_eleve.php?id=<?php echo $etudiant->GetMail(); ?>"><?php echo $etudiant->GetNom() . ' ' . $etudiant->GetPrenom(); ?></a></td>
                <td><?php echo round(GetMoyenneFromCursus(GetEtudiant($etudiant)->GetCursus()->GetId(), $eleve->GetId()),2); ?></td>
            </tr>
        <?php } } ?>
        </tbody>
    </table>
</div>