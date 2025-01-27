<?php
    session_start();
    include_once "config.php";
    

    $outgoing_id = $_SESSION['studentId'];
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    $sql = "SELECT * FROM student_data WHERE NOT studentId = {$outgoing_id} AND  name LIKE '%{$searchTerm}%'";
    $output = "";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }else{
        $output .= 'No user found related to your search term';
    }
    echo $output;
?>