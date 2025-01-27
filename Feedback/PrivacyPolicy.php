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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy</title>
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
            width: 100%;
            max-width: 600px;
            height: 500px;
            padding: 30px 20px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: scroll;
        }

        .modal h2 {
            font-size: 24px;
            color: #34495e;
            margin-bottom: 20px;
        }

        .modal p {
            font-size: 16px;
            color: #7f8c8d;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .modal .btn-close {
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

        .modal .btn-close:hover {
            background-color: #c0392b;
        }
    </style>
</head>

<body>
    <div class="modal-background" id="modalBackground">
        <div class="modal" id="Modal">
            <!-- Close button inside the modal -->
            <button type="button" class="btn-close" onclick="closeModal()">X</button>
            <h2>Privacy Policy</h2>
            <p>
                Your privacy is important to us. This Privacy Policy explains how we collect, use, and protect your personal information when you use our website.
            </p>
            <p>
                <strong>1. Information We Collect:</strong> We may collect your name, email address, department, and profile picture to enhance your user experience and provide personalized features.
            </p>
            <p>
                <strong>2. Use of Information:</strong> The information collected is used solely for providing the intended services, improving user experience, and communicating important updates or features.
            </p>
            <p>
                <strong>3. Data Protection:</strong> We implement appropriate technical and organizational measures to safeguard your personal information from unauthorized access, alteration, or disclosure.
            </p>
            <p>
                <strong>4. Third-Party Sharing:</strong> We do not share your personal information with third parties unless required by law or with your explicit consent.
            </p>
            <p>
                <strong>5. Your Rights:</strong> You have the right to access, update, or delete your personal information. If you have any questions or concerns about your data, please contact us.
            </p>
            <p>
                By using this website, you agree to the terms outlined in this Privacy Policy. We reserve the right to update this policy as needed.
            </p>
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
