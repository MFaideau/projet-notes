<?php
/**
 * @Auteur : Baudouin Landais
 * @Desc : Système de connexion avec Google
 */

require_once __DIR__ . '/gplus-lib/vendor/autoload.php';

const CLIENT_ID = "";
const CLIENT_SECRET = "";
const REDIRECT_URI = "";

session_start();

$client = new Google_Client();
$client->setClientId(CLIENT_ID);
$client->setClientSecret(CLIENT_SECRET);
$client->setRedirectUri(REDIRECT_URI);
$client->setScopes('email');

$plus = new Google_Service_Plus($client);

// Actual process
if(isset($_REQUEST['logout'])) {
    session_unset();
}

if(isset($_GET['code'])) {
    $client->authenticate($_GET['code']);
    $_SESSION['access_token'] = $client->getAccessToken();
    $redirect = 'http://' . $_SERVER['HTTP_POST'] . $_SERVER['PHP_SELF'];
    header('Location:'.filter_var($redirect,FILTER_SANITIZE_URL));
}

if(isset($_SESSION['access_token']) && $_SESSION['access_token']) {
    $client->setAccessToken($_SESSION['access_token']);
    $me = $plus->people->get('me');

    $email = $me['emails'][0]['value'];
    // TODO : On a recupéré l'adresse mail, il faut maintenant l'envoyer au modèle
    echo $email;
} else {
    $authUrl = $client->createAuthUrl();
    // TODO : Mettre la vue
    ?>
    <a href="<?php echo $authUrl; ?>">CONNECTE MOI, MON DIEU !!!</a>
<?php } ?>