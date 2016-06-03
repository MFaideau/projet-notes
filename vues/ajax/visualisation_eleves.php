<?php global $listEleves; ?>
<div class="panel_listing">
    <table class="table" data-toggle="table" data-sort-name="nom" data-sort-order="desc">
        <thead>
        <tr>
            <th data-field="nom" data-sortable="true">Nom</th>
            <th data-field="moyenne" data-sortable="true">Moyenne générale</th>
        </tr>
        </thead>
        <tbody>
         <?php foreach ($listEleves as $eleve) { ?>
        <tr>
            <td ><?php echo $eleve->GetNom() . ' ' . $eleve->GetPrenom(); ?></td>
            <td>Mark</td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    <table data-toggle="table"
    >
    <thead>
        <tr>
            <th data-field="fruit" data-sortable="true">Item</th>
            <th data-field="date"  data-sortable="true" data-sort-name="_date_data" data-sorter="monthSorter">Date</th>
            <th data-field="type"  data-sortable="true">Type</th>
        </tr>
    </thead>
    <tbody>
        <tr><td>Pear  </td><td data-month="1">January</td> <td>Fruit</td></tr>
        <tr><td>Carrot</td><td data-month="3">March</td>   <td>Vegetable</td></tr>
        <tr><td>Apple </td><td data-month="2">February</td><td>Fruit</td></tr>
    </tbody>
</table>

</div>