<?php
    defined("ROOT_ACCESS") or die();

    // On teste si c'est un admin qui visualise un étudiant
    if (isset($user_vue) && $user->GetAutorite() != 0) {
        $idEtudiant = GetEtudiant($user_vue)->GetId();
    } else {
        $idEtudiant = GetEtudiant($user)->GetId();
    }


    include_once('vues/ajax/tableaux_bloc.php');
?>