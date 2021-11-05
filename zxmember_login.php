<?php
if (session_status() != PHP_SESSION_ACTIVE) {
  session_start();
}
require_once __DIR__ . '/modules/_dbconnect.php';
require_once __DIR__ . '/modules/_auth.php';
?>

<?php
$login = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $email = $_POST["email"];
  $password = $_POST["password"];

  $result = login_member($email, $password);
  if ($result) {
    // $sql = "Select * from member where email='$email' and password='$password'";
    // $result = mysqli_query($conn, $sql);
    // $num = mysqli_num_rows($result);
    // if ($num > 0) {
    $login = true;

    //   $_SESSION['login'] = array('admin' => false, 'id' => $email);

    // $_SESSION['loggedin']=true;
    // $_SESSION['username']=$username;
    // header("location: welcome.php");

  } else {
    $showError = "Invalid credential";
  }
}

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
  <link rel="stylesheet" href="static/css/style.css">

  <title>LMS!</title>
</head>

<body>


  <!-- 
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <title>LMS!</title>
  </head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
  <link rel="stylesheet" href="static/css/style.css"> -->

  <!-- <body> -->
  <header class="header">
    <!-- Mid box for navbar -->
    <div class="left">
      <ul class="navbar">
        <li><a href="/2nd/fp1.php">Home</a></li>
        <!-- <li><a href="alert.php">About Us</a></li>
        <li><a href="alert.php">Read Books</a></li>
        <li><a href="alert.php">Contact Us</a></li> -->
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
  <div class="container">
    <h1>WELCOME TO LIBRARY MANAGEMENT SYSTEM</h1>

    <center>
      <?php
      if ($login) {
        echo ' <div class="myalert-success" role="alert">
        You are logged in successfully
       </div>';
      }
      if ($showError) {
        echo ' <div class="myalert-danger" role="alert">
        <strong>Error! </strong>' . $showError . '
        </div>';
      }
      ?>
    </center>

    <div class="main_div">
      <div class="title">Login</div>
      <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="input_box">
          <input name="email" type="email" placeholder="Email" required>
          <div class="icon"><i class="fas fa-user"></i></div>
        </div>
        <div class="input_box">
          <input name="password" type="password" placeholder="Password" required>
          <div class="icon"><i class="fas fa-lock"></i></div>
        </div>
        <!-- <div class="option_div">
          <div class="check_box">
            <input type="checkbox">
            <span>Remember me</span>
          </div>
          <div class="forget_div">
            <a href="#">Forgot password?</a>
          </div>
        </div> -->
        <div class="input_box button">
          <input type="submit" value="Login">
        </div>
        <div class="sign_up">
          Not a member? <a href="xsignup.php">Signup now</a>
        </div>
      </form>
    </div>
  </div>

</body>

</html>