<?php
session_start();

if (
    isset($_SESSION['studentId']) &&
    isset($_SESSION['studentName']) &&
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
        location.assign('../Login_Page/LoginForm.php');
    </script>
<?php
}

include("../Connection/dbconnection.php");
include_once "../Header/StudentHeader.php";
if (!isset($_SESSION['redirectUrl'])) {
    $_SESSION['redirectUrl'] = $_SERVER['HTTP_REFERER'] ?? '../HomePage/HomePage.php';
}

$redirectUrl = $_SESSION['redirectUrl'];
// $redirectUrl = $_SERVER['HTTP_REFERER'] ?? '../HomePage/HomePage.php'; // Fallback to homepage if referrer is unavailable

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['feedback'])) {
    $feedback = mysqli_real_escape_string($conn, $_POST['feedback']);
    $topic = mysqli_real_escape_string($conn, $_POST['topic']);

    $insertFeedbackQuery = "INSERT INTO feedbacks (studentId, topic, description) VALUES ('$studentId', '$topic', '$feedback')";

    if (mysqli_query($conn, $insertFeedbackQuery)) {
        echo "<script>
                alert('Feedback submitted successfully!');
                window.location.href = '$redirectUrl';
              </script>";
        exit;
    } else {
        echo "<script>alert('Failed to submit feedback. Please try again.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap");

        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            
        }

        body {
            background: #f4f6f9;
        }

        .modal-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .modal {
            background: #fff;
            border-radius: 12px;
            width: 100%;
            max-width: 600px;
            padding: 30px 20px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .modal h2 {
            font-size: 24px;
            color: #34495e;
            margin-bottom: 20px;
        }

        .modal p {
            font-size: 14px;
            color: #7f8c8d;
            margin-bottom: 20px;
        }

        .feedback-form label {
            display: block;
            text-align: left;
            font-size: 14px;
            margin-bottom: 6px;
            color: #2c3e50;
        }

        .feedback-form input[type="text"],
        .feedback-form textarea {
            width: 90%;
            padding: 10px 12px;
            margin: 0 15px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            outline: none;
        }

        .feedback-form textarea {
            resize: none;
        }

        .feedback-form .btn-submit {
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 12px 20px;
            cursor: pointer;
            font-size: 16px;
        }

        .feedback-form .btn-submit:hover {
            background-color: #2980b9;
        }

        .btn-cancel {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: #e74c3c;
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 18px;
        }

        .btn-cancel:hover {
            background-color: #c0392b;
        }
    </style>
</head>

<body>
    <div class="modal-background" id="modalBackground">
        <div class="modal" id="Modal">
            <!-- Close button inside the modal -->
            <button type="button" class="btn-cancel" onclick="closeModal()">X</button>
            <form method="POST" action="" class="feedback-form">
                <h2>Submit Your Feedback</h2>
                <p>We value your feedback. Please share your thoughts below.</p>

                <!-- Topic Input -->
                <label for="topic">Feedback Topic</label>
                <input type="text" id="topic" name="topic" placeholder="Enter the topic of your feedback" required>

                <!-- Feedback Textarea -->
                <label for="feedback">Your Feedback</label>
                <textarea id="feedback" name="feedback" rows="5" placeholder="Write your feedback here..." required></textarea>

                <button type="submit" class="btn-submit">Submit Feedback</button>
            </form>
        </div>
    </div>

    <script>
        function closeModal() {
            // Redirect back to the referring page
            window.location.href = "<?php echo $redirectUrl; ?>";
        }

        document.getElementById("Modal").addEventListener("click", function(event) {
            event.stopPropagation();
        });
    </script>
</body>

</html>
