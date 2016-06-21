<?php defined("ROOT_ACCESS") or die(); ?>
</div>
<?php if($user->GetAutorite() > 0)
{ ?>
    <script src="vues/assets/admin_script.js"></script>
    <script src="vues/assets/visualisation_eleve.js"></script>
<?php
if($user->GetAutorite() == 1) { ?>

    <script src="vues/assets/admin_script_orga.js"></script>
    <script src="vues/assets/gestion_comptes.js"></script>

<?php } }?>
<script src="vues/assets/accueil.js"></script>
<script src="vues/assets/simulation.js"></script>
<script src="vues/assets/js/export_pdf.js"></script>
<script src="vues/assets/releve.js"></script>
<script src="vues/assets/histo_solo.js"></script>
<script src="vues/assets/histo_commun.js"></script>
<script src="vues/assets/js/datepicker.js"></script>
<script src="vues/assets/js/absence.js"></script>
</div>
</body>
</html>
