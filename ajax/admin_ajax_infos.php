<?php
session_start();

include_once __DIR__ . '../../modeles/sqlConnection.php';
include_once __DIR__ . '../../modeles/authentification/utilisateur.class.php';
include_once __DIR__ . '../../modeles/cursus/cursus.php';

if(!isset($_SESSION['user'])) {
    $utilisateur = unserialize($_SESSION['user']);
    var_dump($utilisateur);
    if($utilisateur->GetAutorite() != 1) {
        die();
    }
    die();
}

$user = serialize($_SESSION['user']);

if (isset($_POST['idCursus'])) {
    $idCursus = $_POST['idCursus'];
    $cursus = GetCursus(GetCursusList(),$idCursus);
    ?>
    <div class="panel panel-default saisie_notes panel_competences">
        <div class="panel-heading">Choix de la Compétence</div>
        <div class="panel-body">
            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                <?php
                foreach ($cursus->GetCompetenceList() as $competence) { ?>
                    <div class="btn-group" role="group">
                        <button id="cursus_1" type="button" class="btn btn-default"><?php echo html_entity_decode($competence->GetNom()); ?></button>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>