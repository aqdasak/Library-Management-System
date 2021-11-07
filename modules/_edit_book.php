<?php
require_once __DIR__ . '/_dbconnect.php';
require_once __DIR__ . '/_sql.php';

function edit_book($book_id, $book_name, $author, $description, $category, $total_books)
{
    global $conn;
    if ($total_books <= 0) {
        return -2;
    }

    $book_name = filter_var($book_name, FILTER_SANITIZE_STRING);
    $author = filter_var($author, FILTER_SANITIZE_STRING);
    $description = filter_var($description, FILTER_SANITIZE_STRING);
    $category = filter_var($category, FILTER_SANITIZE_STRING);

    $book_name = trim($book_name);
    $author = trim($author);
    $description = trim($description);
    $category = trim($category);


    if ($category == '') {
        $category_id = NULL;
    } else {
        $category_id = get_category_id($category);
        if ($category_id === NULL) {
            $category_id = add_category($category);
        }
    }

    // Checking available books
    $sql = "SELECT COUNT(member_id) FROM issue WHERE book_id='$book_id'";
    $result = mysqli_query($conn, $sql);
    if ($result and mysqli_num_rows($result) != 0) {
        $available_books = $total_books - (int)mysqli_fetch_assoc($result)['COUNT(member_id)'];
    } else {
        $available_books = $total_books;
    }

    $sql = "UPDATE book SET `book_name`='$book_name', `author`='$author', `category_id`=" . parse($category_id) . ", `description`=" . parse($description) . ", `total_books`='$total_books', `available_books`='$available_books' WHERE book_id='$book_id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        // Successful
        return 1;
    } else {
        // Some error occured
        return -1;
    }
}
