<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['studentId'];
    
    
    $sql = "SELECT * FROM student_data WHERE NOT studentId = {$outgoing_id} ORDER BY studentId DESC";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;
?>