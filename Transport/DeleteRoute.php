<?php
include("../Connection/dbconnection.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

   
    $route_id = $_POST['route_id'];
   

    
    $deleteRoute = "DELETE FROM routes WHERE route_id = '$route_id'";
    
    if (mysqli_query($conn,$deleteRoute)) {
        header("Location:RouteAdmin.php");
    }
} else {
    header("Location:RouteAdmin.php");
}
