<!DOCTYPE html>
<html lang="en">

<head>
  <title>LMS!</title>
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
<link rel="stylesheet" href="static/css/style.css">

<body>
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
    <div class="main_div">
      <div class="title">Login Form </div>
      <div class="social_icons">
        <a href="#"><i class="fab fa-facebook-f"></i> <span>Facebook</span></a>
        <a href="#"><i class="fab fa-twitter"></i><span>Twitter</span></a>
      </div>
      <form action="/2nd/login.php">
        <div class="input_box">
          <input type="text" placeholder="Email or Phone" required>
          <div class="icon"><i class="fas fa-user"></i></div>
        </div>
        <div class="input_box">
          <input type="password" placeholder="Password" required>
          <div class="icon"><i class="fas fa-lock"></i></div>
        </div>
        <div class="option_div">
          <div class="check_box">
            <input type="checkbox">
            <span>Remember me</span>
          </div>
          <div class="forget_div">
            <a href="#">Forgot password?</a>
          </div>
        </div>
        <div class="input_box button">
          <input type="submit" value="Login">
        </div>
        <div class="sign_up">
          Not a member? <a href="/2nd/signup.php">Signup now</a>
        </div>
      </form>
    </div>
  </div>'

</body>

</html>