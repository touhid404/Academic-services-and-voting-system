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

$uploads_dir = 'uploads';
include("../Connection/dbconnection.php");

$type = $_GET['type'] ?? '';
$courseName = urldecode($_GET['courseName'] ?? '');
$courseCode = urldecode($_GET['courseCode'] ?? '');
$cardColor = urldecode($_GET['cardColor'] ?? '');


// Define the folder path
$folder_path = $uploads_dir . '/' . $courseCode . '/' . $type;

// Check if the folder exists, and show a message if it does not
if (!is_dir($folder_path)) {
    $folder_exists = false; // Folder does not exist
} else {
    $folder_exists = true;
}

// Function to recursively scan files in a directory
function getAllFiles($dir)
{
    $files = [];
    $items = array_diff(scandir($dir), ['..', '.']);
    foreach ($items as $item) {
        $path = $dir . '/' . $item;
        if (is_dir($path)) {
            $files = array_merge($files, getAllFiles($path));
        } else {
            $files[] = $path;
        }
    }
    return $files;
}

// If folder exists, get all files
if ($folder_exists) {
    $all_files = getAllFiles($folder_path);
} else {
    $all_files = []; // If folder does not exist, set as empty array
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload System - All Files</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

        body {
            font-family: "Poppins", sans-serif;
            background: #eeeeee;


        }

        .header {

            width: 835px;
            margin: 0 auto;
            text-align: center;
            color: white;
            margin-top: 90px;
            border-radius: 10px;

        }

        .banner {
            font-size: 22px;
            font-weight: bold;
        }

        .subtitle {
            font-weight: bold;
            font-size: 18px;
            margin-top: 5px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        /* Card container */
        .file-container {
            background-color: #FFFFFF;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            padding: 20px;
            max-width: 800px;
            margin: 30px auto;
            border-radius: 10px;
            position: relative;
        }

        .file-card {
            width: 320px;
            color: white;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }

        /* Center odd cards */
        .file-card:last-child:nth-child(odd) {
            grid-column: span 2;
            margin-left: auto;
            margin-right: auto;
        }

        .file-card:hover {
            transform: scale(1.05);
        }



        .file-card span {
            display: block;
            font-size: 16px;
            margin-bottom: 10px;
            font-weight: 600;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
        }

        /* View button */
        .view {
            display: inline-block;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 8px 12px;
            border-radius: 10px;
            text-decoration: none;
            margin-bottom: 5px;
        }

        .view:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        /* Download button */
        .download-btn {
            margin-left: 5px;
            display: inline-block;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 8px 12px;
            border-radius: 10px;
            text-decoration: none;
        }

        .download-btn:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        /* No files message card */
        .no-files-card {
            position: relative;
            margin: 0 auto;
            color: white;
            padding: 20px;
            height: 200px;
            width: 760px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<header class="header">
    <div class="banner"><?php echo htmlspecialchars($type) ?></div>
    <div class="subtitle"><?php echo htmlspecialchars($courseName);  ?></div>
    <div class="subtitle"><?php echo htmlspecialchars($courseCode);  ?></div>
</header>

<body>
    <style>
        .header {
            background: <?php echo htmlspecialchars($cardColor); ?>;
        }

        .file-card {
            background: <?php echo htmlspecialchars($cardColor); ?>;
        }

        .no-files-card {
            background: <?php echo htmlspecialchars($cardColor); ?>;
        }
    </style>



    <div class="file-container">
        <?php if (!$folder_exists || empty($all_files)): ?>
            <!-- No files available or folder does not exist -->
            <div class="no-files-card">
                No questions are available right now. Please check back a little later 😔
            </div>
        <?php else: ?>
            <!-- Files available -->
            <?php
            $hasApprovedFiles = false; // Flag to track if any approved files exist
            foreach ($all_files as $file):
                $sql = "SELECT Approve FROM files WHERE FilePath = '$file'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $approve = $row['Approve'];


                if ($approve === "yes"):
                    $hasApprovedFiles = true;
                    $file_name = pathinfo($file, PATHINFO_FILENAME); // Get the file name without extension
            ?>
                    <div class="file-card">
                        <span><?php echo htmlspecialchars($file_name); ?></span>

                        <!-- Link to view the file if it's a PDF -->
                        <?php if (pathinfo($file, PATHINFO_EXTENSION) === 'pdf'): ?>
                            <a class="view" href="<?php echo htmlspecialchars($file); ?>" target="_blank">View</a>
                        <?php endif; ?>

                        <!-- Download button for all file types -->
                        <a href="<?php echo htmlspecialchars($file); ?>" download class="download-btn">
                            Download
                        </a>

                    </div>
                <?php
                endif;
            endforeach;

            if (!$hasApprovedFiles): // If no approved files are found
                ?>
                <div class="no-files-card">
                    No questions are approved right now. Please wait for admin approve 😔
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>


</body>

</html>