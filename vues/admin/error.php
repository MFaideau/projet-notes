<?php


const ERREUR_EXTENSION = 1;
const ERREUR_DELIMITER = 2; //Ni la virgule, ni le point virgule n'ont permis de lire le fichier CSV.

if (isset($erreur_upload)) {
    if ($erreur_upload == ERREUR_EXTENSION) {
        ?>
        <div class="row">
            <div class="col-md-12 message_erreur">
                <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-lock"></span>
                    <span
                        class="texte_erreur">Mauvaise extension : seul le format <strong>.CSV</strong> est accepté</span>
                </div>
            </div>
        </div><?php
    }
    elseif ($erreur_upload == ERREUR_DELIMITER) {
        ?>
        <div class="row">
            <div class="col-md-12  message_erreur">
                <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-lock"></span>
                    <span
                        class="texte_erreur">Erreur de lecture du fichier CSV.</span>
                </div>
            </div>
        </div><?php
    }
}