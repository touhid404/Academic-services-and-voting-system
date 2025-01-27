<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include("../Connection/dbconnection.php");
    

    $session_name = mysqli_real_escape_string($conn, $_POST['sname']);
    $startTime = mysqli_real_escape_string($conn, $_POST['sTime']);
    $endTime = mysqli_real_escape_string($conn, $_POST['eTime']);



    $routeCheckQuery = "SELECT * FROM booking_session WHERE session_name = '$session_name'";
    $routeCheckResult = mysqli_query($conn, $routeCheckQuery);

    if (mysqli_num_rows($routeCheckResult) > 0) {

        echo "<script>
                alert('Error: This session alreafy exists.');
                
              location.assign('AddSession.php');
              </script>";
    } else {

        $InsertQuery = "INSERT INTO booking_session (session_name, starting_time,ending_time) 
                               VALUES ('$session_name',  '$startTime','$endTime')";

        if (mysqli_query($conn, $InsertQuery)) {
            echo "<script>
                alert('Success: This session created successfully.');
                location.assign('AddSession.php'); 
              </script>";
        } else {
            echo "<script>
                    alert('Error: Could not add the session. Please try again later.');
                  location.assign('AddSession.php');  
                  </script>";
        }
    }
    mysqli_close($conn);
}
