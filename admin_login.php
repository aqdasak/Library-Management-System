<?php
require_once __DIR__ . '/modules/_auth.php';

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $result = login_admin($email, $password);
    if ($result) {
        header("location: admin_dashboard.php");
    } else {
        $showError = '<strong>Invalid credentials</strong>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="static/image/favicon.ico">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Admin Login</title>
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
                <center><strong>Admin Login</strong></center>
            </h4>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" class="form-control mt-1" name="email" type="email" maxlength="30" autofocus required placeholder="Enter email">
                </div>
                <div class="form-group mt-3">
                    <label for="password">Password</label>
                    <input id="password" class="form-control mt-1" name="password" type="password" maxlength="255" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Login</button>
            </form>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>