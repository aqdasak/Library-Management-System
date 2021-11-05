<?php
require __DIR__ . '/partials/_admin_required.php';
?>

<?php
require_once __DIR__ . '/modules/_verify_user.php';
require_once __DIR__ . '/modules/_dbconnect.php';
require_once __DIR__ . '/modules/_alert.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $result = verify_user($conn, $_POST['member_id']);
    if ($result) {
        create_alert('User verified', 'success');
    } else {
        create_alert('Some error occured', 'danger');
    }
}
header('location: admin_dashboard.php');
exit;
