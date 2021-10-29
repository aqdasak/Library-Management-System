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

    <div class="container">
        <div class="row">

            <?php
            require __DIR__ . '/modules/_dbconnect.php';

            $sql = "SELECT `firstname`, `lastname`,`phone`,`email` FROM `member` WHERE `member_id`='{$_SESSION['member_id']}'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            echo ' <div class="col mt-3">
                <h4><center><strong>👤 Personal details</strong></center></h4>
                        <div class="mt-1 list-group list-group-horizontal">
                            <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                                <strong>Detail</strong>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                                <strong>Value</strong>
                            </a>
                    </div>';

            if ($row['firstname']) {
                echo '<div class="list-group list-group-horizontal">
                            <button type="button" class="list-group-item list-group-item-action list-group-item-secondary">
                                <strong>Firstname</strong>
                            </button>
                            <button type="button" class="list-group-item list-group-item-action list-group-item-secondary">
                                ' . $row['firstname'] . '
                            </button>
                        </div>';
            }
            if ($row['lastname']) {
                echo '<div class="list-group list-group-horizontal">
                            <button type="button" class="list-group-item list-group-item-action list-group-item-secondary">
                                <strong>Lastname</strong>
                            </button>
                            <button type="button" class="list-group-item list-group-item-action list-group-item-secondary">
                                ' . $row['lastname'] . '
                            </button>
                        </div>';
            }
            if ($row['phone']) {
                echo '<div class="list-group list-group-horizontal">
                            <button type="button" class="list-group-item list-group-item-action list-group-item-secondary">
                                <strong>Phone</strong>
                            </button>
                            <button type="button" class="list-group-item list-group-item-action list-group-item-secondary">
                                ' . $row['phone'] . '
                            </button>
                        </div>';
            }
            if ($row['email']) {
                echo '<div class="list-group list-group-horizontal">
                            <button type="button" class="list-group-item list-group-item-action list-group-item-secondary">
                                <strong>Email</strong>
                            </button>
                            <button type="button" class="list-group-item list-group-item-action list-group-item-secondary">
                                ' . $row['email'] . '
                            </button>
                        </div>';
            }
            echo '</div>';

            $sql = "SELECT `book_id`, `date` FROM `issue` WHERE `member_id`='{$_SESSION['member_id']}'";
            $result = mysqli_query($conn, $sql);
            if ($result and mysqli_num_rows($result) != 0) {
                echo ' <div class="col mt-3">
                        <h4><center><strong>📚 Issued Books</strong></center></h4>
                            <div class="mt-1 list-group list-group-horizontal">
                                <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                                    <strong>&nbsp;Books</strong>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                                    <strong>Author </strong>
                                </a>
                            </div>';

                $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    $sql2 = "SELECT `book_name`,`author` FROM `book` WHERE `book_id`='{$row['book_id']}'";
                    $result2 = mysqli_query($conn, $sql2);
                    if ($result2) {
                        $row2 = mysqli_fetch_assoc($result2);
                        echo '<div class="list-group list-group-horizontal">
                                <a href="#" class="list-group-item list-group-item-action">
                                    ' . $i . '. ' . $row2['book_name'] . '
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    ' . $row2['author'] . '
                                </a>
                            </div>';
                    }
                    $i++;
                }
                echo '</div>';
            } else {
                echoln('No book issued');
            }

            ?>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>