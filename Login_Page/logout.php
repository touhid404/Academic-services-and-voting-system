<?php
session_start();
include("../Connection/dbconnection.php");
if (
    isset($_SESSION['studentId']) &&
    isset($_SESSION['studentName']) &&
    !empty($_SESSION['studentName']) &&
    !empty($_SESSION['studentId'])
) {
    $std_id = $_SESSION['studentId'];
    $sql = "UPDATE student_data SET status = 'Offline now' WHERE studentId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $std_id);

    if ($stmt->execute()) {
        // Status updated successfully
    } else {
        echo "Error updating status: " . $conn->error;
    }
    $stmt->close();
    $conn->close();

    session_unset();
    session_destroy();

?>
    <script>
        location.assign('LoginForm.php')
    </script>
<?php

} else {
?>
    <script>
        location.assign('LoginForm.php')
    </script>
<?php
}

?>