<?php

if (
  isset($_SESSION['studentId']) &&
  isset($_SESSION['studentName']) &&
  !empty($_SESSION['studentName']) &&
  !empty($_SESSION['studentName'])
) {
  $studentId = $_SESSION['studentId'];
  $stname = $_SESSION['studentName'];
  $stemail = $_SESSION['StEmail'];
  $stdept = $_SESSION['StDept'];
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
      margin: 0px;
      font-family: "Poppins", sans-serif;
    }

    /* Sticky Header */
    .hriyadh {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      /* background: #e3f2fd; */
      background: white;
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
      color: black;
      text-decoration: none;
      font-weight: 400;
      padding: 6px 15px;
      display: inline-block;
      border-radius: 10px;
      transition: transform 0.3s ease, background-color 0.3s ease;
    }

    .b:hover {
      background-color: #2c3e50;
      color: white;
      border-radius: 10px;
    }



    .dropdown {
      position: relative;
    }

    .dropdown-b {
      background-color: transparent;
      color: black;
      text-decoration: none;
      font-weight: 400;
      padding: 7px 15px;
      display: inline-block;

      border-radius: 10px;

    }

    .dl {
      margin-right: 30px;
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
      min-width: 120px;
      border-radius: 10px;
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
      margin-right: 20px;
      border-radius: 10px;
      background-color: #2c3e50;
    }

    .dropdown:hover .dropdown-content {
      padding: 10px;
      margin-right: 20px;
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
      <img src="<?php echo $stpicture ?>" alt="Profile Picture">
      <span>Hi, <?php echo $stname; ?> 👋</span>


    </div>
    <div class="b-container">
      <a class="b" href="../Users/StudentDashboard.php">Dashboard</a>
      <!-- <a class="b" href="../Users/MyMidFinalRoutine.php">Routine</a>       -->

      <a class="b" href="../Academic/QuestionBank.php">Academic</a>
      <a class="b" href="../Vote_info/VoteTopics.php">Vote</a>

      <div class="dropdown">
        <a class="dropdown-b" href="#">Transport</a>
        <div class="dropdown-content">
          <a class="b" href="../Transport/BookingSeat.php">Book Now</a>
          <a class="b" href="../Transport/TSD.php">View routines</a>
          <a class="b" href="../Transport/ViewRoute.php">View Routes</a>

          <a class="b" href="../Transport/ViewSessionTime.php">Session Time</a>
          <a class="b" href="../Transport/ViewSeats.php">View Seats</a>

        </div>
      </div>

      <div class="dropdown">
        <a class="dropdown-b dl" href="#">More</a>
        <div class="dropdown-content">
          <a class="b" href="../Users/StudentProfile.php">Profile</a>
          <a class="b" href="../Chat/users.php">Message</a>
          <a class="b" href="../Feedback/StudentFeedback.php">Feedback</a>
          

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