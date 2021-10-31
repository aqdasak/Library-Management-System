<?php
require_once __DIR__ . '/modules/_add_book.php';
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

    <title>Add book</title>
</head>

<body>

    <?php require_once 'partials/_navbar.html' ?>

    <div class="container mt-4" style="width: 50em;">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="row g-3 align-items-center m-1">
                <div class="col-auto">
                    <label for="title" class="col-form-label" style="width:6.2em;">Title</label>
                </div>
                <div class="col">
                    <input name="book_name" maxlength="40" type="text" id="title" class="form-control" aria-describedby="title">
                </div>
            </div>
            <div class="row g-3 align-items-center m-1">
                <div class="col-auto">
                    <label for="author" class="col-form-label" style="width:6.2em;">Author</label>
                </div>
                <div class="col">
                    <input name="author" maxlength="40" type="text" id="author" class="form-control" aria-describedby="author">
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
                    <input name="no_of_books" maxlength="11" type="number" id="no_of_books" class="form-control" aria-describedby="no_of_books">
                </div>
                <!-- <div class="col-auto">
                    <span id="passwordHelpInline" class="form-text">
                        Must be 8-20 characters long.
                    </span>
                </div> -->
            </div>


            <button type="submit" class="btn btn-primary mt-3 m-2">Submit</button>
        </form>
    </div>


    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $result = add_book($conn, $_POST['book_name'], $_POST['author'], $_POST['description'], $_POST['category'], $_POST['no_of_books']);
        if ($result == 1) {
            $alert_type = 'success';
            $alert = 'Book added successfully';
        } elseif ($result == 0) {
            $alert_type = 'danger';
            $alert = 'Book already present';
        } elseif ($result == -1) {
            $alert_type = 'danger';
            $alert = 'Some error occured';
        }
        echo '<div class="container mt-3">
                <div class="alert alert-' . $alert_type . ' alert-dismissible fade show" role="alert">
                    ' .   $alert . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              </div>';
    }
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>