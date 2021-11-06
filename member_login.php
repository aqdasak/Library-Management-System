<?php
require_once __DIR__ . '/modules/_auth.php';

if (session_status() != PHP_SESSION_ACTIVE) {
  session_start();
}
?>

<?php
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $email = $_POST["email"];
  $password = $_POST["password"];

  $result = login_member($email, $password);
  if ($result) {
    header('location: user_dashboard.php');
    exit;
  } else {
    $showError = '<strong>Invalid credentials</strong>';
  }
}

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="static/image/favicon.ico">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
  <link rel="stylesheet" href="static/css/style.css">

  <title>Login</title>
</head>

<body>

  <!-- <body> -->
  <header class="header">
    <!-- Mid box for navbar -->
    <div class="left">
      <ul class="navbar">
        <li><a href="index.php">Home</a></li>
        <li><a href="member_signup.php">Member Signup</a></li>
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
    <h1 class="main-title">WELCOME TO LIBRARY MANAGEMENT SYSTEM</h1>

    <center>
      <?php
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
          <input name="email" type="email" placeholder="Email" required style="width: 94%;">
          <div class="icon"><i class="fas fa-user"></i></div>
        </div>
        <div class="input_box">
          <input name="password" type="password" placeholder="Password" required style="width: 94%;">
          <div class="icon"><i class="fas fa-lock"></i></div>
        </div>
        <div class="input_box button">
          <input type="submit" value="Login">
        </div>
        <div class="sign_up">
          Not a member? <a href="member_signup.php">Signup now</a>
        </div>
      </form>
    </div>
  </div>

</body>

</html>