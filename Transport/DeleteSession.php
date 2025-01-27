<?php
include("../Connection/dbconnection.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

   
    $b_id = $_POST['id'];
   

    
    $deleteRoute = "DELETE FROM booking_session WHERE id = '$b_id'";
    
    if (mysqli_query($conn,$deleteRoute)) {
        header("Location:AddSession.php");
    }
} else {
    header("Location:AddSession.php");
}
