<?php defined("ROOT_ACCESS") or die(); ?>
<div class="panel_listing decale_admin">
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
        if (isset($etudiantAssocie)) {
            $etudiantNote = GetEtudiantNoteFromEtudiantEpreuve($etudiantAssocie->GetId(),$listIdEpreuve);
            if (isset($etudiantNote)) { ?>
            <tr>
                <td><a data-name="nom" data-value="<?php echo $eleve->GetNom() . $eleve->GetPrenom(); ?>"href="visualisation_eleve.php?id=<?php echo $eleve->GetMail(); ?>"><?php echo $eleve->GetNom() . ' ' . $eleve->GetPrenom(); ?></a></td>
                <?php if ($etudiantNote->GetAbsence() == 1)
                {?>
                    <td>Absent</td>
                <?php }
                elseif ($etudiantNote->GetAbsence() == 2)
                {?>
                    <td>0</td>
                <?php }
                else { ?>
                    <td><?php $note = round($etudiantNote->GetNoteFinale(),2);
                        if($note == "-1")
                            echo $note;
                        else
                            echo "-";
                        ?>
                    </td>
                <?php } ?>
            </tr>
        <?php }}} ?>
        </tbody>
    </table>
</div>