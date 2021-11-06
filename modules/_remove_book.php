<?php
require_once __DIR__ . '/_dbconnect.php';

function remove_book($book_id)
{

    global $conn;
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
