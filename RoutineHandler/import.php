<?php

use SimpleExcel\SimpleExcel;

if (isset($_POST['import'])) {

    // Check if file is uploaded
    if (move_uploaded_file($_FILES['excel_file']['tmp_name'], $_FILES['excel_file']['name'])) {

        require_once('SimpleExcel/SimpleExcel.php');

        // Initialize SimpleExcel for CSV parsing
        $excel = new SimpleExcel('csv');
        $excel->parser->loadFile($_FILES['excel_file']['name']);
        $data = $excel->parser->getField();

        // Database connection
        $db = mysqli_connect('localhost', 'root', '', 'MyProject');

        if (!$db) {
            die("Database connection failed: " . mysqli_connect_error());
        }

        // Start inserting data (ignoring the header row)
        for ($i = 1; $i < count($data); $i++) {
            $dept = mysqli_real_escape_string($db, $data[$i][0]);        // Department
            $courseCode = mysqli_real_escape_string($db, $data[$i][1]);  // Course Code
            $courseTitle = mysqli_real_escape_string($db, $data[$i][2]); // Course Title
            $section = mysqli_real_escape_string($db, $data[$i][3]);     // Section
            $teacher = mysqli_real_escape_string($db, $data[$i][4]);     // Teacher
            $examdate = mysqli_real_escape_string($db, $data[$i][5]);    // Exam Date
            $examtime = mysqli_real_escape_string($db, $data[$i][6]);    // Exam Time
            $room = mysqli_real_escape_string($db, $data[$i][7]);        // Room

            // Insert Query
            $query = "INSERT INTO MidFinalroutine (Dept, CourseCode, CourseTitle, Section, Teacher, ExamDate, ExamTime, Room) 
                      VALUES ('$dept', '$courseCode', '$courseTitle', '$section', '$teacher', '$examdate', '$examtime', '$room')";

            if (!mysqli_query($db, $query)) {
                echo "Error inserting record: " . mysqli_error($db);
            }
        }

        // Close database connection
        mysqli_close($db);

        echo "<script>
        alert('Success: Data imported successfully.');
        
      location.assign('UploadMidFinnalRoutine.php');
      </script>";
    } else {
        echo "<script>
        alert('Error: This session alreafy exists.');
        
      location.assign('UploadMidFinnalRoutine.php');
      </script>";
    }
}
