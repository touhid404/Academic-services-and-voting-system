<?php
include("../Connection/dbconnection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $student_id = $_POST['stdId'];     // Student ID
    $task_type = $_POST['topic'];      // Task Title
    $description = $_POST['comments']; // Task Description
    $Type = $_POST['type1'];

    // Check if any field is empty
    if (empty($student_id) || empty($task_type) || empty($description)) {
        echo "<script>
        alert('Please fill in all fields');
        location.assign('StudentDashboard.php');
        </script>";
        exit;
    }

    // Prepare the SQL statement to prevent SQL injection
    $sql = "INSERT INTO student_tasks (student_id, task_type, description) 
            VALUES (?, ?, ?)";

    // Initialize prepared statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("sss", $student_id, $task_type, $description);

        // Execute the query
        if ($stmt->execute()) {
            header("Location: StudentDashboard.php".$Type);
            exit();
        } else {
            header("Location: StudentDashboard.php".$Type);
            exit();
        }

        // Close the statement
        $stmt->close();
    } else {
        header("Location: StudentDashboard.php".$Type);
        exit();
    }
}
?>
