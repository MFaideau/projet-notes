<div class="panel_upload_epreuve">
    <div class="panel panel-default saisie_notes">
        <div class="panel-heading">Importation de la liste de notes</div>
        <div class="panel-body">
            <div class="col-sm-6 col-sm-offset-3">
                <form method="post" action="saisie_notes.php" enctype="multipart/form-data">
                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576"/>
                    <input type="file" name="fichier_notes" id="fichier_notes"/><br/>
                    <input class="col-sm-6 col-sm-offset-3" type="submit" name="submit" value="Envoyer"/>
                </form>
            </div>
        </div>
    </div>
</div>