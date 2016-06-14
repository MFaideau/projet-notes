<tr id="orga_tr_cursus_<?php echo $idCursusNew; ?>">
    <td>
        <span class="orgaEdition">
            <a data-toggle="modal" data-target="#verifDeleteCursus" id="orga_delete_cursus_<?php echo $idCursusNew; ?>"><span
                    class="glyphicon glyphicon-minus-sign icone"></span></a>
                                <a data-toggle="modal" data-target="#modifyCursus"
                                   id="orga_modify_cursus_<?php echo $idCursusNew; ?>"><span
                                        class="glyphicon glyphicon-edit icone"></span></a>
        </span>
        <a id="orga_cursus_<?php echo $idCursusNew; ?>"><?php echo $_POST['nomCursus']; ?></a>
    </td>
    <td id="orga_cursus_annee_<?php echo $idCursusNew; ?>"><?php echo $_POST['anneeCursus']; ?></td>
</tr>