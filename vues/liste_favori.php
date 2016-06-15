<!-- Page du listing des eleves les plus consultés !-->

<?php global $listEleves; ?>
<div class="panel_listing">
    <table class="table" data-toggle="table" data-sort-name="nom" data-sort-order="asc">
        <thead>
        <tr>
            <th data-field="nom" data-sortable="true">Nom</th>
            <th data-field="moyenne" data-sortable="true">Moyenne générale</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($listTop as $eleve) { ?>
                <b></b>
            <?php } ?>
        </tbody>
    </table>
</div>