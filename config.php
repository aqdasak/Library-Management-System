<?php
session_start();
$_SESSION['member_id'] = 1;


$config = array(
    'debug' => false,
    'Db' => array(
        'servername' => 'localhost',
        'username' => 'root',
        'password' => '',
        'db_name' => 'lib_man_sys'
    )
);

function echoln($arg)
{
    echo $arg;
    echo '<br>';
}
