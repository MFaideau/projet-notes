<?php
/**
 * @Auteur : Baudouin Landais
 * @Desc : Système de connexion avec Google
 */
include_once('./modeles/authentification/authentification.php');
session_start();

require_once './gplus-lib/vendor/autoload.php';
require_once 'credentials.php';

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
    try {
        $me = $plus->people->get('me');
    }
    catch(Exception $e) {
        die($e->getMessage());
    }
    $email = $me['emails'][0]['value'];
    $user = GetUser($email);
    if (!isset($user)) {
        session_destroy();
        header('Location: index.php?erreur_connexion=1');
        die();
    }
    else if (isset($_GET['action']) && $_GET['action'] == "disconnect") {
        session_destroy();
        header('Location: index.php');
        die();
    }
    $_SESSION['user'] = serialize($user);
    header('Location: accueil.php');
    die();
} else {
    $authUrl = $client->createAuthUrl();
    if (isset($_SESSION['user'])) {
        header('Location: accueil.php');
        die();
    } else {
        include_once('./vues/login.php');
    }
}
?>
