<?php
function create_alert($alert, $alert_type = 'info')
{
    $_SESSION['alert'] = $alert;
    $_SESSION['alert_type'] = $alert_type;
}
