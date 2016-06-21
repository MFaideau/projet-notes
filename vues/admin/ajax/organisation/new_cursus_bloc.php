<?php defined("ROOT_ACCESS") or die(); ?>
<tr id="orga_tr_cursus_<?php echo $idCursusNew; ?>">
    <td>
         <span class="orgaEdition">
             <a class="link" data-toggle="modal" data-target="#verifDeleteCursus" id="orga_delete_cursus_<?php echo $idCursusNew; ?>"><span class="glyphicon glyphicon-minus-sign icone"></span></a>
             <a class="link" data-toggle="modal" data-target="#modifyCursus" id="orga_modify_cursus_<?php echo $idCursusNew; ?>"><span class="glyphicon glyphicon-edit icone"></span></a>
             <a class="link" href="visualisation_eleve.php?listIdCursus=<?php echo $idCursusNew; ?>"><span class="glyphicon glyphicon-th-list icone"></span></a>
         </span>
        <a class="link" id="orga_cursus_<?php echo $idCursusNew; ?>"><?php echo $_POST['nomCursus']; ?></a>
    </td>
    <td id="orga_cursus_annee_<?php echo $idCursusNew; ?>"><?php echo $_POST['anneeCursus']; ?></td>
</tr>