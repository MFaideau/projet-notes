<?php defined("ROOT_ACCESS") or die();
global $tab; $tab = $tab[0]; ?>
<svg width="100%" height="16px">
    <defs>
        <linearGradient id="histo" x1="0%" y1="0%" x2="<?php echo $tab[0]; ?>%" y2="0%">
            <stop offset="0%" style="stop-color:red;"/>
            <stop offset="50%" style="stop-color:yellow;"/>
            <stop offset="100%" style="stop-color:green;"/>
        </linearGradient>
    </defs>
    <rect x="1" y="1" width="<?php if($tab[1] >= 0) { echo $tab[1];} else { echo "0"; } ?>%" height="15" fill="url(#histo)" />
    <rect x="1" y="1" width="99%" height="14.2" stroke-width="0.8" stroke="black" fill="transparent"/>
    <g stroke="black">
        <line x1="<?php echo $tab[3]; ?>%" y1="7.5" x2="<?php echo $tab[4]; ?>%" y2="7.5"
              stroke-width="1" stroke="black"></line>
        <line x1="<?php echo $tab[3]; ?>%" y1="4.5" x2="<?php echo $tab[3]; ?>%" y2="10.5"
              stroke-width="1" stroke="black"></line>
        <line x1="<?php echo $tab[4]; ?>%" y1="4.5" x2="<?php echo $tab[4]; ?>%" y2="10.5"
              stroke-width="1" stroke="black"></line>
        <circle cx="<?php echo $tab[2]; ?>%" cy="7.5" r="2" stroke="black" stroke-width="3"
                fill="black"></circle>
    </g>
</svg>
