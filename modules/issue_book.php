<?php
require 'sql.php';

function issue_book($conn, int $member_id, int $book_id)
{
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
        } else {
            // Checking if the book is already issued
            $sql = "SELECT * FROM issue WHERE member_id=$member_id AND book_id=$book_id;";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) != 0) {
                echoln('You have already issued this book');
            }
        }
    } else {
        echoln('No book available');
    }
}

// require 'dbconnect.php';
// issue_book($conn, 1, 1);
