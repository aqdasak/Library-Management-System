<?php
require_once __DIR__ . '/_category.php';
require_once __DIR__ . '/_dbconnect.php';
require_once __DIR__ . '/_sql.php';

function add_book($book_name,  $author, $description, $category, $no_of_books)
{
    global $conn;
    if ($no_of_books <= 0) {
        return -2;
    }

    $book_name = filter_var($book_name, FILTER_SANITIZE_STRING);
    $author = filter_var($author, FILTER_SANITIZE_STRING);
    $description = filter_var($description, FILTER_SANITIZE_STRING);
    $category = filter_var($category, FILTER_SANITIZE_STRING);

    if ($category == '') {
        $category = 'NULL';
    }
    if ($description == '') {
        $description = 'NULL';
    }

    // Get category_id
    $sql = "SELECT category_id FROM category WHERE category_name='$category'";
    $result = mysqli_query($conn, $sql);
    if ($result and mysqli_num_rows($result) != 0) {
        $category_id = mysqli_fetch_assoc($result)['category_id'];
    } else {
        $category_id = add_category($category);
    }

    // Adding book
    $sql = "INSERT INTO `book` (`book_name`, `author`, `category_id`, `description`, `total_books`, `available_books`)" . VALUES($book_name, $author, $category_id, $description, $no_of_books, $no_of_books);
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
