<?php
require __DIR__ . '/partials/_admin_required.php';

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
?>

<?php
require_once __DIR__ . '/modules/_remove_book.php';
require_once __DIR__ . '/modules/_alert.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $result = remove_book($_POST['book_id']);

    if (isset($_GET['redirect_to'])) {
        $redirect = urldecode($_GET['redirect_to']);
    } else {
        $redirect = 'admin_dashboard.php?';
    }

    if ($result) {
        create_alert('Book removed successfully', 'success');
        header("location: {$redirect}");
        exit();
    } else {
        create_alert('Something went wrong', 'danger');
        header("location: {$redirect}");
        exit();
    }
}

header('location: index.php');
