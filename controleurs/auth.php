<?php
/**
 * @Auteur : Baudouin Landais
 * @Desc : Système de connexion avec Google
 */
session_start();

require_once './gplus-lib/vendor/autoload.php';

const CLIENT_ID = "";
const CLIENT_SECRET = "";
const REDIRECT_URI = "";

$client = new Google_Client();
$client->setClientId(CLIENT_ID);
$client->setClientSecret(CLIENT_SECRET);
$client->setRedirectUri(REDIRECT_URI);
$client->setScopes('email');
$plus = new Google_Service_Plus($client);

if (isset($_REQUEST['logout'])) {
    session_unset();
}

if (isset($_GET['code'])) {
    $client->authenticate($_GET['code']);
    $_SESSION['access_token'] = $client->getAccessToken();
    $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
    header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
    $client->setAccessToken($_SESSION['access_token']);
    $me = $plus->people->get('me');
    $email = $me['emails'][0]['value'];

    if (isset($_GET['action']) && $_GET['action'] == "disconnect") {
        session_destroy();
        header('Location: index.php');
        die();
    }
    $_SESSION['email'] = $email;
    header('Location: accueil.php');
    die();
} else {
    $authUrl = $client->createAuthUrl();
    include_once('./vues/login.php');
}

?>
