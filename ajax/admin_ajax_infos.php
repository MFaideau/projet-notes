<?php
session_start();

// TODO : Vérifier connecté & si c'est bien un admin !
include_once __DIR__ . '../../modeles/sqlConnection.php';
require_once __DIR__ . '../../modeles/competence/competence.class.php';
require_once __DIR__ . '../../modeles/competence/competence.php';
$user = serialize($_SESSION['user']);

if (isset($_POST['idCursus'])) {
    $idCursus = $_POST['idCursus'];
    $temp = '';
    ?>
    <div class="panel panel-default saisie_notes">
        <div class="panel-heading">Choix du Cursus</div>
        <div class="panel-body">
            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                <?php
                foreach (GetCompetenceList($idCursus) as $competence) { ?>
                    <div class="btn-group" role="group">
                        <button id="cursus_1" type="button" class="btn btn-default"><?php echo html_entity_decode($competence->GetNom()); ?></button>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>