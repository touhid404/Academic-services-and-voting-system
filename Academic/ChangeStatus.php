<?php
include("../Connection/dbconnection.php");

try {

    if (isset($_POST['delete_file'])) {
        // Get the file name from the hidden input
        $file_path = $_POST['file_path'];

        if (file_exists($file_path)) {
            // Attempt to delete the file from the server
            if (unlink($file_path)) {
                // Delete the file record from the database
                $delete_sql = "DELETE FROM files WHERE FilePath = ?";
                $delete_stmt = $conn->prepare($delete_sql);
                $delete_stmt->bind_param('s', $file_path); // Use file path for deletion
                if ($delete_stmt->execute()) {
                    header("Location: AdminApprove.php");
                } else {
                    header("Location: AdminApprove.php");
                    
                }
                $delete_stmt->close();
            } else {
                header("Location: AdminApprove.php");
                
            }
        } else {
            header("Location: AdminApprove.php");

        }
    }
} catch (Exception $e) {
    header("Location: AdminApprove.php");
   
}
try {

    if (isset($_POST['approve_file'])) {
        // Get the file name from the hidden input
        $file_name = $_POST['file_id'];
    
        // Check if the file is already approved
        $check_sql = "SELECT Approve FROM files WHERE FilePath = ?";
        $stmt_check = $conn->prepare($check_sql);
        $stmt_check->bind_param("s", $file_name); // Bind as a string ('s')
        $stmt_check->execute();
        $stmt_check->store_result();
    
        if ($stmt_check->num_rows > 0) {
            $stmt_check->bind_result($approve_status);
            $stmt_check->fetch();
    
            // If the file is already approved
            if ($approve_status === 'yes') {
                header("Location: AdminApprove.php");
            } else {
                // Update the file to approved
                $sql = "UPDATE files SET Approve = 'yes' WHERE FilePath = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $file_name); // Bind as a string ('s')
    
                if ($stmt->execute()) {
                    header("Location: AdminApprove.php");
                } else {
                    header("Location: AdminApprove.php");
                }
            }
        } else {
            header("Location: AdminApprove.php");
        }
    
        $stmt_check->close();
    }
    
} catch (Exception $e) {
   
}
