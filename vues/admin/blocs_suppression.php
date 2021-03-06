<?php defined("ROOT_ACCESS") or die(); ?>

<!-- Fenêtre de confirmation pour la suppression des cursus !-->
<div class="modal fade" id="verifDeleteCursus" tabindex="-1" role="dialog" aria-labelledby="verifDeleteCursus">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="verifDeleteCursus">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Validation de la suppression</h4>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer le cursus ?
                    <br><br><a id="lienSauvegardeCursus">Fichier de sauvegarde</a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
                    <button type="submit" class="btn btn-primary">Oui</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Fenêtre de confirmation pour la suppression des compétences !-->
<div class="modal fade" id="verifDeleteCompetences" tabindex="-1" role="dialog" aria-labelledby="verifDeleteCompetences">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="verifDeleteCompetences">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Validation de la suppression</h4>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer la compétence ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
                    <button type="submit" class="btn btn-primary">Oui</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Fenêtre de confirmation pour la suppression des cours !-->
<div class="modal fade" id="verifDeleteCours" tabindex="-1" role="dialog" aria-labelledby="verifDeleteCours">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="verifDeleteCours">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Validation de la suppression</h4>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer le cours selectionné ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
                    <button type="submit" class="btn btn-primary">Oui</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Fenêtre de confirmation pour la suppression des éval !-->
<div class="modal fade" id="verifDeleteEval" tabindex="-1" role="dialog" aria-labelledby="verifDeleteEval">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="verifDeleteEval">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Validation de la suppression</h4>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer l'évaluation selectionnée ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
                    <button type="submit" class="btn btn-primary">Oui</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Fenêtre de confirmation pour la suppression des type éval !-->
<div class="modal fade" id="verifDeleteTypeEval" tabindex="-1" role="dialog" aria-labelledby="verifDeleteTypeEval">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="verifDeleteTypeEval">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Validation de la suppression</h4>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer le type d'évaluation selectionné ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
                    <button type="submit" class="btn btn-primary">Oui</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Fenêtre de confirmation pour la suppression des type éval !-->
<div class="modal fade" id="verifDeleteTypeEval" tabindex="-1" role="dialog" aria-labelledby="verifDeleteTypeEval">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="verifDeleteTypeEval">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Validation de la suppression</h4>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer le type d'évaluation selectionné ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
                    <button type="submit" class="btn btn-primary">Oui</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Fenêtre de confirmation pour la suppression des épreuves !-->
<div class="modal fade" id="verifDeleteEpreuve" tabindex="-1" role="dialog" aria-labelledby="verifDeleteEpreuve">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="verifDeleteEpreuve">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Validation de la suppression</h4>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer l'épreuve sélectionnée ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
                    <button type="submit" class="btn btn-primary">Oui</button>
                </div>
            </form>
        </div>
    </div>
</div>