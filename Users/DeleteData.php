
<?php
include("../Connection/dbconnection.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_task'])) {
    
    $taskType = $_POST['task_type'];
    $description = $_POST['description'];
    $stId = $_POST['studentId'];
    $Type = $_POST['type'];

    // Delete the task from the database
    $sql = "DELETE FROM student_tasks WHERE student_id = ? AND task_type = ? AND description = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('sss',$stId, $taskType,$description);
        if ($stmt->execute()) {
            // Redirect back to the progress page or display a success message
            header("Location: StudentDashboard.php".$Type);
            exit();
        } else {
            header("Location: StudentDashboard.php".$Type);
           
        }
    }
}
?>
