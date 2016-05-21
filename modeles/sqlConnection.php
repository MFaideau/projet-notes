<?php
/*
 * @Author: Baudouin Landais
 * @Date:   21/05/2016
 * @Desc:   Connect to the SQL database
 */

try {
    $bdd = new PDO('mysql:host=localhost;dbname=projet-notes', 'root', '');
}
catch(Exception $error) {
    die('Erreur : '.$error->getMessage());
}