<?php

function issue_book($conn, $member_id, $book_id)
{
    require_once __DIR__ . '/_sql.php';

    $sql = "SELECT available_books FROM book WHERE book_id=$book_id;";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $available_books = (int)$row['available_books'];

    if ($available_books > 0) {
        $date = date('Y-m-d');
        $sql = 'INSERT INTO issue' . VALUES($member_id, $book_id, $date);
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // Updating the available_books
            $available_books--;
            $sql = "UPDATE book SET available_books=$available_books WHERE book_id=$book_id;";
            $result = mysqli_query($conn, $sql);
            return 1;
        } else {
            // Checking if the book is already issued
            $sql = "SELECT * FROM issue WHERE member_id=$member_id AND book_id=$book_id;";
            $result = mysqli_query($conn, $sql);
            if ($result and mysqli_num_rows($result) != 0) {
                // echoln('You have already issued this book or wrong member id');
                return -1;
            } else {
                // echoln('Wrong member id');
                return -2;
            }
        }
    } else {
        // No book available
        return 0;
    }
}

// require_once 'dbconnect.php';
// issue_book($conn, 1, 1);
