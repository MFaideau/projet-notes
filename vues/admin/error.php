<?php


const ERREUR_EXTENSION = 1;

if (isset($erreur_upload)) {
    if ($erreur_upload == ERREUR_EXTENSION) {
        ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-2 message_erreur">
                <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-lock"></span>
                    <span
                        class="texte_erreur">Mauvaise extension : seul le format <strong>.CSV</strong> est accepté</span>
                </div>
            </div>
        </div><?php
    }
}