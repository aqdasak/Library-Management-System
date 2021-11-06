<?php
require_once __DIR__ . '/modules/_auth.php';

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

if (is_admin_loggedin()) {
    logout();
    header("location:admin_login.php");
    exit;
}
logout();
header("location:member_login.php");
