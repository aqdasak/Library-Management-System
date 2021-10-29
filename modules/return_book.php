<?php
require 'sql.php';

function return_book($conn, int $member_id, int $book_id, $remark)
{
    $sql = "SELECT date FROM issue WHERE member_id=$member_id AND book_id=$book_id;";
    $result = mysqli_query($conn, $sql);
    // Checking whether the book is issued or not
    if (mysqli_num_rows($result) != 0) {
        $issue_date = mysqli_fetch_assoc($result)['date'];

        // Adding to transaction_history table
        $current_date = date('Y-m-d');
        $sql = 'INSERT INTO transaction_history' . VALUES($member_id, $book_id, $issue_date, $current_date, $remark);
        $result = mysqli_query($conn, $sql);

        // Deleting entry fron issue table
        $sql = "DELETE FROM issue WHERE member_id=$member_id AND book_id=$book_id;";
        $result = mysqli_query($conn, $sql);

        // Updating the available_books
        $sql = "SELECT available_books FROM book WHERE book_id=$book_id;";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $available_books = (int)$row['available_books'];

        $available_books++;
        $sql = "UPDATE book SET available_books=$available_books WHERE book_id=$book_id;";
        $result = mysqli_query($conn, $sql);

        echoln('Done');
    } else {
        echoln('Not issued');
    }
}

require 'dbconnect.php';
return_book($conn, 111, 111, 'enien');
