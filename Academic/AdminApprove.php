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

}else{
    ?>
    <script>
        location.assign('../Login_Page/LoginForm.php')
    </script>
<?php
}
include_once "../Header/AdminHeader.php";
include("../Connection/dbconnection.php");

// Fetch PDF files from database
$sql = "SELECT FileName, FilePath , FolderName ,UploaderId, Approve FROM files ";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Files</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: #eeeeee;
        }

        header {
            margin-top: 80px;
            text-align: center;
            /* background: linear-gradient(to right, orange, purple); */
            /* background: linear-gradient(to right, #ff7f50, #6a5acd); */
            padding: 3px;


        }


        h2 {
            font-size: 25px;
            text-align: center;
            color: black;
        }

        table {
            width: 90%;
            margin: 30px auto;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        table th,
        table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #2c3e50;
            color: white;

        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        a {
            color: #0066cc;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #004c99;
        }

        button {
            background-color: #2c3e50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        .no-files-card {
            margin: 30px auto;
            background: linear-gradient(to right, #ff4b2b, #ff416c);
            color: white;
            padding: 20px;
            width: 250px;
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

<body>
    <header>
        <h2>Administrator Panel: Question Approval Section</h2>
    </header>


    <!-- Reusable Alert Message -->


    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Filename</th>
                    <th>Uploader ID</th>
                    <th>Folder Name</th>
                    <th>Approve Status</th>
                    <th>Approve?</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><a href="<?php echo $row['FilePath']; ?>" target="_blank"><?php echo $row['FileName']; ?></a></td>
                        <td><?php echo $row["UploaderId"] ?></td>
                        <td><?php echo $row["FolderName"] ?></td>
                        <td><?php echo $row['Approve']; ?></td>
                        <td>
                            <form method="POST" action="ChangeStatus.php">
                                <input type="hidden" name="file_id" value="<?php echo $row['FilePath']; ?>" />
                                <button type="submit" name="approve_file" onclick="return confirm('Are you sure you want to approve this file?');">Approve</button>
                            </form>
                        </td>
                        
                        <td>
                            <div class="action-buttons">
                                <form method="POST" action="ChangeStatus.php">
                                    <input type="hidden" name="file_path" value="<?php echo $row['FilePath']; ?>" />
                                    <button type="submit" name="delete_file" onclick="return confirm('Are you sure you want to delete this file?');">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="no-files-card">
            No PDFs found in the database 😔
        </div>

    <?php endif; ?>


</body>

</html>
