<?php
/**
 * @Auteur: Baudouin Landais
 * @Description : Fichier de vue pour la page de connexion
 */
const ERREUR_MAUVAIS_LOGIN = 1;
const ERREUR_PAS_CONNECTE = 2;
defined("ROOT_ACCESS") or die();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Page de connexion</title>
    <link href="vues/assets/bootstrap/bootstrap.css" rel="stylesheet"/>
    <link href="vues/assets/style.css" rel="stylesheet"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
    <body>
        <div class="container">
            <div class="row">
                <?php
                if (isset($_GET['erreur_connexion'])) {
                    if ($_GET['erreur_connexion'] == ERREUR_MAUVAIS_LOGIN) {
                        ?>
                        <div class="col-md-6 col-md-offset-3 message_erreur">
                            <div class="alert alert-danger" role="alert">
                                <span class="glyphicon glyphicon-lock"></span>
                                <span class="texte_erreur">Vos informations de connexion n'ont pas été reconnues</span>
                            </div>
                        </div><?php
                    }
                    else if ($_GET['erreur_connexion'] == ERREUR_PAS_CONNECTE) {
                        ?>
                        <div class="col-md-6 col-md-offset-3 message_erreur">
                            <div class="alert alert-danger" role="alert">
                                <span class="glyphicon glyphicon-lock"></span>
                                <span class="texte_erreur">Vous n'êtes pas connecté.</span>
                            </div>
                        </div><?php
                    }
                }
                ?>
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row header_login">
                                <div class="col-xs-4 col-sm-5 header_login_cell">
                                    <img src="vues/assets/img/logo_isen.png" alt="Logo ISEN" class="logo"/>
                                </div>
                                <div class="col-xs-8 col-sm-7 header_login_cell">
                                    <div class="texte_logo">Visual Year</div>
                                </div>
                            </div>
                            <div class="row separator_login"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="<?php echo $authUrl; ?>">
                                        <div class="connect_button">Connexion au site</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>