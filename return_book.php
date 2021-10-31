<?php
require_once __DIR__ . '/modules/_dbconnect.php';
require_once __DIR__ . '/modules/_return_book.php';
require_once __DIR__ . '/modules/_url.php';
require_once __DIR__ . '/modules/_alert.php';
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Library Management System</title>
</head>

<body>

    <?php require_once 'partials/_navbar.html' ?>

    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['book_id']) and isset($_POST['member_id'])) {
        $result = return_book($conn, $_POST['member_id'], $_POST['book_id']);

        if (isset($_GET['redirect_to'])) {
            $redirect = decode_url($_GET['redirect_to']);
        } else {
            $redirect = 'admin_dashboard.php?';
        }



        if ($result === NULL) {
            create_alert('Book not issued', 'danger');
            header("location: {$redirect}");
            exit();
        } elseif ($result == 0) {
            create_alert('Book returned successfully', 'success');
            header("location: {$redirect}");
            exit();
        } else {
            create_alert("Book returned. Fine to be paid ₹$result", 'warning');
            header("location: {$redirect}");
            exit();
        }
    } else {
        if (isset($_GET['redirect_to'])) {
            $redirect = decode_url($_GET['redirect_to']);
        } else {
            $redirect = 'admin_dashboard.php?';
        }
        header("location: $redirect");
        exit();
    }

    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>