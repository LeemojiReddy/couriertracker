<?php
session_start();
  // Check if the name session variable is set
  if (!isset($_SESSION['username'])) {
    // User is not logged in, redirect to the login page
    header('Location: index.php');
    exit();
  }
  else{
      $username = $_SESSION['username'];
  } 
    
  if (isset($_POST['logout'])) {
    // Clear all session variables
    session_unset();
    
    // Destroy the session
    session_destroy();
    
    // Redirect to the index.php page
    header('Location: index.php');
    exit();
}
  ?>

<html>
<head>
  <title>Dashboard</title>
  <link rel="stylesheet" href="bootstrap.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
  <nav class="navbar pb-0" style="background-color: orange;">
    <div class="navbar-logo" >
      <img src="logo.png" alt="Logo" width="120px" height="40px">
    </div>
    <div class="navbar-menu">
      <i class="navbar-menu-icon">&#9776;</i>
    </div>
    <div class="navbar-links">
      <a class="navbar-link" style="opacity: 0.6;pointer-events: none;">Home</a>
      <a href="about.html" class="navbar-link">About</a>
      <span class="navbar-username fw-bolder ms-2 me-3" style="color:#4a0afa"><?php echo $username; ?></span>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <button id="logout" class="btn btn-danger mt-3" type="submit" name="logout">Logout</button>
            </form>
    </div>
  </nav>
  <div class="logo decorated"><p><i>Courier Tracker</i></p></div>
  <div class="d-flex justify-content-center align-items-center mb-0">
    <div>
      <h1 class="text-warning">Shiprocket Courier Tracking</h1>
    </div></div>
    <div class="d-flex justify-content-center align-items-center mb-0">
      
      <input class="w-50 form-control" placeholder="Enter AWB Number:" type="text" id="awbNumber">
      
    </div>
    <div class="d-flex justify-content-center align-items-center mt-3 mb-0">
      <button class="btn btn-outline-success w-25" id="track-btn" onclick="trackCourier()">Track</button>
    </div>
  <div id="trackingResult"></div>

  <script>
    function trackCourier() {
      var awbNumber = document.getElementById("awbNumber").value;
      var accessToken = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2FwaXYyLnNoaXByb2NrZXQuaW4vdjEvZXh0ZXJuYWwvYXV0aC9sb2dpbiIsImlhdCI6MTY4OTIyMzY5NCwiZXhwIjoxNjkwMDg3Njk0LCJuYmYiOjE2ODkyMjM2OTQsImp0aSI6IktNR0FWMzh4TTdmaENZUzYiLCJzdWIiOjM3Mzk2MjAsInBydiI6IjA1YmI2NjBmNjdjYWM3NDVmN2IzZGExZWVmMTk3MTk1YTIxMWU2ZDkifQ.I8eB6xj6Q8wXFYfmvW0-wNewtt8eSUfnVkyTxaUPFUk"; // Replace with your actual access token
       // Show loading animation
      var trackingResult = document.getElementById("trackingResult");
      trackingResult.innerHTML = `
      <div class="text-center h3 fw-bolder text-primary">
        <div class="spinner-border text-primary" style="width:20px;height:20px;" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        Loading...
      </div>
    `;;

      // Make API request to track courier
      $.ajax(
        
        {
        url: "https://cors-anywhere.herokuapp.com/https://apiv2.shiprocket.in/v1/external/courier/track/awb/" + awbNumber,
        type: "GET",
        headers: {
          "X-Requested-With":"XMLHttpRequest",
          "Content-Type": "application/json",
          "Access-Control-Allow-Origin": "*",
          "Accept-Encoding":"gzip, deflate, br",
          "Connection":"keep-alive",
          "Accept-Language":"en-US,en;q=0.9,hi;q=0.8",
          "Access-Control-Allow-Origin":"*",
          "Sec-Fetch-Dest":"empty",
          "Sec-Fetch-Mode":"cors",
          "Sec-Fetch-Site":"cross-site",
          "Host":"cors-anywhere.herokuapp.com",
          "Origin":"http://127.0.0.1",
          "Referer":"http://127.0.0.1/",
          "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2FwaXYyLnNoaXByb2NrZXQuaW4vdjEvZXh0ZXJuYWwvYXV0aC9sb2dpbiIsImlhdCI6MTY4OTIyMzY5NCwiZXhwIjoxNjkwMDg3Njk0LCJuYmYiOjE2ODkyMjM2OTQsImp0aSI6IktNR0FWMzh4TTdmaENZUzYiLCJzdWIiOjM3Mzk2MjAsInBydiI6IjA1YmI2NjBmNjdjYWM3NDVmN2IzZGExZWVmMTk3MTk1YTIxMWU2ZDkifQ.I8eB6xj6Q8wXFYfmvW0-wNewtt8eSUfnVkyTxaUPFUk"
        },
        success: function(response) {
          // Display tracking information
          var trackingResult = document.getElementById("trackingResult");
          trackingResult.innerHTML = basicdetails(response)+createTrackingTable(response);
        },
        error: function(xhr,status,error,response) {
          if (xhr.status === 404) {
            var errorMessage = `<div class="alert text-center mt-5 alert-danger" role="alert">404 Not Found</div>`;
            var trackingResult = document.getElementById("trackingResult");
            trackingResult.innerHTML = errorMessage;
          }
          else{
          // Handle errorvar errorResult = document.getElementById("trackingResult");
          var errorResult = document.getElementById("trackingResult");
          //errorResult.innerHTML = `
            //<div class="alert alert-danger" role="alert">
              //<strong>Error:</strong> ${xhr.responseText}
            //</div>`;
            
            errorResult.innerHTML = `<div class="alert text-center mt-5 alert-danger" role="alert">` + JSON.stringify(error, null, 2) + `</div>`;
          }
        }
      });
    }
    function basicdetails(data) {
      if (!data.tracking_data.shipment_track || data.tracking_data.shipment_track.length === 0) {
        // Handle the case where shipment_track is empty or undefined
        return `<div class="alert text-center alert-danger mt-5" role="alert">No tracking information found</div>`;
      }
    var shipment = data.tracking_data.shipment_track[0];

    var table = "<table class='table table-bordered mt-5'><tbody>";
    table += "<tr><th>AWB Code</th><td>" + shipment.awb_code + "</td></tr>";
    table += "<tr><th>Shipment ID</th><td>" + shipment.shipment_id + "</td></tr>";
    table += "<tr><th>Order ID</th><td>" + shipment.order_id + "</td></tr>";
    table += "<tr><th>Pickup Date</th><td>" + shipment.pickup_date + "</td></tr>";
    table += "<tr><th>Delivered Date</th><td>" + shipment.delivered_date + "</td></tr>";
    table += "<tr><th>Current Status</th><td>" + shipment.current_status + "</td></tr>";
    table += "<tr><th>Origin</th><td>" + shipment.origin + "</td></tr>";
    table += "<tr><th>Courier Name</th><td>" + shipment.courier_name + "</td></tr>";
    table += "</tbody></table>";

    return table;
  }
  function getStatusColor(status) {
    if (status.toLowerCase() === "delivered") {
      return "text-success";
    } else if (status.toLowerCase() === "in transit") {
      return "text-warning";
    } else if (status.toLowerCase() === "picked up") {
      return "text-success";
    } else if (status.toLowerCase() === "manifest generated" || status.toLowerCase() === "shipped" || status.toLowerCase() === "out for delivery"){
      return "text-success";
    } else {
      return "";
    }
  }
    function createTrackingTable(data) {
      if (!data.tracking_data.shipment_track || data.tracking_data.shipment_track.length === 0) {
        // Handle the case where shipment_track is empty or undefined
        return "";
      }
    var table = "<table class='table table-bordered'><thead><tr><th>Date</th><th>Status</th><th>Activity</th><th>Location</th><th>SR Status</th><th>SR Status Label</th></tr></thead><tbody>";

    data.tracking_data.shipment_track_activities.forEach(function(activity) {
      var row = "<tr>";
      row += "<td>" + activity.date + "</td>";
      row += "<td class='" + getStatusColor(activity.status) + "'>"  + activity.status + "</td>";
      row += "<td>" + activity.activity + "</td>";
      row += "<td>" + activity.location + "</td>";
      row += "<td>" + activity["sr-status"] + "</td>";
      row += "<td class='" + getStatusColor(activity["sr-status-label"]) + " fw-bolder'>" + activity["sr-status-label"] + "</td>";
      row += "</tr>";
      table += row;
    });

    table += "</tbody></table>";

    return table;
  }
  </script>
 
  
  <script>
    const menuIcon = document.querySelector('.navbar-menu-icon');
    const navbarLinks = document.querySelector('.navbar-links');
    
    menuIcon.addEventListener('click', () => {
      navbarLinks.classList.toggle('active');
    });
    
  </script>
</body>
</html>