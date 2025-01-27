<?php
session_start();
include_once "../Header/studentHeader.php";
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
$courses = [];
$query = "SELECT CourseCode, course_name FROM course_table ORDER BY id ASC";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $courses[] = $row;
    }
}

// Handle course selection
$courseAddedMessage = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected-course']) && !empty($_POST['selected-course']) && isset($_POST['section'])) {
    $selectedCourseId = $conn->real_escape_string($_POST['selected-course']);
    $section = $conn->real_escape_string($_POST['section']);

    // Check if the course is already added for this student and trimester
    $checkQuery = "SELECT * FROM Student_course_Trimester WHERE studentId = ? AND CourseCode = ? AND section = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("sss", $studentId, $selectedCourseId, $section);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        // Insert the new course into Student_course_Trimester
        $insertQuery = "INSERT INTO Student_course_Trimester (studentId, CourseCode, section) VALUES (?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("sss", $studentId, $selectedCourseId, $section);

        if ($insertStmt->execute()) {
            echo "<script>
        alert('Success: Successfully added the course.');
      
      </script>";
        } else {
            echo "<script>
        alert('Error: Could not add the course. Please try again later.');
        </script>";
        }
    } else {
        echo "<script>
        alert('Success: Successfully added the course.');
      
      </script>";
    }


    $stmt->close();
}
$st = $conn->prepare("
    SELECT c.CourseCode, c.course_name, sc.section
    FROM course_table c
    JOIN Student_course_Trimester sc
    ON c.CourseCode = sc.CourseCode
    WHERE sc.studentId = ?
");

$st->bind_param("s", $studentId); // Bind student ID as an integer
$st->execute();
$result = $st->get_result();

$Takencourses = [];

// Fetch courses
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $Takencourses[] = $row;
    }
}

