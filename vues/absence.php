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
                <th>Semestre en cours</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row"></th>
                <td>0H</td>
                <td>16,5H</td>
                <td>31H</td>
            </tr>
            <tr>
               <td colspan="5"> <canvas id="absgraph" width="100%" height="40%"></canvas> </td>
            </tr>
            </tbody>
            </table>
        </div>
</div>


