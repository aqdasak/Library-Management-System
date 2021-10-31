<?php
function encode_url(String $url)
{
    return str_replace('=', '%3D', str_replace('?', '%3F', $url));
}
function decode_url(String $url)
{
    return str_replace('%3D', '=',  str_replace('%3F', '?',  $url));
}
