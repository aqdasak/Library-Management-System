<?php require __DIR__ . '/partials/_admin_required.php';

require_once __DIR__ . '/modules/_return_book.php';
require_once __DIR__ . '/modules/_alert.php';

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['book_id']) and isset($_POST['member_id'])) {
    $result = return_book($_POST['member_id'], $_POST['book_id']);

    if (isset($_GET['redirect_to'])) {
        $redirect = urldecode($_GET['redirect_to']);
    } else {
        $redirect = 'admin_dashboard.php?';
    }


    if ($result === NULL) {
        create_alert('Book not issued', 'danger');
        header("location: {$redirect}");
        exit();
    } elseif ($result == 0) {
        create_alert('Book returned successfully', 'success');
        header("location: {$redirect}");
        exit();
    } else {
        create_alert("Book returned. Fine to be paid ₹$result", 'warning');
        header("location: {$redirect}");
        exit();
    }
} else {
    if (isset($_GET['redirect_to'])) {
        $redirect = urldecode($_GET['redirect_to']);
    } else {
        $redirect = 'admin_dashboard.php?';
    }
    header("location: $redirect");
    exit();
}
