<?php
require_once __DIR__ . '/_category.php';

function search_book($conn, $query)
{
    $category_id = get_category_id($conn, $query);

    $query = "%$query%";
    $sql = "SELECT * FROM `book` WHERE `book_name` LIKE '$query' OR `author` LIKE '$query' OR `description` LIKE '$query' OR `category_id`='$category_id'";

    $result = mysqli_query($conn, $sql);
    if ($result and mysqli_num_rows($result) != 0) {
        return $result;
    }
    return NULL;
}

// require_once '_dbconnect.php';
// $result = search_book($conn, 'ru');
// if ($result) {
//     while ($row = mysqli_fetch_assoc($result)) {
//         if ($row['total_books'] > 0) {
//             echoln("{$row['book_name']}\t{$row['author']}\t{$row['available_books']}");
//         }
//     }
// }
