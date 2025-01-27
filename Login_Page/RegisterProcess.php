<?php
include("../Connection/dbconnection.php");

if (isset($_POST["register"])) {
    $studentId = $_POST["studentId"];
    $fname = $_POST["name"];
    $email = $_POST["email"];
    $dept = $_POST["dept"];
    $nickname = $_POST["nickname"];
    $password = $_POST["password"];

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT); // Encrypting the password

    // image upload process
    $picture = $_FILES["picture"]["name"];
    $ext = pathinfo($picture, PATHINFO_EXTENSION);
    $allowedTypes = array("jpg", "jpeg", "png", "gif");
    $tempname = $_FILES["picture"]["tmp_name"];
    $target_path = __DIR__ . "/Images/" . $picture;

    if (in_array($ext, $allowedTypes)) {
        if (!file_exists(__DIR__ . "/Images/")) {
            mkdir(__DIR__ . "/Images/", 0777, true); // Create directory if not exists
        }

        if (move_uploaded_file($tempname, $target_path)) {
            $checkQuery = "SELECT * FROM student_data WHERE studentId = '$studentId'";
            $checkResult = mysqli_query($conn, $checkQuery);

            if (mysqli_num_rows($checkResult) > 0) {
                echo "<script>alert('Student ID already exists. Sorry.');</script>";
            } else {
                $insertQuery = "INSERT INTO student_data (studentId, name, email, dept, nickname, password, profile_pic) 
                            VALUES ('$studentId', '$fname', '$email', '$dept', '$nickname', '$hashedPassword', '$picture')";

                $insertResult = mysqli_query($conn, $insertQuery);

                if ($insertResult) {
                    echo "<script>alert('Registration Successful');</script>";
                    echo '<script>
                        location.assign("LoginForm.php");
                    </script>';
                } else {
                    echo "<script>alert('Error in registration');</script>";
                }
            }
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
        }
    } else {
        echo "<script>alert('Oops... Your file type is not allowed');</script>";
    }
}
?>