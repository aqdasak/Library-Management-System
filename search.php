<?php
require_once __DIR__ . '/modules/_search_book.php';
require_once __DIR__ . '/modules/_category.php';
require_once __DIR__ . '/modules/_auth.php';

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
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

    <title>Search Book</title>
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
                    <?php require __DIR__ . '/partials/navbar/_login.php'; ?>
                    <?php require __DIR__ . '/partials/navbar/_dashboard.php'; ?>
                    <?php require __DIR__ . '/partials/navbar/_search_member.php'; ?>
                    <?php require __DIR__ . '/partials/navbar/_logout.php'; ?>
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

            if (!isset($_GET['query']) or (isset($_GET['query']) and $_GET['query'] == '')) {
                echo '<h4 class="mt-5"><center><strong>Search</strong></center></h4>';
                echo '<form class="d-flex mt-3" action="search.php" method="GET">
                        <input autofocus required name="query" class="form-control me-2" type="search" placeholder="Search by book or author" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>';
            } else {

                $result = search_book($_GET['query']);
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
                        </a>';
                    if (is_admin_loggedin()) {
                        echo '<a href="#" class="disabled list-group-item list-group-item-action active list-group-item-success" aria-current="true" style="width:3.5em">
                                <strong>Edit</strong>
                            </a>
                            <a href="#" class="disabled list-group-item list-group-item-action active list-group-item-success" aria-current="true" style="width:4.2em">
                                <strong>Issue</strong>
                            </a>';
                    }
                    echo '</div>';

                    if (is_admin_loggedin()) {
                        $available_column_width = '21em';
                    } else {
                        $available_column_width = '14em';
                    }


                    while ($row = mysqli_fetch_assoc($result)) {
                        // if ($row['total_books'] > 0) {
                        echo '<ul class="list-group list-group-horizontal">
                                    <li class="list-group-item list-group-item-action">
                                        ' . $row['book_name'] . '
                                    </li>
                                    <li class="list-group-item list-group-item-action">
                                        ' . $row['author'] . '
                                    </li>
                                    <li class="list-group-item list-group-item-action" style="width:18em">
                                        ' . get_category_name($row['category_id']) . '
                                    </li>
                                    <li class="list-group-item list-group-item-action" style="width:' . $available_column_width . '">
                                        ' . $row['available_books'] . '
                                    </li>';
                        if (is_admin_loggedin()) {
                            echo '<form action="edit_book.php?redirect_to=' . urlencode("search.php?query={$_GET['query']}") . '" method="POST" style="width:3.5em">
                                        <input type="hidden" id="book_id" name="book_id" value="' . $row['book_id'] . '">
                                        <input type="hidden" id="step" name="step" value="1">
                                        <button type="submit" class="list-group-item list-group-item-action">
                                            <img src="static/image/pencil-square.svg" width="25em" height="25em" alt="Edit book">
                                        </button>
                                    </form>
                                    <form action="issue_book.php?redirect_to=' . urlencode("search.php?query={$_GET['query']}") . '" method="POST" style="width:4.2em">
                                        <input type="hidden" id="book_id" name="book_id" value="' . $row['book_id'] . '">
                                        <button type="submit" class="list-group-item list-group-item-action">
                                            <img src="static/image/arrow-right-circle.svg" width="25em" height="25em" alt="Issue book">
                                        </button>
                                    </form>';
                        }
                        echo '  </ul>';
                        // }
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