$st->close();
$conn->close();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Dashboard</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;700&display=swap");

        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            background: #eeeeee;
            /* Light grey background */
        }

        .container {
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 800px;
            margin: 20px auto;
            margin-top: 70px;
            padding: 30px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
            /* Stronger 3D shadow */
            transition: all 0.3s ease-in-out;
        }

        .container:hover {
            box-shadow: 0 18px 36px rgba(0, 0, 0, 0.15);
            /* Deeper shadow on hover */
            transform: translateY(-8px);
            /* Slight lift effect */
        }

        .profile-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .profile-header img {
            width: 200px;
            height: 200px;
            border-radius: 20%;
            margin: 15px 0;
            border: 4px solid #f0f4f7;
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.2);
            /* Stronger shadow for 3D look */
            transition: all 0.3s ease;
        }

        .profile-header img:hover {
            transform: scale(1.05);
            /* Slight zoom-in effect on hover */
        }

        .profile-header h2 {
            margin: 10px 0;
            color: #2f3640;
            font-size: 26px;
        }

        .profile-header ul {
            list-style: none;
            padding: 0;
            margin: 10px 0;
            font-size: 16px;
            color: #7f8c8d;
        }

        .profile-header ul li {
            margin: 8px 0;
        }

        .courses-section {
            margin-top: 40px;
        }

        .courses-section h2 {
            font-size: 24px;
            color: #2f3640;
            margin-bottom: 20px;
            text-align: center;
        }

        .course-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-between;
        }

        .course {
            flex: 1 1 calc(48% - 10px);
            background: #f9f9f9;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.1);
            position: relative;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .course:hover {
            box-shadow: 0 10px 36px rgba(0, 0, 0, 0.15);
            transform: translateY(-6px);
            /* Lifts up the card */
        }

        .course p {
            margin: 10px 0;
            font-size: 14px;
            color: #333;
        }

        .add-course {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 700px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        .add-course h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        .add-course .message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 15px;
            border: 1px solid #c3e6cb;
        }

        .add-course label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .add-course select,
        .add-course input {
            width: 95%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .add-course select:focus,
        .add-course input:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 4px rgba(0, 123, 255, 0.5);
        }

        .add-course button {
            width: 60%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .add-course button:hover {
            background-color: #0056b3;
        }

        .add-course button:focus {
            outline: none;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            text-align: center;
            box-shadow: 0px 6px 18px rgba(0, 0, 0, 0.1);
            /* Added depth to the table */
            border-radius: 8px;
            overflow: hidden;
        }

        table th,
        table td {
            padding: 12px;
            border: 1px solid #ddd;
            color: #2f3640;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        table th {
            background: #34495e;
            color: white;
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #f5f5f5;
        }

        table tr:hover {
            background-color: #ecf0f1;
        }

        table td {
            background-color: #ffffff;
        }

        table td:hover {
            background-color: #f4f6f7;
        }

        table caption {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #2f3640;
        }

        table td:first-child,
        table th:first-child {
            border-left: none;
        }

        table td:last-child,
        table th:last-child {
            border-right: none;
        }

        .delete-course {
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            padding: 8px 15px;
            font-size: 14px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .delete-course:hover {
            background-color: #c0392b;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
            transform: translateY(-4px);
        }

        table td.cn {
            text-align: left;
            font-size: 13px;
            /* Smaller font size */
            word-wrap: break-word;
            /* Ensure text breaks into multiple lines */
            white-space: normal;
            /* Allow text to wrap */
            max-width: 270px;
            /* Set a max-width to prevent text from stretching too far */
        }

        @media (max-width: 768px) {
            .course-container {
                flex-direction: column;
                gap: 15px;
            }

            .course {
                flex: 1 1 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="profile-header">
            <img src="<?php echo htmlspecialchars($stpicture); ?>" alt="Profile Picture">
            <ul>
                <li><strong>Student Id:</strong> <?php echo htmlspecialchars($studentId); ?></li>
                <li><strong>Name:</strong> <?php echo htmlspecialchars($stname); ?></li>
                <li><strong>Email:</strong> <?php echo htmlspecialchars($stemail); ?></li>
            </ul>
        </div>

        <div class="courses-section">
            <h2>Your Courses</h2>
            <?php if (!empty($Takencourses)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Course ID</th>
                            <th>Course Name</th>
                            <th>Section</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($Takencourses as $c): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($c['CourseCode']); ?></td>
                                <td class="cn"><?php echo htmlspecialchars($c['course_name']); ?></td>
                                <td><?php echo htmlspecialchars($c['section']); ?></td>
                                <td>
                                    <form method="post" action="Delete_course.php">
                                        <input type="hidden" name="course_id" value="<?php echo htmlspecialchars($c['CourseCode']); ?>">
                                        <button type="submit" class="delete-course">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p style="text-align: center;">No courses found for the student.</p>
                <p style="text-align: center; font-size:12px; ">Please your taken course in crrent trimister.</p>
            <?php endif; ?>
        </div>

        <div class="add-course">
            <div>
                <h2>Add a Course</h2>
                <?php if (!empty($courseAddedMessage)) { ?>
                    <div class="message"> <?php echo htmlspecialchars($courseAddedMessage); ?></div>
                <?php } ?>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <label for="selected-course">Choose a course:</label>
                    <select name="selected-course" id="selected-course" required>
                        <option value="">-- Select a Course --</option>
                        <?php foreach ($courses as $course): ?>
                            <option value="<?php echo htmlspecialchars($course['CourseCode']); ?>">
                                <?php echo htmlspecialchars($course['course_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <!-- change this to sec -->
                    <label for="section">Select your section:</label>
                    <input type="text" name="section" placeholder="Please enter your real taken section" required>
                    </select>
                    <!-- ------------- -->
                    <button type="submit">Add Course</button>
                </form>
            </div>
        </div>
    </div>
</body>
<footer>
<?php include_once "../Header/Footer.php"; ?>
</footer>


</html>