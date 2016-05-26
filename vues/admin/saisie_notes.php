<?php
/*
 * @Auteur : bLandais
 * @Description : Vue pour le panneau d'insertion de notes
*/
?>

<div class="panel panel-default saisie_notes">
    <div class="panel-heading">Choix du Cursus</div>
    <div class="panel-body">
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default">CSI3</button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default">CSI-U3</button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default">CIR3</button>
            </div>
        </div>
    </div>
    
    <div class="panel-heading">Choix de la Compétence</div>
    <div class="panel-body">
        <div class="btn-group btn-group text-center" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default">Physique, Electronique et Nanotechnologies</button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default">Signaux et systèmes</button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default">Informatique</button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default">Management et développement personnel</button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default">Projet</button>
            </div>
        </div>
    </div>
    <div class="panel-heading">Choix du Cours</div>
    <div class="panel-body">
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default">Mécanique Quantique</button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default">Systèmes Electroniques</button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default">Nanosciences</button>
            </div>
        </div>
    </div>

    <div class="panel-heading">Choix du Type d'Evaluation</div>
    <div class="panel-body">
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default">DS</button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default">Interro</button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default">Partiel</button>
            </div>
        </div>
    </div>

    <div class="panel-heading">Choix de l'Epreuve</div>
    <div class="panel-body">
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default">Interro....</button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default">Interro 2....</button>
            </div>
        </div>
    </div>

    <div class="panel-heading">Importation de la liste de notes</div>
    <div class="panel-body">
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <div class="col-sm-6 col-sm-offset-3">
                    <form method="post" action="saisie_notes.php" enctype="multipart/form-data">
                        <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                        <input type="file" name="fichier_notes" id="fichier_notes" /><br />
                        <input class="col-sm-6 col-sm-offset-3" type="submit" name="submit" value="Envoyer" />
                    </form>
                    <input type="file" name="nom" />
                </div>
            </div>
        </div>
    </div>

</div>
