<?php
session_start();

include("../Connection/dbconnection.php");

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Validate session
if (
    isset($_SESSION['studentId']) &&
    isset($_SESSION['studentName']) &&
    !empty($_SESSION['studentId']) &&
    !empty($_SESSION['studentName'])
) {
    $studentId = $_SESSION['studentId'];
    $stname = $_SESSION['studentName'];
    $stemail = $_SESSION['StEmail'];
    $stdept = $_SESSION['StDept'];
    $stpicture = $_SESSION['profilePic'];
} else {
    echo "<script>location.assign('../Login_Page/LoginForm.php');</script>";
    exit;
}
// Fetch courses the student is enrolled in
$courses = [];
$query = "SELECT CourseCode, Section FROM Student_course_Trimester WHERE studentId = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $studentId);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $courses[] = $row;
    }
}



// Define the file path
$file = '../RoutineHandler/example.txt';

// Read the text from the file if it exists
if (file_exists($file)) {
    $storedText = file_get_contents($file);
} else {
    $storedText = "The file does not exist.";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Specific Exam Routine</title>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;700&display=swap");

        /* Reset some default styles */
        body,
        h1,
        h2,
        h3,
        p {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: transparent;
            color: #333;
            max-width: 900px;
            height: auto;
            margin: 0 auto;
            padding: 20px;
            overflow: auto;
            border: none;
        }




        .h2 {
            text-align: left;
            margin-left: 10px;
            margin-bottom: 20px;
            font-size: 1.6em;
            color: #2c5c63;
        }

        .container {
            padding: 10px;
            max-width: 900px;
            margin: 0 auto;
        }

        .cards-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: space-between;
        }

        .course-card {
            background-color: #eeeeee;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 250px;
            padding: 10px;
            transition: transform 0.3s;
            margin-bottom: 10px;
        }

        .course-card:hover {
            transform: scale(1.05);
        }

        .course-card h3 {
            font-size: 1em;
            margin-bottom: 9px;
        }

        .course-card p {
            font-size: 0.9em;
            margin-bottom: 6px;
        }

        .course-card .details {
            font-size: 0.7em;
            margin-bottom: 6px;
        }

        .course-card .details span {
            font-weight: bold;
            color: #2d87f0;
        }

        .room {
            font-weight: b;
        }

        .no-data {
            text-align: center;
            font-size: 1.2em;
            color: black;
            width: 100%;
        }
        .no-t{
            text-align: center;
            font-size: 0.9em;
            color: #888;
            width: 100%;

        }

        hr {
            border: 1px solid white;
            /* White color for the horizontal line */
            width: 100%;
            /* Adjust the width of the line */
            margin: 20px auto;
            /* Center the line with some margin */
        }
        .h2 span.h2a {
            color: blueviolet;
        }
    </style>
</head>

<body>


    <div class="container">
        <h2 class="h2">Upcoming <span class="h2a"> <?= htmlspecialchars($storedText) ?> </span> routines</h2>
        <hr>

        <?php if (!empty($courses)): ?>
            <div class="cards-container">
                <?php foreach ($courses as $selectedCourse): ?>
                    <div class="course-card">


                        <?php
                        // Query for the specific exam routine based on the course code and section
                        $courseCode = $selectedCourse['CourseCode'];
                        $section = $selectedCourse['Section'];

                        $sql = "SELECT Dept, courseCode, courseTitle, Section, Teacher, ExamDate, ExamTime, Room 
                                FROM MidFinalroutine WHERE courseCode = ? AND Section = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("ss", $courseCode, $section);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            // Display each routine record for the course
                            while ($data = $result->fetch_assoc()) {
                        ?>
                                <div class="details">
                                    <p><span>Course Code:</span> <?= htmlspecialchars($data['courseCode']) ?></p>
                                    <p><span>Course Title:</span> <?= htmlspecialchars($data['courseTitle']) ?></p>
                                    <p><span>Section:</span> <?= htmlspecialchars($data['Section']) ?></p>
                                    <p><span>Exam Date:</span> <?= htmlspecialchars($data['ExamDate']) ?></p>
                                    <p><span>Exam Time:</span> <?= htmlspecialchars($data['ExamTime']) ?></p>
                                    <p><span>Room:</span> <?= htmlspecialchars($data['Room']) ?></p>
                                </div>
                        <?php
                            }
                        } else {
                            echo "<p class='no-data'>No routine found for this course.</p>";
                        }
                        ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <style>
                .h2{
                    display: none;
                }
            </style>
            <p class="no-data">No courses found for this student.</p>
            <p class="no-t">Add your courses from profile section</p>
        <?php endif; ?>
    </div>
</body>

</html>