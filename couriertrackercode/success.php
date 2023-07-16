<?php
// Database credentials
$host = '127.0.0.1';
$dbname = 'couriertracker';
$user = 'root';
$password = '';

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
  <div class="text-center mt-3 alert alert-success alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs- data-bs-dismiss="alert"></button>
      <b>Success!</b>Please Login to Continue
  </div>
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
                  <input  class="w-50 btn btn-outline-success " id="loginbutton" type="submit" value="Register">
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
