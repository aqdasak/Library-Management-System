<?php

function remove_book($conn, $book_id)
{
    require_once __DIR__ . '/_sql.php';

    $sql = "DELETE FROM issue WHERE book_id='$book_id'";
    $result = mysqli_query($conn, $sql);

    $sql = "DELETE FROM transaction_history WHERE book_id='$book_id'";
    $result = mysqli_query($conn, $sql);

    $sql = "DELETE FROM book WHERE book_id='$book_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Book removed
        return true;
    } else {
        // Some error occured
        return false;
    }
}

// require_once 'dbconnect.php';
// remove_book($conn, 4);
