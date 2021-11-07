<?php require __DIR__ . '/partials/_admin_required.php'; ?>

<?php
require_once __DIR__ . '/modules/_search_member.php';

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

    <title>Search Member</title>
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
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Search Member</a>
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
    <?php require __DIR__ . '/partials/_show_alert.php'; ?>

    <div class="container">
        <div class="row">

            <?php

            if (!isset($_GET['query']) or (isset($_GET['query']) and $_GET['query'] == '')) {
                echo '<h4 class="mt-5"><center><strong>Search</strong></center></h4>';
                echo '<form class="d-flex mt-3" action="search_member.php" method="GET">
                        <input name="query" autofocus class="form-control me-2" type="search" required placeholder="Search member" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>';
                exit();
            }

            $result = search_member($_GET['query']);
            if ($result) {
                echo ' <div class="col mt-3">
                    <h4><center><strong>Search result for <em>' . $_GET['query'] . '</em></strong></center></h4>
                    <div class="mt-1 list-group list-group-horizontal">
                        <a href="#" class="disabled list-group-item list-group-item-action active list-group-item-success" aria-current="true" style="width:7em">
                            <strong>ID</strong>
                        </a>
                        <a href="#" class="disabled list-group-item list-group-item-action active list-group-item-success" aria-current="true">
                            <strong>Name</strong>
                        </a>
                        <a href="#" class="disabled list-group-item list-group-item-action active list-group-item-success" aria-current="true" style="width:22em">
                            <strong>Phone</strong>
                        </a>
                        <a href="#" class="disabled list-group-item list-group-item-action active list-group-item-success" aria-current="true">
                            <strong>Email</strong>
                        </a>
                    </div>';


                while ($row = mysqli_fetch_assoc($result)) {
                    $href = "member_detail.php?mid={$row['member_id']}";
                    echo '<div class="list-group list-group-horizontal">
                        <a href="' . $href . '" class="list-group-item list-group-item-action" style="width:7em">
                            ' . $row['member_id'] . '
                        </a>
                        <a href="' . $href . '" class="list-group-item list-group-item-action">
                            ' . "{$row['firstname']} {$row['lastname']}" . '
                        </a>
                        <a href="' . $href . '" class="list-group-item list-group-item-action" style="width:22em">
                            ' . $row['phone'] . '
                        </a>
                        <a href="' . $href . '" class="list-group-item list-group-item-action">
                            ' . $row['email'] . '
                        </a>
                    </div>';
                }
            } else {
                echo '<h4 class="mt-5"><center><strong>Member not found. Search again</strong></center></h4>';
                echo '<form class="d-flex mt-3" action="search_member.php" method="GET">
                        <input name="query" autofocus class="form-control me-2"    required placeholder="Search member" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>';
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>