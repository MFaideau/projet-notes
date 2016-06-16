<div class="col-lg-9 menu_rapide">
    <div class="panel panel-default">
        <div class="panel-body">
            <a href="accueil.php">
                <div class="col-md-1">
                    <span class="glyphicon glyphicon-home" title="Accueil"></span>
                </div>
            </a>
            <?php
            if ($user->GetAutorite() == 1) {
                ?>
                <a href="organisation_etudes.php">
                    <div class="col-md-3 bouton_competences">Organisation des études</div>
                </a>
                <a href="saisie_notes.php">
                    <div class="col-md-2 bouton_notes">Saisie notes</div>
                </a>
                <a href="visualisation_eleve.php">
                    <div class="col-md-3 bouton_Eleve">Visualisation élève</div>
                </a>
                <a href="gestion_comptes.php">
                    <div class="col-md-3 bouton_Eleve">Gestion des comptes</div>
                </a>
            <?php } else
                if ($user->GetAutorite() == 2) {
                    ?>
                    <a href="saisie_notes.php">
                        <div class="col-md-5 bouton_notes">Saisie des notes</div>
                    </a>
                    <a href="visualisation_eleve.php">
                        <div class="col-md-5 bouton_Eleve">Visualisation élève</div>
                    </a>
            <?php } else {
                    ?>
                <a href="releve_onglet.php">
                    <div class="col-md-5 bouton_releve">Relevé de notes</div>
                </a>
                <a href="simulateur_onglet.php">
                    <div class="col-md-5 bouton_simulateur">Simulateur de notes</div>
                </a>
            <?php } ?>

        </div>
    </div>
</div>