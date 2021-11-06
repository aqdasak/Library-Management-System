<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/_dbconnect.php';
require_once __DIR__ . '/_sql.php';

function return_book($member_id, $book_id)
{
    global $conn;
    global $config;
    $sql = "SELECT date FROM issue WHERE member_id=$member_id AND book_id=$book_id;";
    $result = mysqli_query($conn, $sql);
    // Checking whether the book is issued or not
    if ($result and mysqli_num_rows($result) != 0) {
        $issue_date = mysqli_fetch_assoc($result)['date'];

        // Adding to transaction_history table
        $current_date = date('Y-m-d');
        $days_diff = ((array)date_diff(date_create($issue_date), date_create($current_date)))['days'];
        if ($days_diff <= $config['library']['return_in_days']) {
            $fine = 0;
        } else {
            $fine = ($days_diff - $config['library']['return_in_days']) * $config['library']['fine_per_day'];
        }
        $remark = "Fine: ₹$fine";

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

        // Done
        return $fine;
    } else {
        //  Not issued
        return NULL;
    }
}
