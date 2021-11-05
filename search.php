<?php
require_once __DIR__ . '/modules/_dbconnect.php';
require_once __DIR__ . '/modules/_search_book.php';
require_once __DIR__ . '/modules/_category.php';
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Search</title>
</head>

<body style="height: 100vh;">

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
        <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-success"> -->
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
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
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
                    <input name="query" class="form-control me-2" type="search" minlength="1" placeholder="Search by book or author" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <?php
    require_once __DIR__ . '/partials/_show_alert.php';
    ?>

    <div class="container">
        <div class="row">

            <?php

            if (!isset($_GET['query']) or (isset($_GET['query']) and $_GET['query'] == '')) {
                echo '<h4 class="mt-5"><center><strong>Search</strong></center></h4>';
                echo '<form class="d-flex mt-3" action="search.php" method="GET">
                    <input name="query" class="form-control me-2" type="search" placeholder="Search by book or author" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>';
            } else {

                $result = search_book($conn, $_GET['query']);
                if ($result) {
                    echo ' <div class="col mt-3">
                    <h4><center><strong>Search result for <em>' . $_GET['query'] . '</em></strong></center></h4>
                    <div class="mt-1 list-group list-group-horizontal">
                        <a href="#" class="disabled list-group-item list-group-item-action active list-group-item-success" aria-current="true">
                            <strong>Books</strong>
                        </a>
                        <a href="#" class="disabled list-group-item list-group-item-action active list-group-item-success" aria-current="true">
                            <strong>Author</strong>
                        </a>
                        <a href="#" class="disabled list-group-item list-group-item-action active list-group-item-success" aria-current="true" style="width:7em">
                            <strong>Category</strong>
                        </a>
                        <a href="#" class="disabled list-group-item list-group-item-action active list-group-item-success" aria-current="true" style="width:7em">
                            <strong>Available</strong>
                        </a>
                        <a href="#" class="disabled list-group-item list-group-item-action active list-group-item-success" aria-current="true" style="width:3.5em">
                            <strong>Edit</strong>
                        </a>
                        <a href="#" class="disabled list-group-item list-group-item-action active list-group-item-success" aria-current="true" style="width:4.2em">
                            <strong>Issue</strong>
                        </a>
                    </div>';


                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['total_books'] > 0) {
                            echo '<div class="list-group list-group-horizontal">
                                    <a href="#" class="list-group-item list-group-item-action">
                                        ' . $row['book_name'] . '
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        ' . $row['author'] . '
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action" style="width:18em">
                                        ' . get_category_name($conn, $row['category_id']) . '
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action" style="width:21em">
                                        ' . $row['available_books'] . '
                                    </a>
                                    <a href="edit_book.php?bid=' . $row['book_id'] . '&redirect_to=' . urlencode("search.php?query={$_GET['query']}") . '" class="list-group-item list-group-item-action" style="width:3.5em">
                                        <img src="static/image/pencil-square.svg" width="25em" height="25em" alt="Edit book">
                                    </a>
                                    <form action="issue_book.php?redirect_to=' . urlencode("search.php?query={$_GET['query']}") . '" method="POST" style="width:4.2em">
                                        <input type="hidden" id="book_id" name="book_id" value="' . $row['book_id'] . '">
                                        <button type="submit" class="list-group-item list-group-item-action">
                                            <img src="static/image/arrow-right-circle.svg" width="25em" height="25em" alt="Issue book">
                                        </button>
                                    </form>
                                </div>';
                            // <a href="issue_book.php?bid=' . $row['book_id'] . '" class="list-group-item list-group-item-action" style="width:4.2em">
                            //         <img src="static/image/arrow-right-circle.svg" width="25em" height="25em" alt="My logo">
                            //     </a>
                        }
                    }
                } else {
                    echo '<h4 class="mt-5"><center><strong>Book not found. Search again</strong></center></h4>';
                    echo '<form class="d-flex mt-3" action="search.php" method="GET">
                        <input name="query" class="form-control me-2" type="search" placeholder="Search by book or author" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>';
                }
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>