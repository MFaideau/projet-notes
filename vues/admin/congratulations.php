<?php defined("ROOT_ACCESS") or die();
const UPLOAD_SUCCESS = 1;

if (isset($code_upload)) {
    if ($code_upload == UPLOAD_SUCCESS) {
        ?>
        <div class="row">
        <div class="col-md-12 message_erreur">
            <div class="alert alert-success" role="success">
                <span class="glyphicon glyphicon-thumbs-up"></span>
                    <span class="texte_erreur">
                        <?php
                        if (isset($nombreNotes)) {
                            echo $nombreNotes . ' notes ont été importées ';
                            if (isset($nombreAbsencesNonExcusees) && isset($nombreAbsencesExcusees)) {
                                if ($nombreAbsencesNonExcusees > 0 || $nombreAbsencesExcusees > 0) {
                                    echo " : " . $nombreAbsencesNonExcusees . " absence(s) non excusée(s) et ";
                                    echo $nombreAbsencesExcusees . " absence(s) excusée(s)";
                                }
                            }
                            echo ' !';
                        }
                        if (isset($nombreEtudiants))
                            echo $nombreEtudiants . ' étudiants ont été importés !';
                        ?>
                    </span>
            </div>
        </div>
        </div><?php
        if (isset($nombreNotes)) {$listIdEpreuve=$_POST['idEpreuveUpload'];
            $listEleves = GetUsersFromEpreuve($listIdEpreuve);
            define("AJOUT_NOTES",true);
            include_once (__DIR__ . '/visualisation_lists/visualisation_list_epreuve.php');
        }
    }
}