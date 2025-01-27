<?php
include("../Connection/dbconnection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['mark_complete'])) {
    $status = $_POST['status'];
    $taskType = $_POST['task_type'];
    $description = $_POST['description'];
    $stId = $_POST['studentId'];
    $Type = $_POST['type'];

    // Corrected SQL query with proper WHERE clause using AND
    $sql = "UPDATE student_tasks SET status = ? WHERE student_id = ? AND task_type = ? AND description = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters
        $stmt->bind_param('ssss', $status, $stId, $taskType, $description);

        // Execute and check the query
        if ($stmt->execute()) {
            header("Location: StudentDashboard.php".$Type);
            exit();
        } else {
            header("Location: StudentDashboard.php".$Type);
            exit();
        }

        $stmt->close();
    } else {
        header("Location: StudentDashboard.php".$Type);
        exit();
    }

    $conn->close();
}
?>
