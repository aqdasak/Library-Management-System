<?php
require_once __DIR__ . '/_dbconnect.php';

function verify_user($member_id)
{
    global $conn;
    $sql = "UPDATE member SET `verified`='1' WHERE member_id='$member_id'";
    $result = mysqli_query($conn, $sql);
    if ($result and mysqli_affected_rows($conn) > 0) {
        return true;
    }
    return false;
}
