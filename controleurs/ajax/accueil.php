<?php
if(isset($_POST['button'])) {
    if($_POST['button'] == "tableaux") {
        include_once __DIR__ . '../../../vues/ajax/tableaux_bloc.php';
    }
}
if(isset($_POST['button'])) {
    if($_POST['button'] == "histog") {
        include_once __DIR__ . '../../../vues/ajax/histo_bloc.php';
    }
}