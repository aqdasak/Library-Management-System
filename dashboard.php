<?php
require __DIR__ . '/partials/_login_required.php';
?>

<?php
require_once __DIR__ . '/modules/_auth.php';
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

if (is_admin_loggedin()) {
    header("location:admin_dashboard.php");
    exit();
} elseif (is_member_loggedin()) {
    header("location:user_dashboard.php");
    exit();
}

header("location:index.php");
