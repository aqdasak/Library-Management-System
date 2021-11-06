<?php
require_once __DIR__ . '/../../modules/_auth.php';

if (is_admin_loggedin()) {
    echo '<li class="nav-item">
        <a class="nav-link" href="search_member.php">Search Member</a>
    </li>';
}
