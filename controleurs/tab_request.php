<?php
/**
 * @Auteur: Joël Guillem
 * @Desc: Requête pour remplir les tableaux et histogrammes de notes
 */

// $competence_tab = fonction_competence();

function showHisto($moyenne, $note_etudiant, $ecart_type) {
    $taille_rect = $note_etudiant / 20;
    $taille_rect_pourcent = $taille_rect * 100;
    if ($taille_rect == 0) {
        $taille_couleur = 0;
    } else {
        $taille_couleur = (1 / $taille_rect) * 100;
    }
    $position_moyenne = ($moyenne / 20) * 100;
    $position_e_t_high = $position_moyenne + (($ecart_type / 2) / 20) * 100;
    $position_e_t_low = $position_moyenne - (($ecart_type / 2) / 20) * 100;
    return array([$taille_couleur,$taille_rect_pourcent,$position_moyenne,$position_e_t_low, $position_e_t_high]);
}

function getTabNotes($tab_notes) {
    $effectif = count($tab_notes);
    $somme = 0;
    $somme_carres = 0;
    $note_max = 0;
    for ($i=0;$i<$effectif;$i++) {
        $somme = $somme + $tab_notes[$i];
        $somme_carres = $somme_carres + pow($tab_notes[$i],2);
        if ($note_max < $tab_notes[$i]) {
            $note_max = $tab_notes[$i];
        }
    }
    $moyenne = $somme/$effectif;
    $moyenne_carres = $somme_carres/$effectif;
    $variance = $moyenne_carres - pow($moyenne,2);
    $ecart_type = sqrt($variance);
    return array([$moyenne,$ecart_type,$note_max]);
}
    