<?php require __DIR__ . '/partials/_admin_required.php';

require_once __DIR__ . '/modules/_auth.php';

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

$showAlert = false;
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
            $showAlert = '<strong>New admin account created Successfully</strong>';
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="stylesheet" href="static/css/style.css">
    <link rel="icon" href="static/image/favicon.ico">

    <title>New Admin</title>
</head>

<body>
    <header class="header">
        <!-- Mid box for navbar -->
        <div class="left">
            <ul class="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a href="admin_dashboard.php">Dashboard</a></li>
                <li><a href="search_member.php">Search Member</a></li>
                <li><a href="logout.php">Logout</a></li>
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
        <h1 class="main-title">New admin</h1>

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
                <input type="text" autofocus maxlength="10" required name="Fname" placeholder="Firstname">
            </div>
            <div class="form-group">
                <input type="text" maxlength="30" required name="Lname" placeholder="Lastname">
            </div>
            <div class="form-group">
                <input type="email" maxlength="30" required name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="10" name="phno" placeholder="Phone no.">
            </div>
            <div class="form-group">
                <input type="password" maxlength="255" required name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="password" maxlength="255" required name="cpassword" placeholder="Confirm password">
            </div>
            <center><button class="bottom-center">Submit</button></center>
        </form>
    </div>

</body>

</html>