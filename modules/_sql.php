<?php
function VALUES(...$args)
{
    $len = count($args);
    $st = ' VALUES (';
    for ($i = 0; $i < $len; $i++) {
        $w = $args[$i];

        if ($w === NULL) {
            $st .= 'NULL';
        } else {
            $st .= "'{$w}'";
        }

        if ($i + 1 != $len) {
            $st .= ', ';
        }
    }
    $st .= ')';

    return $st;
}
