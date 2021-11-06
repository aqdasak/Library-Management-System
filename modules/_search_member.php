<?php
require_once __DIR__ . '/_dbconnect.php';

function search_member($query)
{
    global $conn;
    $query = "%$query%";
    $sql = "SELECT * FROM `member` WHERE `member_id` LIKE '$query' OR `firstname` LIKE '$query' OR `lastname` LIKE '$query' OR `phone` LIKE '$query' OR `email` LIKE '$query'";

    $result = mysqli_query($conn, $sql);
    if ($result and mysqli_num_rows($result) != 0) {
        return $result;
    }
    return NULL;
}
