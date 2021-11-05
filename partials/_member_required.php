<?php
require_once __DIR__ . '/../modules/_auth.php';

if (!is_member_loggedin()) {
    header('location: index.php');
    exit;
}
