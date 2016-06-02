<!-- Selection entre les Tableaux et les Histogrammes !-->
<?php 
if ($user->GetAutorite() != 1) {
?>


<div class="row">
    <div class="col-md-2.5 col-md-offset-9.5 visualisation">
        <div class="panel panel-default">
            <div class="panel-body ">
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

<?php } ?> 