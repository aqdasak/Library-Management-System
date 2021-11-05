<?php
require __DIR__ . '/partials/_admin_required.php';
?>

<?php
require_once __DIR__ . '/modules/_dbconnect.php';
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Dashboard</title>
</head>

<body style="height: 100vh;">

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Library</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex" action="search.php" method="GET">
                    <input name="query" class="form-control me-2" type="search" placeholder="Search by book or author" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <?php require_once __DIR__ . '/partials/_show_alert.php'; ?>

    <?php
    if (!isset($_GET['mid'])) {
        if (isset($_GET['redirect_to'])) {
            $redirect = urldecode($_GET['redirect_to']);
        } else {
            $redirect = 'admin_dashboard.php?';
        }
        header("location: {$redirect}");
        exit();
    }
    ?>
    <div class="container">
        <div class="row">

            <?php

            // Personal details
            $sql = "SELECT `firstname`, `lastname`,`phone`,`email` FROM `member` WHERE `member_id`='{$_GET['mid']}'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            if (!$row) {
                if (isset($_GET['redirect_to'])) {
                    $redirect = urldecode($_GET['redirect_to']);
                } else {
                    $redirect = 'admin_dashboard.php?';
                }
                header("location: {$redirect}");
                exit();
            }
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
            echo '</div>';

            // Issued Books
            $sql = "SELECT `book_id`, `date` FROM `issue` WHERE `member_id`='{$_GET['mid']}'";
            $result = mysqli_query($conn, $sql);
            if ($result and mysqli_num_rows($result) != 0) {
                echo ' <div class="col mt-3">
                        <h4><center><strong>📚 Issued Books</strong></center></h4>
                            <div class="mt-1 list-group list-group-horizontal">
                                <a href="#" class="list-group-item list-group-item-action active" aria-current="true" style="width:3em;">
                                <strong>#</strong>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                                    <strong>Books</strong>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                                    <strong>Author</strong>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action active" aria-current="true" style="width:5.5em;">
                                    <strong>Return</strong>
                                </a>
                            </div>';

                $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    $sql2 = "SELECT `book_name`,`author` FROM `book` WHERE `book_id`='{$row['book_id']}'";
                    $result2 = mysqli_query($conn, $sql2);
                    if ($result2) {
                        $row2 = mysqli_fetch_assoc($result2);
                        echo '<div class="list-group list-group-horizontal">
                                <a href="#" class="list-group-item list-group-item-action" style="width:3em;">
                                    ' . $i . '
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    ' . $row2['book_name'] . '
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    ' . $row2['author'] . '
                                </a>
                                <form action="return_book.php?redirect_to=' . urlencode("member_detail.php?mid={$_GET['mid']}") . '" method="POST" style="width:4.2em">
                                    <input type="hidden" id="book_id" name="book_id" value="' . $row['book_id'] . '">
                                    <input type="hidden" id="member_id" name="member_id" value="' . $_GET['mid'] . '">
                                    <button type="submit" class="list-group-item list-group-item-action">
                                        <img src="static/image/bookshelf.svg" width="25em" height="25em" alt="Return book">
                                    </button>
                                </form>
                            </div>';
                        // <a href="return_book." class="list-group-item list-group-item-action" style="width:5.5em;">
                        //         ' . date('d-m-Y', strtotime("{$row['date']} +{$config['library']['return_in_days']} days"))  . '
                        //     </a>
                    }
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
                                You have not issued any book
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