<?php
require_once __DIR__ . '/modules/_auth.php';
require_once __DIR__ . '/modules/_alert.php';

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fname = $_POST["Fname"];
    $lname = $_POST["Lname"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];


    if (($password == $cpassword)) {
        $result1 = signup_member($fname, $lname, $phone, $email, $password);
        $result = login_member($email, $password);
        if ($result) {
            create_alert('Account created successfully', 'success');
            header('location: user_dashboard.php');
            exit;
        } elseif ($result1) {
            $showAlert = true;
            create_alert('<strong>Account created successfully</strong> You can login now!', 'success');
        } else {
            $showError = true;
            create_alert('<strong>Some error occurred</strong>', 'danger');
        }
    } else {
        $showError = true;
        create_alert('<strong>Error!</strong> Password don\'t match', 'danger');
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="static/image/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Signup</title>
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

        <div class="container">
            <?php
            if ($showError or $showAlert) {
                require __DIR__ . '/partials/_show_alert.php';
            }
            ?>
        </div>

        <div class="main_div mt-4">
            <h4>
                <center><strong>Member Signup</strong></center>
            </h4>

            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">

                <div class="form-group row">
                    <label for="fname" class="col-sm-2 col-form-label">Firstname</label>
                    <div class="col-sm-10">
                        <input id="fname" name="Fname" class="form-control mt-1" maxlength="10" type="text" placeholder="Firstname" required autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="lname" class="col-sm-2 col-form-label">Lastname</label>
                    <div class="col-sm-10">
                        <input id="lname" name="Lname" class="form-control mt-1" maxlength="30" type="text" placeholder="Lastname" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input id="email" name="email" class="form-control mt-1" maxlength="30" type="email" placeholder="Email" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label">Phone no.</label>
                    <div class="col-sm-10">
                        <input id="phone" class="form-control mt-1" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" type="number" name="phone" placeholder="Phone no.">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input id="password" name="password" class="form-control mt-1" maxlength="255" type="password" placeholder="Password" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="cpassword" class="col-sm-2 col-form-label">Confirm password</label>
                    <div class="col-sm-10">
                        <input id="cpassword" name="cpassword" class="form-control mt-1" maxlength="255" type="password" placeholder="Confirm password" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>