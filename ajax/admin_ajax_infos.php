<?php

session_start();

include_once __DIR__ . '../../modeles/sqlConnection.php';
include_once __DIR__ . '../../modeles/authentification/utilisateur.class.php';
include_once __DIR__ . '../../modeles/cursus/cursus.php';
include_once __DIR__ . '../../modeles/type_evaluation/typeeval.php';

if (!isset($_SESSION['user'])) {
    die();
}
include_once __DIR__ . './../controleurs/ajax/admin_ajax_infos.php';