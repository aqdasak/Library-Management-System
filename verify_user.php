<?php
require __DIR__ . '/modules/_verify_user.php';
require __DIR__ . '/modules/_dbconnect.php';
$result = verify_user($conn, $_GET['mid']);
if ($result) {
    header('location: admin_dashboard.php?alert=User verified&alert_type=success');
} else {
    header('location: admin_dashboard.php?alert=Some error occured&alert_type=danger');
}
