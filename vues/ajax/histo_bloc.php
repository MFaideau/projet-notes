<!-- Histogramme de données !-->

<div class="row donnees donnees_histo">
    <div class="panel panel-default">
        <div class="panel-heading">Graphe comparatoire</div>
        <table class="table">
            <thead>
            <tr>
                <th>Compétences</th>
                <th>Histogramme</th>
                <th>Max</th>
                <th>Etudiant</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">Informatique</th>
                <td width="50%">
                    <?php
                    $note_etudiant = rand(0, 20);
                    $moyenne = $tab_histo_info[0];
                    $ecart_type = $tab_histo_info[1];
                    $tab = showHisto($moyenne, $note_etudiant, $ecart_type);
                    include('modules/module_histo.php');
                    ?>
                </td>
                <td><?php echo $tab_histo_info[2]; ?></td>
                <td>15</td>
            </tr>
            <tr>
                <th scope="row">Electronique</th>
                <td width="50%">
                    <?php
                    $note_etudiant = rand(0, 20);
                    $moyenne = $tab_histo_elec[0];
                    $ecart_type = $tab_histo_elec[1];
                    $tab = showHisto($moyenne, $note_etudiant, $ecart_type);
                    include('modules/module_histo.php');
                    ?>
                </td>
                <td><?php echo $tab_histo_elec[2]; ?></td>
                <td>15.2</td>
            </tr>
            <tr>
                <th scope="row">Management</th>
                <td width="50%" class="histo_parent">
                    <?php
                    $note_etudiant = rand(0, 20);
                    $moyenne = $tab_histo_manage[0];
                    $ecart_type = $tab_histo_manage[1];
                    $tab = showHisto($moyenne, $note_etudiant, $ecart_type);
                    include('modules/module_histo.php');
                    ?>
                </td>
                <td><?php echo $tab_histo_manage[2]; ?></td>
                <td>13.3</td>
            </tr>
            <tr>
                <th scope="row">Signaux</th>
                <td width="50%">
                    <?php
                    $note_etudiant = rand(0, 20);
                    $moyenne = $tab_histo_signaux[0];
                    $ecart_type = $tab_histo_signaux[1];
                    $tab = showHisto($moyenne, $note_etudiant, $ecart_type);
                    include('modules/module_histo.php');
                    ?>
                </td>
                <td><?php echo $tab_histo_signaux[2]; ?></td>
                <td>14.8</td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <th>Total</th>
                <th width="50%">
                    <?php
                    $note_etudiant = rand(0, 20);
                    $moyenne = $tab_histo_total[0];
                    $ecart_type = $tab_histo_total[1];
                    $tab = showHisto($moyenne, $note_etudiant, $ecart_type);
                    include('modules/module_histo.php');
                    ?>
                </th>
                <th><?php echo $tab_histo_total[2]; ?></th>
                <th>13.5</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>