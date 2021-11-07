<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

function create_alert($alert, $alert_type = 'info')
{
    $_SESSION['alert'] = $alert;
    $_SESSION['alert_type'] = $alert_type;
}
