<?php
session_start();
if (
    isset($_SESSION['studentId']) &&
    isset($_SESSION['studentName']) &&
    !empty($_SESSION['studentName']) &&
    !empty($_SESSION['studentName'])
) {
    $studentId = $_SESSION['studentId'];
    $stname = $_SESSION['studentName'];
    $stemail = $_SESSION['StEmail'];
    $stdept = $_SESSION['StDept'];
    $stpicture = $_SESSION['profilePic'];
} else {
?>
    <script>
        location.assign('../Login_Page/LoginForm.php')
    </script>
<?php
}
include_once "../Header/StudentHeader.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload System</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap");

        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            background: #eeeeee;
        }

        header {
            width: 830px;
            margin:  0 auto;
            margin-top: 90px;
            text-align: center;
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            padding: 20px;
            color: white;
            border-radius: 10px;
           
        }

        header h2 {
            margin: 0;
            font-size: 1.4rem;
        }

        .container {
            margin-top: 30px;
            width: 80%;
            max-width: 800px;
            margin: 30px auto;
            background: white;
            padding: 15px 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .info p {
            font-size: 1.1em;
            color: #555;
            margin: 10px 0;
        }

        .info strong {
            color: #333;
        }

        .form-group {
            margin: 20px 0;
        }

        .form-group label {
            font-size: 1.1em;
            margin-bottom: 8px;
            display: block;
            color: #555;
        }

        .form-group input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
        }

        .form-group button {
            margin-top: 10px;
            background-color: #2c3e50;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 1.1em;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-group button:hover {
            background-color: blueviolet;
        }

        .drop-zone {
            border: 2px dashed #ccc;
            border-radius: 10px;
            padding: 8px;
            text-align: center;
            cursor: pointer;
            font-size: 15px;
            color: #777;
            background-color: #f9f9f9;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .drop-zone:hover {
            background-color: #f1f1f1;
            border-color: #aaa;
        }

        .drop-zone.dragover {
            border-color: #333;
            background-color: #e9e9e9;
        }

        .file-name {
            margin-top: 10px;
            font-size: 16px;
            color: #333;
        }

        .ic{
            text-align: center;
            height: 60px;
            width: 60px;
        }
        h4{
            padding: 0;
        }
    </style>
</head>

<body>
    <header>
        <h2>Make Your Contribution Here by Adding Relevant Information</h2>
    </header>

    <div class="container">
        <?php
        $type = $_GET['type'] ?? '';
        $courseName = urldecode($_GET['courseName'] ?? '');
        $courseCode = urldecode($_GET['courseCode'] ?? '');
        $cardColor = urldecode($_GET['cardColor'] ?? '');
        function showAlert($message)
        {
            echo "<script>alert('$message');</script>";
        }
        ?>
        <style>
            header {
                background: <?php echo htmlspecialchars($cardColor); ?>;
            }

            .container {
                background: <?php echo htmlspecialchars($cardColor); ?>;
            }
        </style>

        <div class="info">
            <p>Type: <strong><?php echo htmlspecialchars($type); ?></strong></p>
            <p>Course Code: <strong><?php echo htmlspecialchars($courseCode); ?></strong></p>
            <p>Course Name: <strong><?php echo htmlspecialchars($courseName); ?></strong></p>
        </div>

        <form id="upload-form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <div class="drop-zone" id="drop-zone">
                     Drag and drop a file here 
                   <h4>click to upload.</h4>
                    <img class="ic" src="img/cloud-computing.png" alt="">
                    <input type="file" name="file" id="file" accept=".pdf,.doc,.docx,.pptx" hidden required>
                    <p class="file-name" id="file-name">No file selected</p>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Upload</button>
            </div>
        </form>

        <?php
include("../Connection/dbconnection.php");

if (isset($_POST['submit'])) {
    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    $allowed_extensions = ['pdf', 'doc', 'docx', 'pptx'];
    $max_file_size = 5 * 1024 * 1024;

    if (!in_array($file_ext, $allowed_extensions)) {
        showAlert('Only PDF, DOC, DOCX, and PPTX files are allowed.');
    } elseif ($file_size > $max_file_size) {
        showAlert('File size exceeds the maximum limit of 5MB.');
    } else {
        $folder_path = "uploads/$courseCode/$type";

        if (!is_dir($folder_path)) {
            if (!mkdir($folder_path, 0777, true)) {
                die("Failed to create folder.");
            }
        }

        $file_path = $folder_path . '/' . basename($file_name);

        // Check if the file name already exists in the database
        $checkQuery = "SELECT * FROM files WHERE FileName = '$file_name' AND FolderName = '$courseCode/$type'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            showAlert('A file with this name already exists. Please rename your file or upload a different one.');
        } else {
            if (move_uploaded_file($file_tmp, $file_path)) {
                $sam = $courseCode . '/' . $type;

                try {
                    $insertQuery = "INSERT INTO files (FileName, FilePath, FolderName, UploaderID) 
                                    VALUES ('$file_name', '$file_path', '$sam', '$studentId')";

                    $insertResult = mysqli_query($conn, $insertQuery);

                    if ($insertResult) {
                        showAlert('File uploaded successfully. Thank you!');
                        // Redirect after successful upload
                        echo "<script>setTimeout(function() { window.location.href = 'QuestionBankDasboard.php'; }, 4000);</script>";
                        exit();
                    } else {
                        showAlert('Something went wrong during file upload.');
                    }
                } catch (Exception $e) {
                    showAlert('Something went wrong during the database operation.');
                }
            } else {
                showAlert('Something went wrong during file upload.');
            }
        }
    }
}

$conn->close();
?>

    </div>

    <script>
        const dropZone = document.getElementById('drop-zone');
        const fileInput = document.getElementById('file');
        const fileNameDisplay = document.getElementById('file-name');

        dropZone.addEventListener('click', () => fileInput.click());

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('dragover');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('dragover');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('dragover');

            if (e.dataTransfer.files.length) {
                const file = e.dataTransfer.files[0];
                const allowedExtensions = ["pdf", "doc", "docx", "pptx"];
                const fileExt = file.name.split(".").pop().toLowerCase();

                if (!allowedExtensions.includes(fileExt)) {
                    alert('Invalid file type.');
                } else {
                    fileInput.files = e.dataTransfer.files;
                    fileNameDisplay.textContent = file.name;
                }
            }
        });

        fileInput.addEventListener('change', () => {
            const file = fileInput.files[0];
            if (file) {
                fileNameDisplay.textContent = file.name;
            } else {
                fileNameDisplay.textContent = 'No file selected';
            }
        });
    </script>
</body>
<?php include_once "../Header/Footer.php"; ?>

</html>
