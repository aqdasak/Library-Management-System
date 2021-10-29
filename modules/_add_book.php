<?php
require 'sql.php';

function add_book($conn, String $book_name, String $author, String $description, String $category, int $no_of_books)
{
    // Get category_id
    $sql = "SELECT category_id FROM category WHERE category_name='$category'";
    $result = mysqli_query($conn, $sql);
    if ($result and mysqli_num_rows($result) != 0) {
        $category_id = mysqli_fetch_assoc($result)['category_id'];
    } else {
        $category_id = NULL;
    }

    // Adding book
    $sql = 'INSERT INTO `book` (`book_name`, `author`, `category_id`, `description`, `total_books`, `available_books`)' . VALUES($book_name, $author, $category_id, $description, $no_of_books, $no_of_books);
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echoln('Book added');
    } else {
        $sql = "SELECT book_id FROM `book` WHERE `book_name`='$book_name' AND `author`='$author'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) != 0) {
            echoln('Book already present');
        } else {
            echoln('Some error occured');
        }
    }
}

// require 'dbconnect.php';
// add_book($conn, 'Rust', 'Aqdas', 'ternhn4h ulthhpn4', 'c', 70);
