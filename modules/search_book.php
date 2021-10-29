<?php
function search_book($conn, String $query)
{
    $query = "%$query%";
    $sql = "SELECT * FROM book WHERE book_name LIKE '$query' OR author LIKE '$query'";

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) != 0) {
        echo "<pre>";
        echoln("Book\tAuthor\tAvailable");
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['total_books'] > 0) {
                echoln("{$row['book_name']}\t{$row['author']}\t{$row['available_books']}");
            }
        }
        echo "</pre>";
    } else {
        echoln('Not found');
    }
}

// require 'dbconnect.php';
// search_book($conn, 'ru');
