<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include("../Connection/dbconnection.php");

    $routeId = mysqli_real_escape_string($conn, $_POST['routeId']);
    $busNo = mysqli_real_escape_string($conn, $_POST['busNo']);
    $routeInfo = mysqli_real_escape_string($conn, $_POST['routeInfo']);
    $startTime = mysqli_real_escape_string($conn, $_POST['startTime']);
    $deptTime = mysqli_real_escape_string($conn, $_POST['deptTime']);


    $routeCheckQuery = "SELECT * FROM routes WHERE route_id = '$routeId'";
    $routeCheckResult = mysqli_query($conn, $routeCheckQuery);

    if (mysqli_num_rows($routeCheckResult) > 0) {

        echo "<script>
                alert('Error: This route alreafy exists.');
                
                location.assign('RouteAdmin.php');  
              </script>";
    } else {

        $InsertQuery = "INSERT INTO routes (route_id, bus_no, route_Info, starting_time,depurture_time) 
                               VALUES ('$routeId', '$busNo', '$routeInfo',  '$startTime','$deptTime')";

        if (mysqli_query($conn, $InsertQuery)) {
            echo "<script>
                alert('Success: This route created successfully.');
                location.assign('RouteAdmin.php'); 
              </script>";
        } else {
            echo "<script>
                    alert('Error: Could not add the route. Please try again later.');
                  location.assign('RouteAdmin.php');  
                  </script>";
        }
    }
    mysqli_close($conn);
}
