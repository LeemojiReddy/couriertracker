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

// Process sign-in form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];

    // Insert the user data into the database
    try {
        $stmt = $db->prepare("INSERT INTO users (username, password, name) VALUES (:username, :password, :name)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        // Redirect to a success page or perform any other necessary actions
        header('Location: success.php');
        exit();
    } catch (PDOException $e) {
        die('Database error: ' . $e->getMessage());
    }
}
?>
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
      display: flex;
      
      
      align-items: center;
      justify-content: center;
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
      <a href="index.php" class="navbar-link" style="">Home</a>
      <a href="about.html" class="navbar-link">About</a>
    </div>
  </nav>
  <div class="logo decorated" ><p><i>Courier Tracker</i></p></div>
  <div class="d-flex justify-content-center align-items-center mb-0">
  <div class="w-50">
    <form class="mb-0 mt-0"method="POST" action="">
        <div class="card shadow-lg">
            <div class="d-flex align-items-center justify-content-center">
               <h1><i class="fw-bolder text-warning">Sign in</i></h1>
            </div>
          <div class="card-body ">
              <input class="form-control" id="signup-email" type="email" name="username" placeholder="Username" required><br/>
              <input class="form-control" id="signup-name" type="text" pattern="[a-zA-Z]{3,}" name="name" placeholder="Name" required><br/>
              <input class="form-control" id="signup-password" type="password" name="password" placeholder="Password" required><br/>
              <div class="d-flex align-items-center justify-content-center">
                  <input  id="signup-submit" class="w-50 btn btn-outline-success " type="submit" value="Register">
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