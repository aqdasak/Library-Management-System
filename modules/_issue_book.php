<?php
require_once __DIR__ . '/_dbconnect.php';
require_once __DIR__ . '/_sql.php';

function issue_book($member_id, $book_id)
{
    global $conn;
    $sql = "SELECT available_books FROM book WHERE book_id=$book_id;";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $available_books = (int)$row['available_books'];

    if ($available_books > 0) {
        $date = date('Y-m-d');
        $sql = 'INSERT INTO `issue` (`member_id`, `book_id`, `date`)' . VALUES($member_id, $book_id, $date);
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
                // You have already issued this book or wrong member id
                return -1;
            } else {
                // Wrong member id
                return -2;
            }
        }
    } else {
        // No book available
        return 0;
    }
}
