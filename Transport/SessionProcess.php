<?php

include("../Connection/dbconnection.php");
// Get form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $session_name = $_POST['s_name'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];


    // Insert into the database
    $sql = "INSERT INTO booking_session (session_name,starting_time, ending_time) VALUES (' $session_name','$start_time', '$end_time')";

    if ($conn->query($sql) === TRUE) {
       
        echo "<script>
        alert('Session set successfully');
        location.assign('Booking_session.php'); 
      </script>";
    } else {
       
        echo "<script>
        alert('Error: Session not set');
        location.assign('Booking_session.php'); 
      </script>";
    }
}

// Close the connection
$conn->close();
?>
