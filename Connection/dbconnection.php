<?php
try {
    $conn = new mysqli("localhost", "root", "", "MyProject");

    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    
} catch (Exception $e) {
    echo "<script>alert('Error: " . $e->getMessage() . "')</script>";
    die();
}
?>
