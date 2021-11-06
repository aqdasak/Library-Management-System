<?php
require_once __DIR__ . '/_category.php';
require_once __DIR__ . '/_dbconnect.php';

function search_book($query)
{
    global $conn;
    $category_id = get_category_id($query);

    $query = "%$query%";
    $sql = "SELECT * FROM `book` WHERE `book_name` LIKE '$query' OR `author` LIKE '$query' OR `description` LIKE '$query' OR `category_id`='$category_id'";

    $result = mysqli_query($conn, $sql);
    if ($result and mysqli_num_rows($result) != 0) {
        return $result;
    }
    return NULL;
}
