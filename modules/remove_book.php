<?php
require 'sql.php';

function remove_book($conn, String $book_id)
{
    $sql = "DELETE FROM issue WHERE book_id='$book_id'";
    $result = mysqli_query($conn, $sql);

    $sql = "DELETE FROM transaction_history WHERE book_id='$book_id'";
    $result = mysqli_query($conn, $sql);

    $sql = "DELETE FROM book WHERE book_id='$book_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echoln('Book removed');
    } else {
        echoln('Some error occured');
    }
}

// require 'dbconnect.php';
// remove_book($conn, 4);
