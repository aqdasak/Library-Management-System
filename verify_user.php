<?php
require_once __DIR__ . '/modules/_verify_user.php';
require_once __DIR__ . '/modules/_dbconnect.php';
require_once __DIR__ . '/modules/_alert.php';

$result = verify_user($conn, $_GET['mid']);
if ($result) {
    create_alert('User verified', 'success');
    header('location: admin_dashboard.php');
} else {
    create_alert('Some error occured', 'danger');
    header('location: admin_dashboard.php');
}
