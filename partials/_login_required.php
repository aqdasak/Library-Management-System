<?php
require_once __DIR__ . '/../modules/_auth.php';
require_once __DIR__ . '/../modules/_alert.php';

if (!(is_member_loggedin() or is_admin_loggedin())) {
    create_alert('You are not authorized', 'danger');
    header('location: index.php');
    exit;
}
