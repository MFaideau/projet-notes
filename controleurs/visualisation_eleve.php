<?php

// Inclusions des blocs du template du site
include_once (__DIR__ . '../../modeles/sqlConnection.php');
include_once (__DIR__ . '../../vues/menu.php');
include_once (__DIR__ . '../../vues/menu_rapide.php');

// Insertion de la partie contenu de la visualisation
include_once (__DIR__ . '../../vues/visualisation_eleve.php');

// Insertion du footer pour les scripts JS (jQuery)
include_once (__DIR__ . '../../vues/footer.php');