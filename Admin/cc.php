<?php
session_start();
if (
    isset($_SESSION['studentId']) &&
    isset($_SESSION['studentName']) &&
    !empty($_SESSION['studentName']) &&
    !empty($_SESSION['studentId'])
) {
    $studentId = $_SESSION['studentId'];
    $stname = $_SESSION['studentName'];
} else {
?>
    <script>
        location.assign('../Login_Page/LoginForm.php')
    </script>
<?php
}
include_once "../Header/AdminHeader.php";

if (
  isset($_GET['courseCode']) &&
  isset($_GET['courseName']) &&
  isset($_GET['cardColor']) &&
  !empty($_GET['courseCode']) &&
  !empty($_GET['courseName']) &&
  !empty($_GET['cardColor'])
) {
  $courseCode = htmlspecialchars($_GET['courseCode']);
  $courseName = htmlspecialchars($_GET['courseName']);
  $cardColor = htmlspecialchars($_GET['cardColor']);
} else {
  // Redirect to the dashboard or show an error message if required parameters are missing
  echo "<script>alert('Required course details are missing.'); location.assign('CoursesDashboard.php');</script>";
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

    /* Inline styles for demo */
    body {
      font-family: "Poppins", sans-serif;
      background: #eeeeee;
      
    }


    .header {
      width: 835px;
      margin:  0 auto;
      margin-top: 90px;
      text-align: center;
      color: white;
      border-radius: 10px;
      padding-bottom: 10px;
    }
    .banner {
      font-size: 19px;
      font-weight: bold;
    }

    .subtitle {
      font-size: 17px;
      font-weight: bold;
      padding-bottom: 5px;
    }

    .dashboard {
      
      background-color: #FFFFFF;
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 20px;
      padding: 20px;
      max-width: 800px;
      margin: 30px auto;
      box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
    }

    .card {
      /* background: linear-gradient(to right, orange, purple); */
      color: white;
      border-radius: 10px;
      padding: 20px;
      text-align: center;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s ease;
      text-decoration: none;
    }

    .card:hover {
      transform: scale(1.05);
    }



    .card-title {
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .card-subtitle {
      font-size: 15px;
      font-weight: bold;
    }
  </style>
</head>

<body>
  <style>
    .header {
      background: <?php echo $cardColor; ?>;
    }

    /* Dynamic styles */
    .card {
      background: <?php echo $cardColor; ?>;
    }
  </style>



  <header class="header">
    <br>
    <div class="banner"><?php echo $courseName; ?></div>
    <div class="subtitle"><?php echo $courseCode; ?></div>
  </header>

  <main class="dashboard">
    <a class="card" href="../Academic/ds.php?type=Mid-TermQuestions&courseName=<?php echo urlencode($courseName); ?>&courseCode=<?php echo urlencode($courseCode); ?>&cardColor=<?php echo urlencode($cardColor); ?>">
      <div class="card-title">Mid-Term</div>
      <div class="card-subtitle">Questions</div>
    </a>

    <a class="card" href="../Academic/ds.php?type=FinalQuestions&courseName=<?php echo urlencode($courseName); ?>&courseCode=<?php echo urlencode($courseCode); ?>&cardColor=<?php echo urlencode($cardColor); ?>">
      <div class="card-title">Final</div>
      <div class="card-subtitle">Questions</div>
    </a>

    <a class="card" href="../Academic/ds.php?type=Mid-TermSolutions&courseName=<?php echo urlencode($courseName); ?>&courseCode=<?php echo urlencode($courseCode); ?>&cardColor=<?php echo urlencode($cardColor); ?>">
      <div class="card-title">Mid-Term</div>
      <div class="card-subtitle">Solutions</div>
    </a>

    <a class="card" href="../Academic/ds.php?type=FinalSolutions&courseName=<?php echo urlencode($courseName); ?>&courseCode=<?php echo urlencode($courseCode); ?>&cardColor=<?php echo urlencode($cardColor); ?>">
      <div class="card-title">Final</div>
      <div class="card-subtitle">Solutions</div>
    </a>

    <a class="card" href="../Academic/ds.php?type=Class-Note&courseName=<?php echo urlencode($courseName); ?>&courseCode=<?php echo urlencode($courseCode); ?>&cardColor=<?php echo urlencode($cardColor); ?>">
      <div class="card-title">Class Note</div>
      <div class="card-subtitle">Extra</div>
    </a>
  </main>


</body>

</html>