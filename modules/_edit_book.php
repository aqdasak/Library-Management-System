<?php
require_once __DIR__ . '/_sql.php';

function edit_book($conn, $book_id, $book_name, $author, $description, $category_id, $total_books, $available_books)
{
    $book_name = filter_var($book_name, FILTER_SANITIZE_STRING);
    $author = filter_var($author, FILTER_SANITIZE_STRING);
    $description = filter_var($description, FILTER_SANITIZE_STRING);
    $sql = "UPDATE book SET `book_name`='$book_name', `author`='$author', `category_id`='$category_id', `description`='$description', `total_books`='$total_books', `available_books`='$available_books' WHERE book_id='$book_id'";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        // Successful
        return true;
    } else {
        // Some error occured
        return false;
    }
}

// require_once 'dbconnect.php';
// edit_book($conn, 2, 'Aqdas', 'Aqdas', 'ternhn4h ulthhpn4', 1, 999, 999);
