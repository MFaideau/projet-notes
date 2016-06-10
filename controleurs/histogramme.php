<?php

$tabTest = array(
    0 => 12, 1 => 14, 2 => 8, 3 => 6, 4 => 6, 5 => 6, 6 => 6, 7 => 6
);
$varTab = GetVarTabHistoBatons($tabTest);

echo json_encode($varTab);