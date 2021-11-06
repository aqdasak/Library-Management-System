<?php
require_once __DIR__ . '/../../modules/_auth.php';

if (is_member_loggedin() or is_admin_loggedin()) {
    echo '<li class="nav-item">
        <a class="nav-link" href="dashboard.php">Dashboard</a>
    </li>';
}
