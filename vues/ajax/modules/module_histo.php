<?php

function showHisto($moyenne, $note_etudiant, $ecart_type) {

    $taille_rect = $note_etudiant*5;
    if ($taille_rect == 0) {
        $taille_couleur = 0;
    }
    else {
        $taille_couleur = 10000/$taille_rect;
    }
    $position_moyenne = $moyenne*5;
    $position_e_t_high = $position_moyenne+($ecart_type/2)*5;
    $position_e_t_low = $position_moyenne-($ecart_type/2)*5;
    ?>

    <svg width="100%" height="16px">
        <defs>
            <linearGradient id="histo" x1="0%" y1="0%" x2="<?php echo $taille_couleur;?>%" y2="0%">
                <stop offset="0%" style="stop-color:red;" />
                <stop offset="50%" style="stop-color:yellow;" />
                <stop offset="100%" style="stop-color:green;" />
            </linearGradient>
        </defs>

        <rect x="1" y="1" width="<?php echo $taille_rect;?>%" height="15" fill="url(#histo)" stroke="gray" stroke-width="1" />
        <g stroke="black">
            <line x1="<?php echo $position_e_t_low;?>%" y1="7.5" x2="<?php echo $position_e_t_high;?>%" y2="7.5" stroke-width="1" stroke="black"></line>
            <line x1="<?php echo $position_e_t_low;?>%" y1="4.5" x2="<?php echo $position_e_t_low;?>%" y2="10.5" stroke-width="1" stroke="black"></line>
            <line x1="<?php echo $position_e_t_high;?>%" y1="4.5" x2="<?php echo $position_e_t_high;?>%" y2="10.5" stroke-width="1" stroke="black"></line>
            <circle cx="<?php echo $position_moyenne;?>%" cy="7.5" r="2" stroke="black" stroke-width="3" fill="black"></circle>
        </g>
    </svg>

    <?php
}