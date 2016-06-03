<?php global $listEleves; ?>
<div class="panel_listing">
    <table class="table">
        <thead>
        <tr>
            <th>Nom</th>
            <th>Moyenne générale</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($listEleves as $eleve) { ?>
        <tr>
            <th><?php echo $eleve->GetNom() . ' ' . $eleve->GetPrenom(); ?></th>
            <td>Mark</td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
