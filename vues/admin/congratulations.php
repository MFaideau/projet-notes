<?php

const UPLOAD_SUCCESS = 1;

if (isset($code_upload)) {
    if ($code_upload == UPLOAD_SUCCESS) {
        ?>
        <div class="row">
            <div class="col-md-12 message_erreur">
                <div class="alert alert-success" role="success">
                    <span class="glyphicon glyphicon-thumbs-up"></span>
                    <span
                        class="texte_erreur"><?php echo $nombreNotes; ?> notes ont été importées !</span>
                </div>
            </div>
        </div><?php
    }
}