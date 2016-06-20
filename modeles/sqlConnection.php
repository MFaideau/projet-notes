<?php
/*
 * @Author: Baudouin Landais
 * @Date:   21/05/2016
 * @Desc:   Connect to the SQL database
 */
include_once("sqlExport.php");
try {
    $bdd = new PDO('mysql:host=localhost;dbname=projet_notes', 'root', '');
    $bdd->exec("SET NAMES 'UTF8'");
}
catch(Exception $error) {
    die('Erreur : '.$error->getMessage());
}