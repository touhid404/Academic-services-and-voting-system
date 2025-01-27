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
        echo "<script>
        alert('Error: Only PDF, DOC, DOCX, and PPTX files are allowed.');
        
      location.assign('UploadQuestion.php');
      </script>";
       
    } elseif ($file_size > $max_file_size) {
        echo "<script>
        alert('Error: File size exceeds the maximum limit of 5MB.');
        
      location.assign('UploadQuestion.php');
      </script>";
    } else {
        $folder_path = "uploads/$courseCode/$type";

        if (!is_dir($folder_path)) {
            if (!mkdir($folder_path, 0777, true)) {

                echo "<script>
                alert('Error: Failed to create folder');
                
              location.assign('UploadQuestion.php');
              </script>";
            }
        }

        $file_path = $folder_path . '/' . basename($file_name);

        if (move_uploaded_file($file_tmp, $file_path)) {
            $sam = $courseCode . '/' . $type;

            try {
                $insertQuery = "INSERT INTO files (FileName, FilePath, FolderName, UploaderID) 
                        VALUES ('$file_name', '$file_path', '$sam', '$studentId')";

                $insertResult = mysqli_query($conn, $insertQuery);

                if ($insertResult) {
                    
                    echo "<script>
                    alert('File uploaded successfully. Thank you!');
                    
                  location.assign('UploadQuestion.php');
                  </script>";
                    
                    // echo "<script>setTimeout(function() { window.location.href = 'QuestionBankDasboard.php'; }, 4000);</script>";
                    exit();
                } else {
                    echo "<script>
                    alert('Something went wrong during file upload.');
                    
                  location.assign('UploadQuestion.php');
                  </script>";
                   
                }
            } catch (Exception $e) {
                echo "<script>
                alert('Something went wrong during file upload.');
                
              location.assign('UploadQuestion.php');
              </script>";
            }
        } else {
            echo "<script>
            alert('Something went wrong during file upload.');
            
          location.assign('UploadQuestion.php');
          </script>";
        }
    }
}

$conn->close();
