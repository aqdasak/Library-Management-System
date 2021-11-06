<?php require __DIR__ . '/partials/_admin_required.php'; ?>

<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
require_once __DIR__ . '/modules/_dbconnect.php';
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="static/image/favicon.ico">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Dashboard</title>
</head>

<body style="height: 100vh;">

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
                        <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
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
    <?php
    require __DIR__ . '/partials/_show_alert.php';
    ?>

    <div class="container">
        <div class="row">

            <?php

            // Personal details
            // $sql = "SELECT `firstname`, `lastname`,`phone`,`email` FROM `admin` WHERE `admin_id`='{$_SESSION['admin_id']}'";
            $sql = "SELECT `firstname`, `lastname`,`phone`,`email` FROM `admin` WHERE `admin_id`='{$_SESSION['login']['id']}'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            echo ' <div class="col mt-3">
                        <h4><center><strong>👤 Personal details</strong></center></h4>
                        <ul class="mt-1 list-group list-group-horizontal">
                            <li class="list-group-item active" style="width:13.5em;" aria-current="true">
                                <strong>Detail</strong>
                            </li>
                            <li class="list-group-item active" style="width:13.5em;" aria-current="true">
                                <strong>Value</strong>
                            </li>
                        </ul>';

            if ($row['firstname']) {
                echo '<ul class="list-group list-group-horizontal">
                        <li class="list-group-item" style="width:13.5em;">
                            <strong>Firstname</strong>
                        </li>
                        <li class="list-group-item" style="width:13.5em;">
                            ' . $row['firstname'] . '
                        </li>
                    </ul>';
            }
            if ($row['lastname']) {
                echo '<ul class="list-group list-group-horizontal">
                <li class="list-group-item" style="width:13.5em;">
                    <strong>Lastname</strong>
                </li>
                <li class="list-group-item" style="width:13.5em;">
                    ' . $row['lastname'] . '
                </li>
            </ul>';
            }
            if ($row['phone']) {
                echo '<ul class="list-group list-group-horizontal">
                <li class="list-group-item" style="width:13.5em;">
                    <strong>Phone</strong>
                </li>
                <li class="list-group-item" style="width:13.5em;">
                    ' . $row['phone'] . '
                </li>
            </ul>';
            }
            if ($row['email']) {
                echo '<ul class="list-group list-group-horizontal">
                <li class="list-group-item" style="width:13.5em;">
                    <strong>Email</strong>
                </li>
                <li class="list-group-item" style="width:13.5em;">
                    ' . $row['email'] . '
                </li>
            </ul>';
            }


            // Add new admin and Add new book
            echo '
            <div class="container mt-5">
                <span style="margin-right: 1.5em;">
                    <a href="admin_signup.php" class="btn btn-info">Add New Admin</a>
                </span>

                <span>
                    <a href="add_book.php?redirect_to=admin_dashboard.php" class="btn btn-warning">Add New Book</a>
                </span>
            </div>';


            echo '</div>';

            // New users
            $sql = "SELECT `member_id`, `firstname`, `lastname`, `email` FROM `member` WHERE `verified`='0'";
            $result = mysqli_query($conn, $sql);
            if ($result and mysqli_num_rows($result) != 0) {
                echo ' <div class="col mt-3">
                        <h4><center><strong> 👥 New user</strong></center></h4>
                            <ul class="mt-1 list-group list-group-horizontal">
                                <li class="list-group-item list-group-item-action active" aria-current="true">
                                    <strong>&nbsp;Name</strong>
                                </li>
                                <li class="list-group-item list-group-item-action active" aria-current="true">
                                    <strong>Email</strong>
                                </li>
                                <li class="list-group-item list-group-item-action active" aria-current="true" style="width: 5em;">
                                    <strong>Verify</strong>
                                </li>
                            </ul>';

                $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    $href = "member_detail.php?mid={$row['member_id']}";
                    echo '<div class="list-group list-group-horizontal">
                                <a href="' . $href . '" class="list-group-item list-group-item-action">
                                    ' . "$i. {$row['firstname']} {$row['lastname']}" . '
                                </a>
                                <a href="' . $href . '" class="list-group-item list-group-item-action">
                                    ' . $row['email'] . '
                                </a>
                                <form action="verify_user.php" method="POST">
                                    <input type="hidden" id="book_id" name="member_id" value="' . $row['member_id'] . '" style="width: 5em;">
                                    <button type="submit" class="list-group-item list-group-item-action">
                                        <img src="static/image/person-check.svg" width="25em" height="25em" alt="Verify user">
                                    </button>
                                </form>
                        </div>';
                    $i++;
                }
                echo '</div>';
            } else {
                echo '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                        </symbol>
                    </svg>
                    <div class="col mt-5">
                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#info-fill"/></svg>
                            <div>
                                No new user
                            </div>
                        </div>
                    </div';
            }

            ?>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>