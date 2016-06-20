<!-- Absences de l'élève !-->
<?php defined("ROOT_ACCESS") or die(); ?>

<div class="row donnees absences">
        <div class="panel panel-default">
            <div class="panel-heading">Absences</div>
            <table class="table">
            <thead>
            <tr>
                <th>Absences</th>
                <th>Semaine</th>
                <th>Mois</th>
                <th>Semestre en cours</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row"></th>
                <td>13H</td>
                <td>16H</td>
                <td>19H</td>
                <td>25H</td>
            </tr>
            <tr>
               <td colspan="5"> <canvas id="absgraph" width="100%" height="40%"></canvas> </td>
            </tr>
            </tbody>
            </table>
        </div>
</div>


