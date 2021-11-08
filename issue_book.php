<?php require __DIR__ . '/partials/_admin_required.php';

require_once __DIR__ . '/modules/_dbconnect.php';
require_once __DIR__ . '/modules/_issue_book.php';
require_once __DIR__ . '/modules/_alert.php';

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    if (isset($_GET['redirect_to'])) {
        $redirect = urldecode($_GET['redirect_to']);
    } else {
        $redirect = 'admin_dashboard.php?';
    }
    header("location: $redirect");
    exit();
}


if (isset($_POST['book_id'])) {
    // Second step
    if (isset($_POST['member_id'])) {

        if (isset($_GET['redirect_to'])) {
            $redirect = urldecode($_GET['redirect_to']);
        } else {
            $redirect = 'admin_dashboard.php?';
        }

        $sql = "SELECT `verified` FROM `member` WHERE `member_id`='{$_POST['member_id']}'";
        $result = mysqli_query($conn, $sql);
        $verified = mysqli_fetch_assoc($result)['verified'];
        if (mysqli_num_rows($result) == 0) {
            create_alert('Wrong member id entered', 'danger');
            header("location: {$redirect}");
            exit();
        } elseif ($verified == 0) {
            create_alert('Member not verified', 'danger');
            header("location: {$redirect}");
            exit();
        } else {
            $result = issue_book($_POST['member_id'], $_POST['book_id']);
            if ($result == 1) {
                create_alert('Book issued successfully', 'success');
                header("location: {$redirect}");
                exit();
            } elseif ($result == -1) {
                create_alert('The member have already issued this book', 'danger');
                header("location: {$redirect}");
                exit();
            } elseif ($result == -2) {
                create_alert('Wrong member id entered', 'danger');
                header("location: {$redirect}");
                exit();
            } else {
                create_alert('Book not available', 'danger');
                header("location: {$redirect}");
                exit();
            }
        }
    } else {
        // First step
        if (isset($_GET['redirect_to'])) {
            $redirect_to = "redirect_to={$_GET['redirect_to']}";
        } else {
            $redirect_to = '';
        }

        echo <<<END
                <!doctype html>
                <html lang="en">

                <head>
                    <!-- Required meta tags -->
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <link rel="icon" href="static/image/favicon.ico">

                    <!-- Bootstrap CSS -->
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

                    <title>Issue</title>
                </head>

                <body>

                    <!-- navbar -->
                    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="index.php">Library</a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link" href="index.php">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="search_member.php">Search Member</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="logout.php">Logout</a>
                                    </li>
                                </ul>
                                <form class="d-flex" action="search.php" method="GET">
                                    <input required name="query" class="form-control me-2" type="search" placeholder="Search by book or author" aria-label="Search">
                                    <button class="btn btn-outline-success" type="submit">Search</button>
                                </form>
                            </div>
                        </div>
                    </nav>
                <div class="container mt-5" style="width: 40em;">
                    <form action="{$_SERVER['PHP_SELF']}?{$redirect_to}" method="POST">
                        <div class="row g-3 align-items-center mt-5">
                            <div>
                                <center><label for="member_id"><strong>Enter Member ID</strong></label></center>
                            </div>
                            <div>
                                <input name="member_id" autofocus maxlength="11" type="number" required id="member_id" class="form-control" aria-describedby="member_id">
                            </div>
                        </div>
                        <input type="hidden" id="book_id" name="book_id" value="{$_POST['book_id']}">

                        <center><button type="submit" class="btn btn-primary mt-4">Submit</button></center>
                    </form>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
                </body>

                </html>
END;
    }
}
