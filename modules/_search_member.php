<?php
function search_member($conn, $query)
{
    $query = "%$query%";
    $sql = "SELECT * FROM `member` WHERE `member_id` LIKE '$query' OR `firstname` LIKE '$query' OR `lastname` LIKE '$query' OR `phone` LIKE '$query' OR `email` LIKE '$query'";

    $result = mysqli_query($conn, $sql);
    if ($result and mysqli_num_rows($result) != 0) {
        return $result;
    }
    return NULL;
}

// require_once '_dbconnect.php';
// $result = search_member($conn, '@');
// if ($result) {
//     while ($row = mysqli_fetch_assoc($result)) {
//         echoln("{$row['member_id']}\t{$row['firstname']}\t{$row['lastname']}");
//     }
// }
