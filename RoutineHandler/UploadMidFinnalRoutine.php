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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Routine Import</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: #eeeeee;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            margin-top: 90px;
            background-color: white;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }

        h2 {
            text-align: center;
            font-size: 28px;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        form {
            margin-bottom: 30px;
            text-align: center;
        }

        form label {
            font-size: 18px;
            font-weight: 700;
            color: #34495e;
            display: block;
            margin-bottom: 10px;
        }

        form input[type="file"],
        form input[type="text"] {
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            width: 300px;
            margin-bottom: 10px;
            font-size: 16px;
        }

        form input[type="submit"],
        form button {
            padding: 12px 24px;
            border: none;
            background-color: #3498db;
            color: white;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        form input[type="submit"]:hover,
        form button:hover {
            background-color: #2980b9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #2c3e50;
            color: white;
            font-size: 18px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .no-data {
            text-align: center;
            color: #e74c3c;
            font-size: 18px;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- File Upload Form -->
        <form method="POST" action="SaveMidOrFinal.php">
            <label for="text">Enter text to write mid/final:</label>
            <input type="text" name="textM" placeholder="Enter file name" required>
            <button type="submit">Save Text</button>
        </form>
        <form method="post" action="import.php" enctype="multipart/form-data">
            <label for="file">Select a CSV File:</label>
            <input type="file" name="excel_file" id="file" accept=".csv" required>
            <input type="submit" name="import" value="Import">
        </form>
        <form method="post" onsubmit="confirmDelete(event)">
        <button type="submit" name="delete">Delete All Data</button>
    </form>

        <!-- Display Table -->
        <h2>Exam Routine</h2>
        <table>
            <tr>
                <th>Department</th>
                <th>Course Code</th>
                <th>Course Title</th>
                <th>Section</th>
                <th>Teacher</th>
                <th>Exam Date</th>
                <th>Exam Time</th>
                <th>Room</th>
            </tr>

            <?php
            // Database connection
            $db = mysqli_connect('localhost', 'root', '', 'MyProject');

            // Check connection
            if (!$db) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Fetch all data from 'routine' table
            $query = "SELECT * FROM MidFinalroutine";
            $result = mysqli_query($db, $query);

            // Check if data exists
            if (mysqli_num_rows($result) > 0) {
                while ($data = mysqli_fetch_assoc($result)) {
            ?>
                    <tr>
                        <td><?= htmlspecialchars($data['Dept']) ?></td>
                        <td><?= htmlspecialchars($data['CourseCode']) ?></td>
                        <td><?= htmlspecialchars($data['CourseTitle']) ?></td>
                        <td><?= htmlspecialchars($data['Section']) ?></td>
                        <td><?= htmlspecialchars($data['Teacher']) ?></td>
                        <td><?= htmlspecialchars($data['ExamDate']) ?></td>
                        <td><?= htmlspecialchars($data['ExamTime']) ?></td>
                        <td><?= htmlspecialchars($data['Room']) ?></td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='8' class='no-data'>No data available</td></tr>";
            }

            // Close the database connection
            mysqli_close($db);
            ?>
        </table>
    </div>
</body>

</html>
<?php
// Database connection
$servername = "localhost"; // Replace with your server name
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "MyProject"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the button is clicked
if (isset($_POST['delete'])) {
    $sql = "DELETE FROM MidFinalroutine"; // Replace 'your_table_name' with the name of your table

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Success: All data deleted successfully.');
                
             
              </script>";
    } else {
       
        echo "<script>
                alert('Error: Could not delete data.');
                
           
              </script>";
    }
}

// Close the connection
$conn->close();
?>
