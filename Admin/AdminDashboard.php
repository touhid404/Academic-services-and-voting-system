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
$sql = "SELECT studentId, topic, description FROM feedbacks";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
          @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap");
        /* Global Styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #eeeeee;
        }

        h1 {
            margin-top: 90px;
            text-align: center;
            margin-top: 40px;
            font-size: 2.2em;
            font-weight: 600;
            color: #2e3d49;
            text-transform: uppercase;
            margin-top: 90px;
        }

        /* Dashboard Container */
        .dashboard-container {
            max-width: 1300px;
            margin: 0 auto;
            padding: 30px;
        }

        /* Feedback Cards */
        .feedback-cards {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .card {
            background-color: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            padding: 30px;
            width: 320px;
            border-radius: 12px;
            transition: transform 0.3s, box-shadow 0.3s;
            background: linear-gradient(135deg, #f7f8f9 0%, #e0e4e8 100%);
            border-left: 8px solid #3e64ff;
        }

        .card:hover {
            transform: translateY(-12px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
        }

        .card h3 {
            font-size: 1.4em;
            color: #3e64ff;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .card p {
            color: #595959;
            font-size: 1em;
            line-height: 1.7;
            margin-bottom: 15px;
            letter-spacing: 0.5px;
        }

        .card strong {
            color: #3e64ff;
        }

        /* No Feedback Found */
        .no-feedback {
            text-align: center;
            font-size: 1.2em;
            color: #999;
            margin-top: 40px;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .feedback-cards {
                flex-direction: column;
                align-items: center;
            }
        }

    </style>
</head>
<body>

    <div class="dashboard-container">
        <h1>Feedback Dashboard</h1>
        
        <div class="feedback-cards">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="card">';
                    echo '<h3>Student ID: ' . $row["studentId"] . '</h3>';
                    echo '<p><strong>Topic:</strong> ' . $row["topic"] . '</p>';
                    echo '<p><strong>Description:</strong> ' . $row["description"] . '</p>';
                    echo '</div>';
                }
            } else {
                echo '<div class="no-feedback">No feedback available.</div>';
            }
            ?>
        </div>
    </div>

</body>
</html>
