<?php
session_start();
$_SESSION['member_id'] = 1;
$_SESSION['admin_id'] = 1;
$_SESSION['user'] = 'admin';


$config = array(
    'debug' => false,
    'Db' => array(
        'servername' => 'localhost',
        'username' => 'root',
        'password' => '',
        'db_name' => 'lib_man_sys'
    ),
    'library' => array(
        'return_in_days' => 7
    )
);

function echoln($arg)
{
    echo $arg;
    echo '<br>';
}
