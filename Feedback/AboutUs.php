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
    <title>About Us</title>
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
            opacity: 0; /* Initially hidden */
            visibility: hidden; /* Hidden */
            transition: opacity 0.3s ease, visibility 0s linear 0.3s; /* Animation for fade-in */
        }

        .modal {
            background: #fff;
            border-radius: 12px;
            width: 100%;
            max-width: 600px;
            padding: 30px 20px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            position: relative;
            opacity: 0; /* Initially hidden */
            transform: scale(0.8); /* Starts from zoomed out */
            transition: opacity 0.3s ease, transform 0.3s ease; /* Animation for zoom-in and fade-in */
        }

        .modal.open {
            opacity: 1;
            transform: scale(1); /* Final zoomed-in size */
        }

        .modal-background.open {
            opacity: 1; /* Fade-in */
            visibility: visible; /* Make visible */
            transition: opacity 0.3s ease, visibility 0s linear 0s; /* Fade-in */
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
            text-align: justify;
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
            <h2>About Us</h2>
            <p>
                Welcome to our website! This platform was built with PHP, HTML, CSS, and JavaScript.
            </p>

            <p>
                If you have any questions or suggestions, feel free to reach out through email. 
                <a 
                    href="https://mail.google.com/mail/?view=cm&fs=1&to=touhid435r@gmail.com&su=Collaboration&body=Hello,%20I%27d%20like%20to%20reach%20out%20for%20a%20collaboration."
                    target="_blank" 
                    rel="noopener noreferrer"
                >
                    Contact Now
                </a>
            </p>

            <p>
                Thank you for visiting, and we hope you find this platform helpful and engaging!
                <br>
                <br>
                <span style="color: black; font-weight: bold;">Touhidul, Hriti</span>
            </p>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById("modalBackground").classList.add("open");
            document.getElementById("Modal").classList.add("open");
        }

        function closeModal() {
            document.getElementById("modalBackground").classList.remove("open");
            document.getElementById("Modal").classList.remove("open");

            // Redirect back to the referring page
            setTimeout(function() {
                window.location.href = "<?php echo $redirectUrl; ?>";
            }, 300); // Delay the redirection until the animation finishes
        }

        document.getElementById("Modal").addEventListener("click", function(event) {
            event.stopPropagation();
        });

        // Open the modal when the page loads
        window.onload = openModal;
    </script>
</body>

</html>
