<?php
require_once __DIR__ . '/_sql.php';
require_once __DIR__ . '/_category.php';

function add_book($conn, $book_name,  $author, $description, $category, $no_of_books)
{
    $book_name = filter_var($book_name, FILTER_SANITIZE_STRING);
    $author = filter_var($author, FILTER_SANITIZE_STRING);
    $description = filter_var($description, FILTER_SANITIZE_STRING);
    $category = filter_var($category, FILTER_SANITIZE_STRING);

    // Get category_id
    $sql = "SELECT category_id FROM category WHERE category_name='$category'";
    $result = mysqli_query($conn, $sql);
    if ($result and mysqli_num_rows($result) != 0) {
        $category_id = mysqli_fetch_assoc($result)['category_id'];
    } else {
        $category_id = add_category($conn, $category);
    }

    // Adding book
    $sql = 'INSERT INTO `book` (`book_name`, `author`, `category_id`, `description`, `total_books`, `available_books`)' . VALUES($book_name, $author, $category_id, $description, $no_of_books, $no_of_books);
    $result = mysqli_query($conn, $sql);
    if ($result) {
        // Book added
        return 1;
    } else {
        $sql = "SELECT book_id FROM `book` WHERE `book_name`='$book_name' AND `author`='$author'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) != 0) {
            // Book already present
            return 0;
        } else {
            // Some error occured
            return -1;
        }
    }
}

// require_once 'dbconnect.php';
// add_book($conn, 'Rust', 'Aqdas', 'ternhn4h ulthhpn4', 'c', 70);
