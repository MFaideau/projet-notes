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

function ExportDB($idCursus)
{
    $bddStr = GetCursus(GetCursusList(),$idCursus)->GetContentCursus();
    $bddStr = $bddStr."\r\n".GetContentCompetence($idCursus);
    $bddStr = $bddStr."\r\n".GetContentCours($idCursus);
    $bddStr = $bddStr."\r\n".GetContentEval($idCursus);
    $bddStr = $bddStr."\r\n".GetContentTypeEval($idCursus);
    $bddStr = $bddStr."\r\n".GetContentEpreuve($idCursus);
    $bddStr = $bddStr."\r\n".GetContentEtudiantNote($idCursus);
    TelechargementString(date("d-m-Y")."_".date("H-i-s").'_VisualYear_Exportation_BDD.agg',$bddStr);
}