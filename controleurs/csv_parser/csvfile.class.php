<?php

/**
 * Created by PhpStorm.
 * User: ISEN
 * Date: 30/05/2016
 * Time: 09:37
 */
class CSVFile
{
    private $header;
    private $elements;

    function CSVFile($str)
    {
       $splittedLine = explode(PHP_EOL,$str);
       $headerLine = $splittedLine[0];
       $header = explode(';',$headerLine);
        $sep=';';
        if (count($header) <= 1)
        {
            $sep=',';
            $header = explode(',',$headerLine);
        }
        $this->header=$header;
        $elements = array();
        foreach ($splittedLine as $i => $splitted)
        {
            if ($i > 0)
            {
                $elements[] = explode($sep,$splitted);
            }

        }
    }
}