<?php require __DIR__ . '/partials/_admin_required.php';

require_once __DIR__ . '/modules/_verify_user.php';
require_once __DIR__ . '/modules/_alert.php';

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $result = verify_user($_POST['member_id']);
    if ($result) {
        create_alert('User verified', 'success');
    } else {
        create_alert('Some error occured', 'danger');
    }
}
header('location: admin_dashboard.php');
exit;
