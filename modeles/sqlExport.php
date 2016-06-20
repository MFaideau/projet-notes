<?php
/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 20/06/2016
 * Time: 11:15
 */
include_once(__DIR__ . '../cursus/cursus.php');
function TelechargementString($nom, $str)
{
    header('Content-Type: application/octet-stream');
    header('Content-Length: '. strlen($str));
    header('Content-disposition: attachment; filename='. $nom);
    header('Pragma: no-cache');
    header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Expires: 0');
    echo $str;
    exit();
}

function ExportDB()
{
    $bddStr = GetContentCursus();
    $bddStr = $bddStr."\r\n".GetContentCompetence();
    $bddStr = $bddStr."\r\n".GetContentCours();
    TelechargementString(date("d-m-Y")."_".date("H-i-s").'_VisualYear_Exportation_BDD.txt',$bddStr);
}

ExportDB();