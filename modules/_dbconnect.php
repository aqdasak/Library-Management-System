<?php

function __db_connection()
{
    require_once __DIR__ . '/../config.php';

    $db = $config['Db'];

    $conn = mysqli_connect($db['servername'], $db['username'], $db['password'], $db['db_name']);
    if (!$conn) {
        die('Failed to connect: ' . mysqli_connect_error());
    } elseif ($config['debug']) {
        echo 'Successfully connected to database';
    }
    return $conn;
}

$conn = __db_connection();
