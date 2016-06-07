<!-- Histogramme de données !-->

<div class="row donnees donnees_histo">
    <div class="panel panel-default">
        <div class="panel-heading">Graphe comparatoire</div>
        <table class="table">
            <thead>
            <tr>
                <th>Compétences</th>
                <th>Histogramme</th>
                <th>Min</th>
                <th>Max</th>
                <th>Etudiant</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($competenceList as $competence)
            { ?>
                <tr>
                    <th scope="row"><?php echo $competence->GetNom(); ?></th>
                    <td width="50%">
                        <?php
                        $note_etudiant = $tab_info[0];
                        $moyenne = $tab_histo_info[0];
                        $ecart_type = $tab_histo_info[1];
                        $tab = showHisto($moyenne, $note_etudiant, $ecart_type);
                        include('modules/module_histo.php');
                        ?>
                    </td>
                    <td><?php echo $tab_histo_info[2]; ?></td>
                    <td><?php echo $tab_histo_info[3]; ?></td>
                    <td><?php echo $note_etudiant; ?></td>
                </tr>
            <?php } ?>
            </tbody>
            <tfoot>
            <tr>
                <th>Total</th>
                <th width="50%">
                    <?php
                    $note_etudiant = $tab_total[0];
                    $moyenne = $tab_histo_total[0];
                    $ecart_type = $tab_histo_total[1];
                    $tab = showHisto($moyenne, $note_etudiant, $ecart_type);
                    include('modules/module_histo.php');
                    ?>
                </th>
                <td><?php echo $tab_histo_total[2]; ?></td>
                <th><?php echo $tab_histo_total[3]; ?></th>
                <th><?php echo $note_etudiant; ?></th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>