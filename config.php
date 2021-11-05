<!-- CONFIG FILE -->

<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

// $_SESSION['member_id'] = 1;
// $_SESSION['admin_id'] = 1;
// $_SESSION['user'] = 'admin';

// $_SESSION['login'] = array('admin' => true, 'id' => 1);
// unset($_SESSION['login']);

$config = array(
    'debug' => false,
    'Db' => array(
        'servername' => 'localhost',
        'username' => 'root',
        'password' => '',
        'db_name' => 'lib_man_sys'
    ),
    'library' => array(
        'return_in_days' => 7,
        'fine_per_day' => 5,
    ),
);

// function echoln($arg)
// {
//     echo $arg;
//     echo '<br>';
// }
