<?php
// Database credentials
$host = 'localhost';
$dbname = 'id21035407_loginsignup';
$user = 'id21035407_root';
$password = 'Leemoji@12345';

// Connect to the database
try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Database connection error: ' . $e->getMessage());
}

// Process login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query the database to find a matching user
    try {
        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Verify the password
            if ($password==$user['password']) {
                // Password is correct, redirect to dashboard.php and store username in session
                session_start();
                $_SESSION['name'] = $user['name'];
                $_SESSION['username'] = $user['username'];
               
                header('Location: dashboard.php');
                exit();
            } else {
                // Password is incorrect
               
                $error = 'Invalid username or password.';
            }
        } else {
            // User not found
            $error = 'Invalid username or password.';
        }
    } catch (PDOException $e) {
        die('Database error: ' . $e->getMessage());
    }
}
?>

<!-- The rest of your HTML code -->


<html>
<head>
  <title>Homepage</title>
  <meta name="google-site-verification" content="1Lm_GH5Es5oLeKYxnwKybjdrV04i6h4vVaYndECSi_M" />
  <!-- Google Analytics -->
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-XXXXX-Y', 'auto');
ga('send', 'pageview');
</script>
<!-- End Google Analytics -->
  <link rel="stylesheet" href="bootstrap.css">
  <script src="bootstrap.bundle.js" async></script>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
     
    }
    
    .navbar {
      background-color: #333;
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px 20px;
    }
    
    .navbar-logo {
      border-radius: 50%;
      width: 40px;
      height: 40px;
      margin-right: 10px;
    }
    
    .navbar-menu {
      display: none;
    }
    
    .navbar-menu-icon {
      font-size: 24px;
      cursor: pointer;
    }
    
    .navbar-links {
      display: flex;
      align-items: center;
    }
    
    .navbar-link {
      margin: 0 10px;
      text-decoration: none;
      color: #fff;
    }
    
    .container {
      align-items: center;
      height: 30vh;
    }
    @media screen and (min-width: 768px){
    .logo{
      display: flex;
      
      align-items: center;
      justify-content: center;
      font-size: 100px;
      font-weight: bolder;
    }}
    @media screen and (max-width: 768px){
    .logo{
      display: flex;
      
      align-items: center;
      justify-content: center;
      font-size: 60px;
      font-weight: bolder;
      transition-duration: 1s ease-in-out;
    }}
    
    .button {
      padding: 10px 20px;
      font-size: 16px;
      border-radius: 4px;
      color: #fff;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    
    .button-google {
      background-color: #db4437;
    }
    
    .button-facebook {
      background-color: #4267B2;
    }
    
    .button:hover {
      opacity: 0.8;
    }
    .decorated {
      background: linear-gradient(to right, #00b4db, #0083b0);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    }
    
    @media screen and (max-width: 768px) {
      .navbar-menu {
        display: block;
      }
      
      .navbar-links {
        display: none;
      }
      
      .navbar-links.active {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        position: absolute;
        top: 50px;
        right: 20px;
        background-color: #333;
        padding: 10px;
        z-index: 1;
      }
    }
  </style>
  
  <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-TJRNW07GQD"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-TJRNW07GQD');
</script>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-F2286D141T"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-F2286D141T');
</script>

<!-- Hotjar Tracking Code for https://couriertracker.000webhostapp.com/CourierPartner/index.php -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:3575087,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>

</head>
<body>
  <nav class="navbar" style="background-color: orange;">
    <div class="navbar-logo" >
      <img src="logo.png" alt="Logo" width="120px" height="40px">
    </div>
    <div class="navbar-menu">
      <i class="navbar-menu-icon">&#9776;</i>
    </div>
    <div class="navbar-links">
      <a class="navbar-link" style="opacity: 0.5;pointer-events: none;">Home</a>
      <a href="about.html" class="navbar-link">About</a>
    </div>
  </nav>
  <div class="logo decorated" ><p><i>Courier Tracker</i></p></div>
  <div class="d-flex justify-content-center align-items-center mb-0">
  <div class="w-50">
    <form class="mb-0 mt-0"method="POST" action="">
        <div class="card shadow-lg">
            <div class="d-flex align-items-center justify-content-center">
               <h1><i class="fw-bolder text-warning">Login</i></h1>
            </div>
          <div class="card-body ">
              <input class="form-control" id="login-username" type="email" name="username" placeholder="Username" required><br/>
              
              <input class="form-control" id="loginpass" type="password" name="password" placeholder="Password" required><br/>
              <?php if (isset($error)) : ?>
        <p class="text-danger"><?php echo $error; ?></p>
    <?php endif; ?>
              <div class="d-flex align-items-center justify-content-center">
                <a class="w-50 btn btn-outline-warning" id="signup-btn" href="signup.php"style="text-decoration:none;">Signup?</a>
                  <input  class="w-50 btn btn-outline-success " id="loginbutton" type="submit" value="Login">
              </div>
          </div>
        </div><br/>
    </form>
</div>
</div>
    <div class="d-flex align-items-center justify-content-center mt-0">
      <a style="text-decoration: none;" class="button button-google">Login with Google</a>
      <a style="text-decoration: none;" class="button button-facebook">Login with Facebook</a>
    </div>

  <script>
    const menuIcon = document.querySelector('.navbar-menu-icon');
    const navbarLinks = document.querySelector('.navbar-links');
    
    menuIcon.addEventListener('click', () => {
      navbarLinks.classList.toggle('active');
    });
  </script>
</body>
</html>
