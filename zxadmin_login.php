<?php
require_once __DIR__ . '/modules/_dbconnect.php';
require_once __DIR__ . '/modules/_auth.php';

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

$login = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $result = login_admin($email, $password);

    // $sql = "Select * from users1 where admin_id='$admin_id' and password='$password'";
    // $result = mysqli_query($conn, $sql);
    // $num = mysqli_num_rows($result);
    // if ($num == 1) {
    if ($result) {
        $login = true;
        // session_start();
        // $_SESSION['loggedin'] = true;
        // $_SESSION['admin_id'] = $admin_id;
        header("location: admin_dashboard.php");
    } else {
        $showError = "Invalid credentials";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
<link rel="stylesheet" href="static/css/style.css">

<body>
    <header class="header">
        <!-- Mid box for navbar -->
        <div class="left">
            <ul class="navbar">
                <li><a href="xfp1.php">Home</a></li>
                <!-- <li><a href="alert.php">About Us</a></li>
                <li><a href="alert.php">Read Books</a></li>
                <li><a href="alert.php">Contact Us</a></li> -->
                <li><a href="xadmlogin.php">Admin register</a></li>
                <li><a href="xlogin1.php">Admin login</a></li>


            </ul>
        </div>

        <!-- Right box for buttons -->
        <div class="right">
            <form class="d-flex">
                <input class="form-control me-2" type="search" class="round" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>

        </div>
    </header>


    <div class="container">
        <h1>Login</h1>

        <center>
            <?php
            // if ($showAlert) {
            //     echo ' <div class="myalert-success" role="alert">
            //                ' . $showAlert . '
            //            </div>';
            // }
            if ($showError) {
                echo ' <div class="myalert-danger" role="alert">
                          ' . $showError . '
                       </div>';
            }
            ?>
        </center>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="form-group">
                <input type="email" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password">
            </div>
            <button class="vertical-center">Login</button>
        </form>
    </div>
</body>

</html>