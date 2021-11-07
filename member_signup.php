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
            $showAlert = '<strong>Account created successfully</strong> You can login now!';
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
    <link rel="icon" href="static/image/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Signup</title>
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
                <li><a href="admin_login.php">Admin Login</a></li>
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
        <h1 class="main-title">Please Enter Your Details</h1>

        <center>
            <?php
            if ($showAlert) {
                echo ' <div class="myalert-success" role="alert">
                            ' . $showAlert . '
                       </div>';
            }
            if ($showError) {
                echo ' <div class="myalert-danger" role="alert">
                           ' . $showError . '
                        </div>';
            }
            ?>
        </center>

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group">
                <input required autofocus maxlength="10" type="text" name="Fname" placeholder="Firstname">
            </div>
            <div class="form-group">
                <input required maxlength="30" type="text" name="Lname" placeholder="Lastname">
            </div>
            <div class="form-group">
                <input required maxlength="30" type="email" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input required maxlength="255" type="password" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input required maxlength="255" type="password" name="cpassword" placeholder="Confirm password">
            </div>
            <div class="form-group">
                <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" type="number" name="phone" placeholder="Phone no.">
            </div>

            <center><button class="bottom-center">Submit</button></center>
        </form>
    </div>
</body>

</html>