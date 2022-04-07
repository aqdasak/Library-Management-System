<?php
require_once __DIR__ . '/modules/_auth.php';
require_once __DIR__ . '/modules/_alert.php';

if (session_status() != PHP_SESSION_ACTIVE) {
  session_start();
}


$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $email = $_POST["email"];
  $password = $_POST["password"];

  $result = login_member($email, $password);
  if ($result) {
    header('location: user_dashboard.php');
    exit;
  } else {
    $showError = true;
    create_alert('<strong>Invalid credentials</strong>', 'danger');
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

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>Login</title>
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
      if ($showError) {
        require __DIR__ . '/partials/_show_alert.php';
      }
      ?>
    </div>

    <div class="main_div mt-4">
      <h4>
        <center><strong>Member Login</strong></center>
      </h4>


      <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

        <div class="form-group">
          <label for="email">Email</label>
          <input name="email" id="email" class="form-control mt-1" autofocus maxlength="30" type="email" placeholder="Enter email" required style="width: 94%;">
          <!-- <div class="icon"><i class="fas fa-user"></i></div> -->
        </div>
        <div class="form-group mt-3">
          <label for="password">Password</label>
          <input name="password" id="password" class="form-control mt-1" maxlength="255" type="password" placeholder="Password" required style="width: 94%;">
          <!-- <div class="icon"><i class="fas fa-lock"></i></div> -->
        </div>
        <button type="submit" class="btn btn-primary mt-3">Login</button>

        <!-- </div> -->
        <div class="sign_up mt-1">
          Not a member? <a href="member_signup.php" style="text-decoration: none;">Signup now</a>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>