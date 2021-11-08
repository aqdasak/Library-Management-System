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

    <title>Admin Login</title>
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
<link rel="stylesheet" href="static/css/style.css">

<body>
    <header class="header">
        <!-- Mid box for navbar -->
        <div class="left">
            <ul class="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a href="member_login.php">Member Login</a></li>
                <li><a href="member_signup.php">Member Signup</a></li>
            </ul>
        </div>
        <!-- Search -->
        <div class="right">
            <form action="search.php" class="d-flex">
                <input name="query" method="POST" class="form-control me-2" type="search" class="round" placeholder="Search" aria-label="Search Book">
                <button class="button btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </header>


    <div class="container">
        <h1 class="main-title">Admin Login</h1>

        <?php
        if ($showError) {

            echo '<center>
                    <div class="myalert-danger" role="alert">
                        ' . $showError . '
                    </div>
                </center>';
        }
        ?>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="form-group">
                <input autofocus type="email" maxlength="30" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password" maxlength="255" name="password" placeholder="Password">
            </div>
            <center><button class="bottom-center">Login</button></center>
        </form>
    </div>
</body>

</html>