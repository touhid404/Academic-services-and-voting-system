<?php
session_start();
include("../Connection/dbconnection.php"); // Include database connection

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Validate session
if (
    !isset($_SESSION['studentId']) || 
    empty($_SESSION['studentId'])
) {
    echo "Unauthorized access.";
    exit;
}

$studentId = $_SESSION['studentId'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['course_id']) && !empty($_POST['course_id'])) {
    $courseId = $conn->real_escape_string($_POST['course_id']);

    // Prepare and execute the deletion query
    $deleteQuery = "DELETE FROM Student_course_Trimester WHERE studentId = ? AND CourseCode = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("ss", $studentId, $courseId);

    if ($stmt->execute()) {
        header("Location: StudentProfile.php");
    } else {
        header("Location: StudentProfile.php");
    }

    $stmt->close();
} else {
    header("Location: StudentProfile.php");
}

$conn->close();
?>
