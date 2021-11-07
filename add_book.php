<?php require __DIR__ . '/partials/_admin_required.php';

require_once __DIR__ . '/modules/_add_book.php';
require_once __DIR__ . '/modules/_alert.php';

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $result = add_book($_POST['book_name'], $_POST['author'], $_POST['description'], $_POST['category'], $_POST['no_of_books']);

    if ($result == 1) {
        create_alert('Book added successfully', 'success');
    } elseif ($result == 0) {
        create_alert('Book already present', 'danger');
    } elseif ($result == -1) {
        create_alert('Some error occured', 'danger');
    } elseif ($result == -2) {
        create_alert('Number of books should be greater than 0', 'danger');
    }

    if (isset($_GET['redirect_to'])) {
        header("location: {$_GET['redirect_to']}");
    } else {
        header('location: admin_dashboard.php');
    }
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

    <title>Add book</title>
</head>

<script>
    function no_negative(params) {
        let no_of_books = document.getElementById("no_of_books").value;
        if (no_of_books.length > 0) {
            if (no_of_books <= 0) {
                alert("Number of books should be greater than 0");
            } else {
                document.getElementById("add-book-form").submit();
            }
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

    <div class="container mt-4" style="width: 50em;">
        <form id="add-book-form" onsubmit="no_negative(); return false" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="row g-3 align-items-center m-1">
                <div class="col-auto">
                    <label for="title" class="col-form-label" style="width:6.2em;">Title</label>
                </div>
                <div class="col">
                    <input required autofocus name="book_name" maxlength="40" type="text" id="title" class="form-control" aria-describedby="title">
                </div>
            </div>
            <div class="row g-3 align-items-center m-1">
                <div class="col-auto">
                    <label for="author" class="col-form-label" style="width:6.2em;">Author</label>
                </div>
                <div class="col">
                    <input required name="author" maxlength="40" type="text" id="author" class="form-control" aria-describedby="author">
                </div>
            </div>
            <div class="row g-3 align-items-center m-1">
                <div class="col-auto">
                    <label for="description" class="col-form-label" style="width:6.2em;">Description</label>
                </div>
                <div class="col">
                    <input name="description" maxlength="200" type="text" id="description" class="form-control" aria-describedby="description">
                </div>
            </div>
            <div class="row g-3 align-items-center m-1">
                <div class="col-auto">
                    <label for="category" class="col-form-label" style="width:6.2em;">Category</label>
                </div>
                <div class="col">
                    <input name="category" maxlength="20" type="text" id="category" class="form-control" aria-describedby="category">
                </div>
            </div>
            <div class="row g-3 align-items-center m-1">
                <div class="col-auto">
                    <label for="no_of_books" class="col-form-label" style="width:6.2em;">No. of books</label>
                </div>
                <div class="col">
                    <input required name="no_of_books" maxlength="11" type="number" id="no_of_books" class="form-control" aria-describedby="no_of_books">
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3 m-2">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>