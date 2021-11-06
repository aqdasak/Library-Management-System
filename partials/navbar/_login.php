<?php
require_once __DIR__ . '/../../modules/_auth.php';

if (!(is_member_loggedin() or is_admin_loggedin())) {
    echo '<li class="nav-item">
        <a class="nav-link" href="member_login.php">Login</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="member_signup.php">Signup</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="admin_login.php">Admin Login</a>
    </li>';
}
