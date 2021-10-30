<?php
session_start();

if (isset($_SESSION['user'])) {
    if ($_SESSION['user'] == 'admin') {
        header("location:admin_dashboard.php");
        exit();
    } elseif ($_SESSION['user'] == 'member') {
        header("location:user_dashboard.php");
        exit();
    }
}
header("location:index.php");
