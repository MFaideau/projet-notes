<div class="row donnees donnees_tableaux" xmlns="http://www.w3.org/1999/html">
    <div class="donnees panel-heading">
        <a href="simulateur_onglet.php"><span class="retour_prec_histo glyphicon glyphicon-arrow-left"></span></a>
        Compétence : <?php echo GetCompetenceById($_GET['idCompetence'])->GetNom(); ?>
    </div>
    <table class="table" data-toggle="table">
        <?php
        foreach ( $coursList as $cours ) { ?>
            <tr align="center">
                <td class="simu_header"><?php echo $cours->GetNom(); ?></td>
            </tr>
            <tr>
                <td>
                    <table class="table" data-toggle="table">
                        <?php
                        $typeEvalList = GetTypeEvalListFromCours($cours->GetId());
                        foreach ($typeEvalList as $typeEval) { ?>
                            <tr>
                                <td><?php echo $typeEval->GetNom(); ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <table class="table" cellspacing="1" width="100%">
                                        <?php
                                        $epreuvesList = GetEpreuveListFromTypeEval($typeEval->GetId());
                                        foreach ($epreuvesList as $epreuve) { ?>
                                            <tr>
                                                <td><b><?php echo $epreuve->GetNom(); ?></b></td>
                                                <td class="bloc_note_simu"><input type="number"
                                                                                  name="note_<?php echo $epreuve->GetId(); ?>"
                                                                                  min="0" max="20" /></td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
            </tr>
        <?php } ?>
    </table>
</div>