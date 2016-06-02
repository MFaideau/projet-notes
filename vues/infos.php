<div class="col-lg-3 identite">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row"><span><strong><?php echo $user->GetPrenom() . ' ' . $user->GetNom(); ?></strong></span>
            </div>
            <div class="row">
                <?php
                if ($user->GetAutorite() == 1) { ?>
                    <br />
                <?php } else { ?>
            </div>
            <div class="row"><span><?php echo $user->GetCursusTexte(); ?></span></div>
            <div class="row">
                <a href="index.php?action=disconnect">
                    <div class="disconnect">Se déconnecter</div>
                </a>
            </div>
        </div>
    </div>
</div>
<?php } ?>