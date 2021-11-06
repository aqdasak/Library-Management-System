<?php
function VALUES(...$args)
{
    $len = count($args);
    $st = ' VALUES (';
    for ($i = 0; $i < $len; $i++) {
        $st .= parse($args[$i]);
        if ($i + 1 != $len) {
            $st .= ', ';
        }
    }
    $st .= ')';

    return $st;
}

function parse($arg)
{
    if ($arg === NULL) {
        return 'NULL';
    } else {
        return "'{$arg}'";
    }
}
