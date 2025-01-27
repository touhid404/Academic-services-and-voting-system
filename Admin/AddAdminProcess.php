<?php

include("../Connection/dbconnection.php");


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
    $adminusername = mysqli_real_escape_string($conn, $_POST["username"]);
    $fullname = mysqli_real_escape_string($conn, $_POST["fullname"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST["confirmPassword"]);

    // Check if passwords match
    if ($password !== $confirmPassword) {
        echo '<script>alert("Passwords do not match.");</script>';
        echo '<script>
                location.assign("AddAdmin.php");
            </script>';
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Handle profile picture upload
    $profilePic = null;
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
        $targetDir = "../Login_Page/Images/"; 
        $profilePic = basename($_FILES['profile_pic']['name']);
        $targetFile = $targetDir . $profilePic;

      
        if (!move_uploaded_file($_FILES['profile_pic']['tmp_name'], $targetFile)) {
            echo '<script>alert("Something went wrong while uploading the picture.");</script>';
            echo '<script>
                    location.assign("AddAdmin.php");
                </script>';
            exit;
        }
    }

    // Check if the email or username already exists
    $query = "SELECT * FROM admins WHERE email = ? OR username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $adminusername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<script>alert("Email or username already exists.");</script>';
        echo '<script>
                location.assign("AddAdmin.php");
            </script>';
        exit;
    }

    // Prepared statement to insert new admin into the admin_data table
    $query = "INSERT INTO admins (email, username, fullname ,password, profile_pic) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        echo '<script>alert("Database error. Please try again later.");</script>';
        echo '<script>
                location.assign("AddAdmin.php");
            </script>';
        exit;
    }
    $stmt->bind_param("sssss", $email, $adminusername,$fullname, $hashedPassword,$profilePic);

    // Execute the query
    if ($stmt->execute()) {
        echo '<script>alert("New admin added successfully!");</script>';
        echo '<script>location.assign("AddAdmin.php");</script>';
    } else {
        echo '<script>alert("Failed to add new admin.");</script>';
        echo '<script>
                location.assign("AddAdmin.php");
            </script>';
    }
}
?>
