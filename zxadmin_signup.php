<?php
require_once __DIR__ . '/modules/_dbconnect.php';
require_once __DIR__ . '/modules/_alert.php';
require_once __DIR__ . '/modules/_auth.php';

$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // $admin_id = $_POST["admin_id"];
    $Fname = $_POST["Fname"];
    $Lname = $_POST["Lname"];
    $email = $_POST["email"];
    $phno = $_POST["phno"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    if (($password == $cpassword)) {
        // $sql = "INSERT INTO `admin` (`Fname`, `Lname`, `phno`, `email`, `password`) 
        // VALUES ('$Fname', '$Lname', '$phno', '$email', '$password');";

        // $result = mysqli_query($conn, $sql);

        $result = signup_admin($Fname, $Lname, $phno, $email, $password);
        if ($result) {
            $showAlert = '<strong>New admin account created Successfully</strong>';
            // create_alert('<strong>Account Created Successfully</strong> You can login now!', 'success');
        }
    } else {
        $showError = '<strong>Error!</strong> Password don\'t match';
        // create_alert('Password don\'t match', 'danger');
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
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="stylesheet" href="static/css/style.css">

    <title>sign up</title>
</head>

<body>
    <header class="header">
        <!-- Mid box for navbar -->
        <div class="left">
            <ul class="navbar">
                <li><a href="xfp1.php">Home</a></li>
                <li><a href="alert.php">About Us</a></li>
                <li><a href="alert.php">Read Books</a></li>
                <li><a href="alert.php">Contact Us</a></li>
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
        <h1>New admin</h1>

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

        <form action="xadmlogin.php" method="post">
            <!-- <div class="form-group">
                <input type="text" name="admin_id" placeholder="admin id">
            </div> -->
            <div class="form-group">
                <input type="text" required name="Fname" placeholder="Firstname">
            </div>
            <div class="form-group">
                <input type="text" required name="Lname" placeholder="Lastname">
            </div>
            <div class="form-group">
                <input type="email" required name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="number" name="phno" placeholder="Phone no.">
            </div>
            <div class="form-group">
                <input type="password" required name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="password" required name="cpassword" placeholder="Confirm password">
            </div>
            <button class="bottom-center">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>