<?php
session_start();
if (
    isset($_SESSION['studentId']) &&
    isset($_SESSION['studentName']) &&
    !empty($_SESSION['studentName']) &&
    !empty($_SESSION['studentId'])
) {
    $studentId = $_SESSION['studentId'];
    $stname = $_SESSION['studentName'];
} else {
?>
    <script>
        location.assign('../Login_Page/LoginForm.php')
    </script>
<?php
}
include_once "../Header/AdminHeader.php";
include("../Connection/dbconnection.php");

if (isset($_POST["register"])) {
    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $enddate = mysqli_real_escape_string($conn, $_POST["end_date"]);
    $deadline = mysqli_real_escape_string($conn, $_POST["deadline"]);
    

    $image = $_FILES['image']['name'];
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $allowedTypes = array("jpg", "jpeg", "png", "gif");
    $targetFile = __DIR__ . "/VoteImages/" . $image;
    $imageNameWithoutExt = pathinfo($image, PATHINFO_FILENAME);

    if (in_array($ext, $allowedTypes)) {
        if (!file_exists(__DIR__ . "/VoteImages/")) {
            mkdir(__DIR__ . "/VoteImages/", 0777, true); // Create directory if not exists
        }
    }


    // Check if the title already exists
    $checkQuery = "SELECT * FROM vote_details WHERE titleOfVote = '$title'";
    $checkResult = mysqli_query($conn, $checkQuery);
    
    if (mysqli_num_rows($checkResult) > 0) {
        // Append the image name to the title
        $title .= "_" . $imageNameWithoutExt;
    }
    

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            // Insert the new vote details
            $insertQuery = "INSERT INTO vote_details (titleOfVote, description, end_date, deadline, image_path) 
                                VALUES ('$title', '$description', '$enddate', '$deadline', '$image')";
            $insertResult = mysqli_query($conn, $insertQuery);

            if ($insertResult) {
                echo "<script>alert('Registration Successful');</script>";
            } else {
                echo "<script>alert('Error in registration');</script>";
            }
        } else {
            echo "<script>alert('Error uploading image.');</script>";
        }
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Vote</title>
    <link rel="stylesheet" href="../Css/candidate_details_style.css">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap");

        body {
            font-family: "Poppins", sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
            background: #eeeeee;
        }

        form {
            margin-top: 70px;
            background: #ffffff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            width: 100%;
            transition: all 0.3s ease-in-out;
        }

        h2 {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        label {
            font-weight: 500;
            font-size: 16px;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }

        input[type="text"],
        input[type="datetime-local"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
            box-sizing: border-box;
            margin-bottom: 15px;
            font-size: 16px;
            transition: border 0.3s ease-in-out;
        }

        input[type="text"]:focus,
        input[type="datetime-local"]:focus,
        input[type="file"]:focus,
        textarea:focus {
            border-color: #007BFF;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #2c3e50;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        button:hover {
            background-color: #0056b3;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group textarea {
            height: 100px;
            resize: vertical;
        }

        @media (max-width: 768px) {
            form {
                padding: 15px;
            }

            h2 {
                font-size: 22px;
            }

            button {
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <form method="POST" enctype="multipart/form-data">
        <h2>Launch a Vote</h2>

        <div class="form-group">
            <label for="title">Vote Title</label>
            <input type="text" name="title" placeholder="Enter title for the vote" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" placeholder="Describe the vote" required></textarea>
        </div>

        <div class="form-group">
            <label for="end_date">End Date of Vote</label>
            <input type="datetime-local" name="end_date" required>
        </div>

        <div class="form-group">
            <label for="deadline">Application Deadline for Candidates</label>
            <input type="datetime-local" name="deadline" required>
        </div>

        <div class="form-group">
            <label for="image">Upload Image</label>
            <input type="file" name="image" accept=".jpg, .jpeg, .png, .gif" required>
        </div>

        <button type="submit" name="register">Register Vote</button>
    </form>
</body>

</html>