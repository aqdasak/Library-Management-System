<?php
require_once __DIR__ . '/modules/_dbconnect.php';
require_once __DIR__ . '/modules/_auth.php';

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
?>

<?php
$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // $username = $_POST["username"];
    $fname = $_POST["Fname"];
    $lname = $_POST["Lname"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $email = $_POST["email"];
    // $gender = $_POST["gender"];
    $phone = $_POST["phone"];
    // $age = $_POST["age"];


    if (($password == $cpassword)) {
        $result = signup_member($fname, $lname, $phone, $email, $password);
        // $sql = "INSERT INTO `users1` ( `username`, `password`, `email`, `gender`, `phone`, `age`)
        //  VALUES ( '$username', '$password', '$email', '$gender', '$phone', '$age');";
        // $result = mysqli_query($conn, $sql);
        if ($result) {
            $showAlert = '<strong>Account Created Successfully</strong> You can login now!';
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
    <title>sign up</title>
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
<link rel="stylesheet" href="static/css/style.css">

<body>
    <header class="header">
        <!-- Mid box for navbar -->
        <div class="left">
            <ul class="navbar">
                <li><a href="/2nd/fp1.php">Home</a></li>
                <li><a href="alert.php">About Us</a></li>
                <li><a href="alert.php">Read Books</a></li>
                <li><a href="alert.php">Contact Us</a></li>
                <li><a href="admlogin.php">Admin register</a></li>
                <li><a href="login1.php">Admin login</a></li>


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
    <?php
    // if ($showAlert) {
    //     echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
    //     <strong>Account Created Successfully</strong> You can login now!
    //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //     </div>';
    // }
    // if ($showError) {
    //     echo ' <div class="alert alert-dager alert-dismissible fade show" role="alert">
    //     <strong>Error! </strong>' . $showError . '
    //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //     </div>';
    // }
    ?>



    </header>
    <div class="container">
        <h1>Please Enter Your Details</h1>

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
                <input required type="text" name="Fname" placeholder="Firstname">
            </div>
            <div class="form-group">
                <input required type="text" name="Lname" placeholder="Lastname">
            </div>
            <div class="form-group">
                <input required type="email" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input required type="password" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input required type="password" name="cpassword" placeholder="Confirm password">
            </div>
            <!-- <div class="form-group">
                <input type="text" name="gender" placeholder="Enter your gender">
            </div> -->
            <div class="form-group">
                <input type="number" name="phone" placeholder="Pnone no.">
            </div>
            <!-- <div class="form-group">
                <input type="text" name="age" placeholder="Enter your age">
            </div> -->


            <button class="bottom-center">Submit</button>
        </form>
    </div>
</body>

</html>