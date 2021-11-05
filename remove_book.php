<?php
require __DIR__ . '/partials/_admin_required.php';
?>

<?php
require_once __DIR__ . '/modules/_dbconnect.php';
require_once __DIR__ . '/modules/_remove_book.php';
require_once __DIR__ . '/modules/_alert.php';

if (isset($_GET['bid'])) {
    $result = remove_book($conn, $_GET['bid']);

    if (isset($_GET['redirect_to'])) {
        $redirect = urldecode($_GET['redirect_to']) . '&';
    } else {
        $redirect = 'admin_dashboard.php?';
    }

    if ($result) {
        create_alert('Book removed successfully', 'success');
        header("location: {$redirect}");
        exit();
    } else {
        create_alert('Some error occured', 'danger');
        header("location: {$redirect}");
        exit();
    }
}
