<!-- Selection entre les Tableaux et les Histogrammes !-->
<div class="row">
    <div class="col-md-2 col-md-offset-10 visualisation">
        <div class="panel panel-default">
            <div class="panel-body">
                <a href="#tableau_notes">
                    <span class="glyphicon glyphicon-list-alt icone"></span>
                </a>
                <a href="#histogramme_notes">
                    <span class="glyphicon glyphicon-align-left icone"></span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Page de données !-->
<div class="row donnees">
    <div class="panel panel-default">
        <div class="panel-heading">Relevé de notes</div>
        <table class="table">
            <thead>
            <tr>
                <th>Compétences</th>
                <th>Moyenne</th>
                <th>ECTS</th>
                <th>Grades</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">Informatique</th>
                <td>12.2</td>
                <td>15</td>
                <td>A</td>
            </tr>
            <tr>
                <th scope="row">Electronique</th>
                <td>13.4</td>
                <td>15</td>
                <td>A</td>
            </tr>
            <tr>
                <th scope="row">Management</th>
                <td>13</td>
                <td>15</td>
                <td>A</td>
            </tr>
            <tr>
                <th scope="row">Signaux</th>
                <td>15</td>
                <td>15</td>
                <td>A</td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <th>Total</th>
                <th>XX</th>
                <th>60</th>
                <th>A</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>

<!-- Histogramme de données !-->

<div class="row donnees">
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
                    <div class="histo"></div>
                </td>
                <td>16.5</td>
                <td>15</td>
            </tr>
            <tr>
                <th scope="row">Electronique</th>
                <td width="50%">
                    <div class="histo"></div>
                </td>
                <td>15.2</td>
                <td>15.2</td>
            </tr>
            <tr>
                <th scope="row">Management</th>
                <td width="50%" class="histo_parent">
                    <div class="histo"><div>
                </td>
                <td>17.1</td>
                <td>13.3</td>
            </tr>
            <tr>
                <th scope="row">Signaux</th>
                <td width="50%">
                    <div class="histo"></div>
                </td>
                <td>16</td>
                <td>14.8</td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <th>Total</th>
                <th width="50%">
                    <div class="histo"></div>
                </th>
                <th>16.2</th>
                <th>13.5</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>

</div>
</div>
</body>
</html>
