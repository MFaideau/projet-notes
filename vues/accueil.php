<?php
defined("ROOT_ACCESS") or die();

// On teste si c'est un admin qui visualise un étudiant
if (isset($user_vue) && $user->GetAutorite() != 0) {
    $etudiant = GetEtudiant($user_vue);
}
else {
    $etudiant = GetEtudiant($user);
}

if (isset($etudiant)) {
    $idEtudiant = $etudiant->GetId();
}

include_once('vues/ajax/tableaux_bloc.php');