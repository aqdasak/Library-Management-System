<?php
require 'sql.php';

function edit_book($conn, int $book_id, String $book_name, String $author, String $description, int $category_id, int $total_books, int $available_books)
{
    $sql = "UPDATE book SET `book_name`='$book_name', `author`='$author', `category_id`='$category_id', `description`='$description', `total_books`='$total_books', `available_books`='$available_books' WHERE book_id='$book_id'";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        echoln('Successful');
    } else {
        echoln('Some error occured');
    }
}

// require 'dbconnect.php';
// edit_book($conn, 2, 'Aqdas', 'Aqdas', 'ternhn4h ulthhpn4', 1, 999, 999);
