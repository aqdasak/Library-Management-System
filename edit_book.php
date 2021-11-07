<?php require __DIR__ . '/partials/_admin_required.php'; ?>

<?php
require_once __DIR__ . '/modules/_edit_book.php';
require_once __DIR__ . '/modules/_dbconnect.php';
require_once __DIR__ . '/modules/_category.php';
require_once __DIR__ . '/modules/_alert.php';

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

    <title>Edit book</title>
</head>
<script>
    function delete_book(params) {
        let del = confirm('Book, all issues and history will be deleted.');
        if (del) {
            document.getElementById("delete-book-form").submit();
        }
    }
</script>

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

    <?php
    // POST REQUEST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // First step
        if ($_POST['step'] == 1) {

            $sql = "SELECT * FROM `book` WHERE `book_id`='{$_POST['book_id']}'";
            $result = mysqli_query($conn, $sql);
            if ($result and mysqli_num_rows($result) != 0) {
                $row = mysqli_fetch_assoc($result);
                $sql = "SELECT `category_name` FROM `category` WHERE `category_id`='{$row['category_id']}'";
                $result = mysqli_query($conn, $sql);
                $category = mysqli_fetch_assoc($result)['category_name'];
            } else {
                header("location: {$_GET['redirect_to']}");
                exit();
            }

            if (isset($_GET['redirect_to'])) {
                $redirect_to = "redirect_to={$_GET['redirect_to']}";
            } else {
                $redirect_to = '';
            }
            // <button type="submit" class="btn btn-danger mx-2">Remove Book</button>

            echo <<<END
            <div class="container mt-2" style="width: 50em;">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <form id="delete-book-form" action="remove_book.php?$redirect_to" method="POST">
                    <input type="hidden" id="book_id" name="book_id" value="{$_POST['book_id']}">
                </form>
                <button class="btn btn-danger mx-2" onclick="delete_book()">Remove Book</button> 

                </div>
                <form action="{$_SERVER['PHP_SELF']}?$redirect_to" method="POST">
                    <div class="row g-3 align-items-center m-1">
                        <div class="col-auto">
                            <label for="title" class="col-form-label" style="width:6.2em;">Title</label>
                        </div>
                        <div class="col">
                            <input required autofocus name="book_name" maxlength="40" type="text" id="title" class="form-control" aria-describedby="title" value="{$row['book_name']}">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center m-1">
                        <div class="col-auto">
                            <label for="author" class="col-form-label" style="width:6.2em;">Author</label>
                        </div>
                        <div class="col">
                            <input required name="author" maxlength="40" type="text" id="author" class="form-control" aria-describedby="author" value="{$row['author']}">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center m-1">
                        <div class="col-auto">
                            <label for="description" class="col-form-label" style="width:6.2em;">Description</label>
                        </div>
                        <div class="col">
                            <input name="description" maxlength="200" type="text" id="description" class="form-control" aria-describedby="description" value="{$row['description']}">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center m-1">
                        <div class="col-auto">
                            <label for="category" class="col-form-label" style="width:6.2em;">Category</label>
                        </div>
                        <div class="col">
                            <input name="category" maxlength="20" type="text" id="category" class="form-control" aria-describedby="category" value="{$category}">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center m-1">
                        <div class="col-auto">
                            <label for="total_books" class="col-form-label" style="width:6.2em;">Total books</label>
                        </div>
                        <div class="col">
                            <input required name="total_books" maxlength="11" type="number" id="total_books" class="form-control" aria-describedby="total_books" value="{$row['total_books']}">
                        </div>
                        <!-- <div class="col-auto">
                            <span id="passwordHelpInline" class="form-text">
                                Must be 8-20 characters long.
                            </span>
                        </div> -->
                    </div>
                    <input type="hidden" id="book_id" name="book_id" value="{$row['book_id']}">
                    <input type="hidden" id="step" name="step" value="2">

                    <button type="submit" class="btn btn-primary mt-3 m-2">Submit</button>
                </form>
                </div>
            END;
        }

        // Second step
        elseif ($_POST['step'] == 2) {
            $result = edit_book($_POST['book_id'], $_POST['book_name'], $_POST['author'], $_POST['description'], $_POST['category'], $_POST['total_books']);

            if ($result == 1) {
                create_alert('Saved successfully', 'success');
            } elseif ($result == -1) {
                create_alert('Some error occured', 'danger');
            } elseif ($result == -2) {
                create_alert('Number of books should be greater than 0', 'danger');
            }

            if (isset($_GET['redirect_to'])) {
                $redirect = urldecode($_GET['redirect_to']);
            } else {
                $redirect = 'admin_dashboard.php';
            }
            header("location: {$redirect}");
            exit;
        }
    } else {
        header('location: dashboard.php');
        exit;
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>