<?php
if (
  isset($_SESSION['studentId']) &&
  isset($_SESSION['studentName']) &&
  !empty($_SESSION['studentName']) &&
  !empty($_SESSION['studentId'])
) {
  $studentId = $_SESSION['studentId'];
  $stname = $_SESSION['studentName'];
  $stpicture = $_SESSION['profilePic'];
} else {
?>
  <script>
    location.assign('../Login_Page/LoginForm.php')
  </script>
<?php
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My project</title>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap");

    body {
      margin: 0;
      font-family: "Poppins", sans-serif;
    }

    /* Sticky Header */
    .hriyadh {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      background-color: white;
      
      height: 60px;
      color: black;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px 20px;
      z-index: 1000;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .hriyadh::after {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(255, 255, 255, 0.2);
      pointer-events: none;
    }

    .profile {
      font-size: 16px;
      display: flex;
      align-items: center;
      gap: 10px;
      position: absolute;
      top: 15px;
      left: 20px;
      z-index: 1;
    }

    .profile img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      border: 2px solid #ecf0f1;
    }

    .profile span {
      font-size: 16px;
      font-weight: bold;
      color: #707070;
    }

    .b-container {
      display: flex;
      gap: 10px;
      position: absolute;
      top: 25px;
      right: 20px;
      z-index: 1;
    }

    .b {
      background-color: transparent;
      margin-right: 10px;
      color: black;
      text-decoration: none;
      font-weight: 400;

      padding: 6px 10px;
      display: inline-block;
      border-radius: 5px;
      transition: transform 0.3s ease, background-color 0.3s ease;
    }

    .b:hover {
      background-color: #2c3e50;
      color: white;
      border-radius: 8px;
    }

    .b.active {
      transform: translateX(50px);
    }

    .dropdown {
      position: relative;
    }

    .dropdown-b {
      background-color: transparent;
      color: black;
      text-decoration: none;
      font-weight: 400;
      padding: 7px 3px;
      display: inline-block;
      border-radius: 5px;
      margin-right: 40px;
    }

    .dropdown-b:hover {

      background-color: #2c3e50;
      color: white;
      border-radius: 8px;



    }

    .dropdown-content {
      display: none;
      position: absolute;
      top: 100%;
      right: 0;
      background-color: white;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      z-index: 1000;
      min-width: 170px;
      border-radius: 5px;
      overflow: hidden;
      font-weight: 400;
    }

    .dropdown-content a {
      width: 100%;
      display: block;
      text-decoration: none;
      padding: 10px;
      color: black;
    }

    .dropdown-content a:hover {
      background-color: #2c3e50;
    }

    .dropdown:hover .dropdown-content {
      display: block;

    }

    @media screen and (max-width: 768px) {
      .hriyadh {
        flex-direction: column;
        height: auto;
        padding: 10px;
      }

      .profile {
        position: relative;
        left: 0;
        top: 0;
        margin-bottom: 10px;
      }

      .b-container {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
        position: relative;
        top: 10px;
        right: 0;
      }

      .b {
        width: 100%;
        text-align: left;
        padding: 10px;
      }

      .dropdown-content {
        min-width: 100%;
      }
    }
  </style>
</head>

<body>
  <div class="hriyadh">
    <div class="profile">
      <img src="../Vote_info/img/profile.png" alt="Profile Picture">
      <span><?php echo "Hi, " . $stname  ?></span>
    </div>
    <div class="b-container">
      <a class="b" href="../Admin/AdminDashboard.php">Dashboard</a>
      
      

      <div class="dropdown">
        <a class="dropdown-b" href="#">Academic</a>
        <div class="dropdown-content">
          <a class="b" href="../Academic/AdminApprove.php">Academic Update</a>
          <a class="b" href="../Admin/QsBView.php">View Update</a>
        </div>
      </div>

      <div class="dropdown">
        <a class="dropdown-b" href="#">Vote info</a>
        <div class="dropdown-content">
          <a class="b" href="../Admin/LaunchVote.php">Launch vote</a>
          <a class="b" href="../Admin/VoteInfo.php">Update</a>

        </div>
      </div>
      <div class="dropdown">
        <a class="dropdown-b" href="#">Transport</a>
        <div class="dropdown-content">
        <a class="b" href="../Transport/AddBusRoutine.php">Add Bus routine</a>
        <a class="b" href="../Transport/RouteAdmin.php">Add Routes</a>
        <a class="b" href="../Transport/AddSession.php">Add Sessions</a>
        <!-- <a class="b" href="../Transport/Booking_session.php">Set session</a> -->
          
        

        </div>
      </div>

      <div class="dropdown">
        <a class="dropdown-b" href="#">More</a>
        <div class="dropdown-content">
        <a class="b" href="../RoutineHandler/UploadMidFinnalRoutine.php">Add exam routines</a>
        <a class="b" href="../Admin/AddAdmin.php">Add new Admin</a>
          <a class="b" href="#" onclick="confirmLogout()">Logout</a>
        </div>
      </div>

    </div>
  </div>

  <script>
    function confirmLogout() {
      const userConfirmed = confirm("Are you sure you want to logout?");
      if (userConfirmed) {
        window.location.href = '../Login_Page/logout.php';
      }
    }
  </script>
</body>

</html>