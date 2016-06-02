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
                    $moyenne = rand(0, 20);
                    $note_etudiant = rand(0, 20);
                    $ecart_type = rand(1, 8);
                    $tab = showHisto($moyenne, $note_etudiant, $ecart_type);
                    include('modules/module_histo.php');
                    ?>
                </td>
                <td>16.5</td>
                <td>15</td>
            </tr>
            <tr>
                <th scope="row">Electronique</th>
                <td width="50%">
                    <?php
                    $moyenne = rand(0, 20);
                    $note_etudiant = rand(0, 20);
                    $ecart_type = rand(1, 8);
                    $tab = showHisto($moyenne, $note_etudiant, $ecart_type);
                    include('modules/module_histo.php');
                    ?>
                </td>
                <td>15.2</td>
                <td>15.2</td>
            </tr>
            <tr>
                <th scope="row">Management</th>
                <td width="50%" class="histo_parent">
                    <?php
                    $moyenne = rand(0, 20);
                    $note_etudiant = rand(0, 20);
                    $ecart_type = rand(1, 8);
                    $tab = showHisto($moyenne, $note_etudiant, $ecart_type);
                    include('modules/module_histo.php');
                    ?>
                </td>
                <td>17.1</td>
                <td>13.3</td>
            </tr>
            <tr>
                <th scope="row">Signaux</th>
                <td width="50%">
                    <?php
                    $moyenne = rand(0, 20);
                    $note_etudiant = rand(0, 20);
                    $ecart_type = rand(1, 8);
                    $tab = showHisto($moyenne, $note_etudiant, $ecart_type);
                    include('modules/module_histo.php');
                    ?>
                </td>
                <td>16</td>
                <td>14.8</td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <th>Total</th>
                <th width="50%">
                    <?php
                    $moyenne = rand(0, 20);
                    $note_etudiant = rand(0, 20);
                    $ecart_type = rand(1, 8);
                    $tab = showHisto($moyenne, $note_etudiant, $ecart_type);
                    include('modules/module_histo.php');
                    ?>
                </th>
                <th>16.2</th>
                <th>13.5</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>