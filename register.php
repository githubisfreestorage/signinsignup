<?php
session_start();
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      $db = mysqli_connect('localhost','root','','test');
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      $sql_u = "SELECT * FROM registration WHERE username='$username'";
      $res_u = mysqli_query($db, $sql_u);
      if (mysqli_num_rows($res_u) > 0) {
        $error['username'] = 'This username is already taken, go back and choose another one!';
      }
      else {
          $host = 'localhost';
          $dbUsername = 'root';
          $dbPassword = '';
          $dbname = 'test';
          $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
          if (isset($_POST['username']))
      {
          $username = $_POST['username'];
          $usernamelength= strlen($username);
$passwordlength= strlen($password);

if ($usernamelength < 6){
$error['username']= "Username must be at least 6 characters";
}

elseif ($usernamelength > 15){
$error['username']= "Username cannot be greater than 15 characters";
}

elseif ($passwordlength < 6){
$error['password']= "Password must be at least 6 characters";

} else {
          if (mysqli_connect_error()) {
            die('Connect error('. mysqli_connect_error(). ')'. mysqli_connect_error());
          } else {
            $SELECT = 'SELECT email From registration Where email = ? Limit 1';
            $INSERT = 'INSERT Into registration (username, email, password) values(?,?,?)';

            $stmt = $conn->prepare($SELECT);
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->bind_result($email);
            $stmt->store_result();
            $rnum = $stmt->num_rows;

            if ($rnum==0) {
                $stmt->close();

                $stmt = $conn->prepare($INSERT);
                $stmt->bind_param('sss', $username, $email, $password);
                $stmt->execute();
                $error['password'] = 'Account created!';
            } else {
              $error['email'] = 'Someone has already registered using this email, please go back and use a different one.';
            }

            $stmt->close();
            $conn->close();
        }
      }
    }
}
}
?>
<html lang="en">
  <head>
    <head>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
</head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="css/style.css" />
    <link href="css/style2.css" rel="stylesheet" type="text/css">
<div id='navbar'>
    <ul>
      <li><a href="index.html"><img src="img/logo.png" width="100"></a></li>
      <li><a href="index.html">Home</a></li>
      <li><a href="#">Info</a></li>
      <li><a href="#">Quiz</a></li>
      <li><a href="register.php">Sign Up</a></li>
    </ul>
  </div>
    <title>Dinese | Login/Register</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
            <form action="#" method="POST" class="sign-in-form">
              <h2 class="title">Sign up</h2>
              <div class="input-field">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Username" id="username" name="username" required/>
              </div>
              <span><?php if(isset($error['username'])) echo $error['username']; ?></span>
              <div class="input-field">
                <i class="fas fa-envelope"></i>
                <input type="email" placeholder="Email" id="email" name="email" required/>
              </div>
              <span><?php if(isset($error['email'])) echo $error['email']; ?></span>
              <div class="input-field">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Password" id="password" name="password" required/>
              </div>
              <span><?php if(isset($error['password'])) echo $error['password']; ?></span>
              <input type="submit" class="btn" value="Sign up" />
            <p class="social-text">Or Sign in with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>
          <form action="connection.php" method="post" class="sign-up-form">
            <h2 class="title">Sign up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" name="username" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password" required/>
            </div>
            <span><?php if(isset($errorpass2)) echo $errorpass2; ?></span>
            <input type="submit" value="Login" class="btn solid" />
            <p class="social-text">Or Sign up with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Already signed up?</h3>
            <p>
              Then sign in with your account!
            </p>
		<br>
            <button class="btn transparent" id="sign-up-btn">
              Sign in
            </button>
          </div>
          <img src="img/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>New here?</h3>
            <p>
              Sign up right now!
            </p>
		<br>
            <button class="btn transparent" id="sign-in-btn">
              Sign up
            </button>
          </div>
          <img src="img/register.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="js/app.js"></script>
  </body>
</html>
