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
include_once "../Header/StudentHeader.php";
include("../Connection/dbconnection.php");

$deadlinePassed = false;
$titleOfVote = '';
$deadline = "No deadline available";

try {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST['titleOfVote'])) {
            $titleOfVote = htmlspecialchars($_POST['titleOfVote']);

           
            $deadlineQuery = "SELECT deadline FROM vote_details WHERE titleOfVote = ?";
            $stmt = $conn->prepare($deadlineQuery);
            $stmt->bind_param("s", $titleOfVote);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $deadline = $row['deadline'];
                date_default_timezone_set('Asia/Dhaka');

                $currentDateTime = date("Y-m-d H:i:s");

                // Check if the deadline has passed
                if ($currentDateTime > $deadline) {
                    $deadlinePassed = true;
                }
            } else {
                $deadline = "No deadline found";
            }
        }

        if (!$deadlinePassed && isset($_POST["register"])) {
            $confirm = $_POST['Confirm'];

            if ($confirm !== 'confirm') {
                echo "<script>
                alert('Please type \"confirm\" to proceed.');
                </script>";
            } else {
                $studentId = htmlspecialchars($_POST["studentId"]);
                $fname = htmlspecialchars($_POST["name"]);

                $checkQuery = "SELECT * FROM candidate_data WHERE candidateId = ? AND titleOfVote = ?";
                $stmt = $conn->prepare($checkQuery);
                $stmt->bind_param("ss", $studentId, $titleOfVote);
                $stmt->execute();
                $checkResult = $stmt->get_result();

                if ($checkResult && $checkResult->num_rows > 0) {
                    echo "<script>alert('You have already applied for this vote.');</script>";
                    echo "<script>setTimeout(function() { window.location.href = 'VoteTopics.php'; }, 1000);</script>";
                } else {
                    // Insert 
                    $insertQuery = "INSERT INTO candidate_data (candidateId, name, titleOfVote) VALUES (?, ?, ?)";
                    $stmt = $conn->prepare($insertQuery);
                    $stmt->bind_param("sss", $studentId, $fname, $titleOfVote);

                    if ($stmt->execute()) {
                        echo "<script>alert('Registration Successful');</script>";
                        echo "<script>setTimeout(function() { window.location.href = 'VoteTopics.php'; }, 500);</script>";
                    } else {
                        echo "<script>alert('An error occurred. Please try again.');</script>";
                        echo "<script>setTimeout(function() { window.location.href = 'VoteTopics.php'; }, 500);</script>";
                    }
                }
            }
        }
    }
} catch (Exception $e) {
    echo "<script>alert('An error occurred: " . $e->getMessage() . "');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap");

        body {
            font-family: "Poppins", sans-serif;
            background: #eeeeee;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        form {
            margin-top: 90px;
            background: #ffffff;
            padding: 20px;
            /* Reduced padding */
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        form h2 {
            text-align: center;
            margin-bottom: 15px;
            /* Reduced margin */
            color: #2c3e50;
            font-weight: 600;
        }

        form label {
           
            display: block;
            margin-bottom: 6px;
            
            color: #555;;
        }

        form input {
          
            
            width: 90%;
            padding: 10px;
            /* Reduced padding */
            margin-bottom: 15px;
            /* Reduced margin */
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background: #f9fafb;
            transition: border-color 0.3s;
            padding-left: 30px;
            font-weight: 600;
        }

        form button {
            background-color: #2c3e50;
            color: #ffffff;
            padding: 10px;
            /* Reduced padding */
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 50%;
            font-size: 14px;
            /* Reduced font size */
            font-weight: 500;
            
            transition: background-color 0.3s;
        }

        .deadline-warning {
            margin-top: -10px;
            /* Reduced margin */
            margin-bottom: 10px;
            /* Reduced margin */
            font-size: 12px;
            font-weight: bold;
            color: red;
            /* Smaller font size */
        }
        form button:disabled {
            background-color: #ddd;
            cursor: not-allowed;
        }

        .readonly {
            background-color: #e5e7eb;
        }
        footer {
            width: 100%;
            
            padding: 10px 0;
            position: relative;
            bottom: 0;
        }
    </style>
</head>

<body>
    <form method="POST">
        <h2>Apply for Candidate</h2>

        <label for="titleOfVote">Title of Vote</label>
        <input type="text" name="titleOfVote" value="<?php echo htmlspecialchars($titleOfVote); ?>" class="readonly" readonly>

        <?php
        $datetimeObj = new DateTime($deadline);
        $formattedDate = $datetimeObj->format('F d, Y h:i A');
        ?>

        <label for="deadline">Deadline</label>
        <input type="text" name="deadline" value="<?php echo htmlspecialchars($formattedDate); ?>" class="readonly" readonly>

        <?php if ($deadlinePassed): ?>
            <p class="deadline-warning">The deadline has passed. You cannot register.</p>
        <?php endif; ?>

        <label for="studentId">Your Student ID</label>
        <input type="text" name="studentId" value="<?php echo htmlspecialchars($studentId); ?>" class="readonly" <?php echo $deadlinePassed ? 'disabled' : ''; ?> readonly>

        <label for="name">Your Name as a candidate</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($stname); ?>" class="readonly" <?php echo $deadlinePassed ? 'disabled' : ''; ?> readonly>

        <label for="Confirm">Confirm Please</label>
        <input type="text" name="Confirm" placeholder="Type 'confirm' to proceed" <?php echo $deadlinePassed ? 'disabled' : ''; ?> required>

        <button type="submit" name="register" <?php echo $deadlinePassed ? 'disabled' : ''; ?>>Register</button>
    </form>
</body>

<footer>
<?php include_once "../Header/Footer.php"; ?>
</footer>


</html>