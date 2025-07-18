<!DOCTYPE html>
<html>
<?php
// Start the session (if not already started)
// session_start();

// Set the default timezone to Sri Lanka
// date_default_timezone_set("Asia/Colombo");
?>

<head>
  <title>navi bar</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="./DataTables/datatables.min.css">
  <!-- Include additional CSS files if any extensions are used -->
  <style>
    @font-face {
      font-family: 'Acumin Variable Concept';
      /* src: url('./font/AcuminVariableConcept-WideExtraLight.ttf'); */
      src: url('./font/CarroisGothic-Regular.ttf');
      /* src: url('../font/AcuminVariableConcept-WideExtraLight.ttf'); */
    }

    .text_ll {
      font-family: 'Acumin Variable Concept', sans-serif;
      color: rgba(0, 0, 80, 0.8);
    }

    .bg_color {
      background-color: white !important;
      color: darkblue;
      font-weight: bold;
      box-shadow: 0 8px 10px rgba(0, 0, 0, 0.3);
      /* Added shadow */
    }

    .link_color {
      color: darkblue;
    }

    .link_color:hover {
      color: black;
    }

    .btn_log_out11 {
      color: darkblue !important;
      font-weight: bold !important;
    }

    .btn_log_out11:hover {
      background-color: white;
      color: black !important;
    }

    .logo {
      height: 70px;
    }

    .nav-right {
      display: flex;
      align-items: center;
    }

    .nav-right img {
      height: 40px;
      /* Adjust the size of the PNG image if necessary */
      /* margin-left: 20px; */
      /* Space between the logout button and the image */
    }

    .vl {
      border-left: 1px solid black;
      height: 70px;
      /* border-color: rgba(0, 0, 80, 0.8) !important; */
    }
  </style>
</head>
<?php
// Check if the user type is set in the session
$userType = isset($_SESSION['USER_TYPE']) ? $_SESSION['USER_TYPE'] : '';

// Determine the appropriate link based on the user type
$link = './home.php'; // Default link
if ($userType === 'admin') {
  $link = './admin_home.php';
}
?>

<body>
  <div class="fixed-top">
    <div class="bg_color row p-3 align-items-center">
      <div class="col d-flex justify-content-start align-items-center">
        <a href="<?php echo $link; ?>" class=" link_color link-offset-2 link-underline link-underline-opacity-0">
          <img src="./img/systemlogo.jpg" alt="Logo" class="logo me-2">
        </a>
      </div>

      <div class="col d-flex justify-content-end align-items-center nav-right">
        <div class="d-flex align-items-center text-right">
          <div class="datetime display-time text-uppercase text_ll text-center">
            <?php
            // Set timezone to Sri Lanka
            date_default_timezone_set("Asia/Colombo");
            ?>
            <h5 id="time"><?php echo date("h:i"); ?></h5>
            <h5 id="date"> <?php echo date("Y.m.d") ?> </h5>
            </div>
          <div class="vl mx-3 d-inline-block" style="border-left: 2px solid rgba(0, 0, 80, 0.8); height: 50px;"></div>
          <h4 class=" text_ll">
            <?php echo isset($_SESSION['FULLNAME']) ? $_SESSION['FULLNAME'] : ''; ?>
          </h4>
          <div class="vl mx-3 d-inline-block" style="border-left: 2px solid rgba(0, 0, 80, 0.8); height: 50px;"></div>
        </div>
        <div class=" d-flex align-items-center">
          <img src="./img/profpic.png" alt="Profile Picture" style="opacity: 0.8;">
          <a href="./logout.php" id="logout-link" class="btn btn_log_out " data-bs-toggle="tooltip" data-bs-placement="right" title="Log out">
            <img src="./img/out.png" alt="Log Out" style="opacity: 0.8;">
          </a>
        </div>
      </div>

    </div>
  </div>
  <!-- Include jQuery and then Bootstrap Bundle JS (includes Popper.js) -->
  <script src="./bootstrap/jquery-3.7.1.min.js"></script>
  <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="./DataTables/datatables.min.js"></script>

  <script>
    $(document).ready(function() {
      // Initialize tooltips when the page is ready
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
      var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
      });
    });

    // 

    // Add event listener to the logout link
    document.getElementById('logout-link').addEventListener('click', function(event) {
      // Show confirmation dialog
      var confirmation = confirm('Are you sure you want to log out?');
      if (!confirmation) {
        // Prevent the default action if the user cancels
        event.preventDefault();
      }
    });
  </script>
  <script>
    // Function to update the time every second
    function updateTime() {
      const now = new Date();
      
      // Format the time to 12-hour format
      const time = now.toLocaleTimeString('en-US', {
        hour12: true
      });

      // Custom date format: YYYY.MM.DD.
      const year = now.getFullYear();
      const month = String(now.getMonth() + 1).padStart(2, '0'); // Pad month with leading zero
      const day = String(now.getDate()).padStart(2, '0'); // Pad day with leading zero
      const date = `${year}.${month}.${day}`; // Format date as YYYY.MM.DD.

      // Update time and date on the page
      document.getElementById("time").innerHTML = time;
      document.getElementById("date").innerHTML = date;
    }

    // Update the time immediately and then every second
    setInterval(updateTime, 1000);
    updateTime(); // Call once immediately to avoid delay
</script>

</body>

</html>