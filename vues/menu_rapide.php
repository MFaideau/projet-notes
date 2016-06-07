<!-- Selection entre les Tableaux et les Histogrammes !-->

<div class="row">
    <?php
        if ($user->GetAutorite() == 1) { ?>
    <div class="col-md-8">
        <div class="alert alert-warning" role="alert">Vue en cours : <strong><?php echo $user_vue->GetNom() . ' ' . $user_vue->GetPrenom(); ?></strong>.</div>
    </div>        
    <?php 
        }
    ?>
    <div class="col-md-2.5 visualisation">
        <div class="panel panel-default">
            <div class="panel-body ">
                <?php
                if ($user->GetAutorite() == 1) {
                    ?>
                    <a href="visualisation_eleve.php">
                        <span class="glyphicon glyphicon-circle-arrow-left icone" title="Revenir à la page d'administration"></span>
                    </a>
                <?php } ?>
                <a href="#tableau_notes" class="tableaux_logo">
                    <span class="glyphicon glyphicon-list-alt icone" title="Relevé de notes"></span>
                </a>
                <a href="#histogramme_notes" class="histo_logo">
                    <span class="glyphicon glyphicon-align-left icone" title="Histogramme Personnel"></span>
                </a>
                <a href="#histogramme_commun" class="histo_commun">
                    <span class="glyphicon glyphicon-stats icone" title="Histogramme Promo"></span>
                </a>
                <a href="#absences" class="abs">
                    <span class="glyphicon glyphicon-exclamation-sign icone" title="Mes absences"></span>
                </a>
            </div>
        </div>
    </div>
</div>