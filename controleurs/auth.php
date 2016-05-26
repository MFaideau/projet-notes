<?php
/**
 * @Auteur : Baudouin Landais
 * @Desc : Système de connexion avec Google
 */

require_once '../gplus-lib/vendor/autoload.php';

const CLIENT_ID = "";
const CLIENT_SECRET = "";
const REDIRECT_URI = "";

session_start();
/*
 * INITIALIZATION
 *
 * Create a google client object
 * set the id,secret and redirect uri
 * set the scope variables if required
 * create google plus object
 */
$client = new Google_Client();
$client->setClientId(CLIENT_ID);
$client->setClientSecret(CLIENT_SECRET);
$client->setRedirectUri(REDIRECT_URI);
$client->setScopes('email');
$plus = new Google_Service_Plus($client);
/*
 * PROCESS
 *
 * A. Pre-check for logout
 * B. Authentication and Access token
 * C. Retrive Data
 */
/*
 * A. PRE-CHECK FOR LOGOUT
 *
 * Unset the session variable in order to logout if already logged in
 */
if (isset($_REQUEST['logout'])) {
    session_unset();
}
/*
 * B. AUTHORIZATION AND ACCESS TOKEN
 *
 * If the request is a return url from the google server then
 *  1. authenticate code
 *  2. get the access token and store in session
 *  3. redirect to same url to eleminate the url varaibles sent by google
 */
if (isset($_GET['code'])) {
    $client->authenticate($_GET['code']);
    $_SESSION['access_token'] = $client->getAccessToken();
    $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
    header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}
/*
 * C. RETRIVE DATA
 *
 * If access token if available in session
 * load it to the client object and access the required profile data
 */
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
    $client->setAccessToken($_SESSION['access_token']);
    $me = $plus->people->get('me');
    // Get User data
    $id = $me['id'];
    $name =  $me['displayName'];
    $email =  $me['emails'][0]['value'];
    $profile_image_url = $me['image']['url'];
    $cover_image_url = $me['cover']['coverPhoto']['url'];
    $profile_url = $me['url'];
} else {
    // get the login url
    $authUrl = $client->createAuthUrl();
}
?>

<div>
    <?php
    /*
     * If login url is there then display login button
     * else print the retieved data
    */
    if (isset($authUrl)) {
        include_once ('./vues/login.php');
    } else {
        if(isset($_GET['action']) && $_GET['action'] == "disconnect") {
            session_destroy();
            header('Location: index.php');
            die();
        }
        $_SESSION['email'] = $email;
        header('Location: accueil.php');
        die();
    }
    ?>
</div>