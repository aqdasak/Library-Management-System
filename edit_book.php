<?php
require __DIR__ . '/modules/_dbconnect.php';
require __DIR__ . '/modules/_edit_book.php';
require __DIR__ . '/modules/_category.php';
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Edit book</title>
</head>

<body>

    <?php require 'partials/_navbar.html' ?>

    <?php
    // POST REQUEST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $category_id = get_category_id($conn, $_POST['category']);
        if ($category_id == NULL) {
            $category_id = add_category($conn, $_POST['category']);
        }

        $available_books = $_POST['total_books'];
        $sql = "SELECT COUNT(member_id) FROM issue WHERE book_id='{$_POST['book_id']}'";
        $result = mysqli_query($conn, $sql);
        if ($result and mysqli_num_rows($result) != 0) {
            $available_books = $_POST['total_books'] - (int)mysqli_fetch_assoc($result)['COUNT(member_id)'];
        }

        $result = edit_book($conn, $_POST['book_id'], $_POST['book_name'], $_POST['author'], $_POST['description'], $category_id, $_POST['total_books'], $available_books);
        if ($result) {
            header("location: admin_dashboard.php?alert=Saved+successfully&alert_type=success");
            exit();
        } else {
            header("location: admin_dashboard.php?alert=Some+error+occured&alert_type=danger");
            exit();
        }
    }


    // GET REQUEST
    elseif (isset($_GET['book_id'])) {

        $sql = "SELECT * FROM `book` WHERE `book_id`='{$_GET['book_id']}'";
        $result = mysqli_query($conn, $sql);
        if ($result and mysqli_num_rows($result) != 0) {
            $row = mysqli_fetch_assoc($result);
            $sql = "SELECT `category_name` FROM `category` WHERE `category_id`='{$row['category_id']}'";
            $result = mysqli_query($conn, $sql);
            $category = mysqli_fetch_assoc($result)['category_name'];
        }

        echo <<<END
            <div class="container mt-4" style="width: 50em;">
                <form action="{$_SERVER['PHP_SELF']}" method="POST">
                    <div class="row g-3 align-items-center m-1">
                        <div class="col-auto">
                            <label for="title" class="col-form-label" style="width:6.2em;">Title</label>
                        </div>
                        <div class="col">
                            <input name="book_name" maxlength="40" type="text" id="title" class="form-control" aria-describedby="title" value="{$row['book_name']}">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center m-1">
                        <div class="col-auto">
                            <label for="author" class="col-form-label" style="width:6.2em;">Author</label>
                        </div>
                        <div class="col">
                            <input name="author" maxlength="40" type="text" id="author" class="form-control" aria-describedby="author" value="{$row['author']}">
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
                            <input name="total_books" maxlength="11" type="number" id="total_books" class="form-control" aria-describedby="total_books" value="{$row['total_books']}">
                        </div>
                        <!-- <div class="col-auto">
                            <span id="passwordHelpInline" class="form-text">
                                Must be 8-20 characters long.
                            </span>
                        </div> -->
                    </div>
                    <input type="hidden" id="book_id" name="book_id" value="{$row['book_id']}">

                    <button type="submit" class="btn btn-primary mt-3 m-2">Submit</button>
                </form>
                </div>
END;
    } else {
        header('location: dashboard.php');
        exit();
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>