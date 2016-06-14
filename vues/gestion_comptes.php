<div class="panel_listing">
<table class="table" data-toggle="table" data-sort-name="nom" data-sort-order="asc">
    <thead>
        <th></th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Adresse mail</th>
        <th>Autorité</th>
    </thead>
<tbody>
<?php foreach ($usersList as $currentUser) {
    if ($currentUser->GetAutorite() > 0) { ?>
        <tr>
            <td>
                <?php if ($currentUser->GetMail() != $user->GetMail()){ ?>
                <a class="link" data-toggle="modal" data-target="#verifDeleteTypeEval"><span class="glyphicon glyphicon-minus-sign icone"></span></a>
                <a class="link" data-toggle="modal" data-target="#verifDeleteTypeEval"><span class="glyphicon glyphicon-edit icone"></span><?php } ?></a>
            </td>
            <td><?php echo $currentUser->GetNom(); ?></td>
            <td><?php echo $currentUser->GetPrenom(); ?></td>
            <td><?php echo $currentUser->GetMail(); ?></td>
            <td><?php echo $currentUser->GetAutorite(); ?></td>
        </tr>  <?php } } ?>
</tbody>
</table>
</div>