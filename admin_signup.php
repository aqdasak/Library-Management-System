<?php require __DIR__ . '/partials/_admin_required.php';

require_once __DIR__ . '/modules/_auth.php';
require_once __DIR__ . '/modules/_alert.php';

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Fname = $_POST["Fname"];
    $Lname = $_POST["Lname"];
    $email = $_POST["email"];
    $phno = $_POST["phno"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    if (($password == $cpassword)) {
        $result = signup_admin($Fname, $Lname, $phno, $email, $password);
        if ($result) {
            create_alert('New admin account created successfully', 'success');
            header("location: admin_dashboard.php");
        } else {
            $showError = '<strong>Some error occurred</strong>';
        }
    } else {
        $showError = '<strong>Error!</strong> Password don\'t match';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="icon" href="static/image/favicon.ico">

    <title>New Admin</title>
</head>

<body>

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
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
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


    <div class="container">

        <center>
            <?php
            if ($showError) {
                echo ' <div class="myalert-danger" role="alert">
        <strong>Error! </strong>' . $showError . '
        </div>';
            }
            ?>
        </center>

        <div class="main_div mt-4">
            <h4>
                <center><strong>New Admin</strong></center>
            </h4>


            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="fname">Firstname</label>
                    <div class="col-sm-10">
                        <input id="fname" name="Fname" class="form-control mt-1" type="text" maxlength="10" autofocus required placeholder="Firstname">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="lname">Lastname</label>
                    <div class="col-sm-10">
                        <input id="lname" name="Lname" class="form-control mt-1" type="text" maxlength="30" required placeholder="Lastname">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="email">Email</label>
                    <div class="col-sm-10">
                        <input id="email" name="email" class="form-control mt-1" type="email" maxlength="30" required placeholder="Email">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="phno">Phone no.</label>
                    <div class="col-sm-10">
                        <input id="phno" name="phno" class="form-control mt-1" type="number" maxlength="10" placeholder="Phone no." oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="password">Password</label>
                    <div class="col-sm-10">
                        <input id="password" name="password" class="form-control mt-1" type="password" maxlength="255" required placeholder="Password">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="cpassword">Confirm password</label>
                    <div class="col-sm-10">
                        <input id="cpassword" name="cpassword" class="form-control mt-1" type="password" maxlength="255" required placeholder="Confirm password">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>