<?php
// Include database connection
include("../Connection/dbconnection.php");

// Start session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);

    // Prepared statement to check if email exists
    $query = "SELECT * FROM student_data WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Generate reset token
        $resetToken = bin2hex(random_bytes(50)); // Generate a secure token
        $_SESSION['Code'] = $resetToken;

  

        // Send reset email (you can implement your own email function or use a service like PHPMailer)
        $resetLink = "http://yourdomain.com/reset-password.php?token=" . $resetToken;
        $subject = "Password Reset Request";
        $message = "Click the link to reset your password: " . $resetLink;
        $headers = "From: no-reply@yourdomain.com";

        if (mail($email, $subject, $message, $headers)) {
            showAlert('Password reset link sent to your email.', 'success');
        } else {
            showAlert('Failed to send password reset email. Please try again later.', 'error');
        }

    } else {
        showAlert('No account found with that email address.', 'error');
    }
}

function showAlert($message, $type)
{
    echo "<script>
        document.addEventListener('DOMContentLoaded', () => {
            const alertContainer = document.createElement('div');
            alertContainer.id = 'alertMessage';
            
            // Apply base styles
            alertContainer.style.position = 'fixed';
            alertContainer.style.top = '20px';
            alertContainer.style.left = '50%';
            alertContainer.style.transform = 'translateX(-50%)';
            alertContainer.style.zIndex = '9999';
            alertContainer.style.padding = '10px 20px';
            alertContainer.style.borderRadius = '5px';
            alertContainer.style.boxShadow = '0px 4px 6px rgba(0,0,0,0.2)';
            alertContainer.style.fontSize = '17px';
            alertContainer.style.color = 'white';
            alertContainer.style.opacity = '0';
            alertContainer.style.transition = 'opacity 0.5s ease, top 0.5s ease';
            
            // Set alert type-specific styles
            if ('$type' === 'success') {
                alertContainer.style.backgroundColor = '#28a745'; // Green
            } else if ('$type' === 'error') {
                alertContainer.style.backgroundColor = '#dc3545'; // Red
            } else if ('$type' === 'info') {
                alertContainer.style.backgroundColor = '#007bff'; // Blue
            }
            
            alertContainer.textContent = '$message';
            document.body.appendChild(alertContainer);
            
            // Display and animate the alert
            setTimeout(() => {
                alertContainer.style.opacity = '1'; // Fade in
                alertContainer.style.top = '40px'; // Slightly move down
            }, 0);
            
            // After 2 seconds, fade out and remove the alert
            setTimeout(() => {
                alertContainer.style.opacity = '0'; // Fade out
                alertContainer.style.top = '20px'; // Reset position
                setTimeout(() => alertContainer.remove(), 1000); // Remove after fade-out
            }, 2000);
        });
    </script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap");

        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(120deg, #f8fafc, #bcccdc, #a6b4c1);
            overflow: hidden;
            position: relative;
        }

        /* Dynamic 3D effect */
        body::before,
        body::after {
            content: "";
            position: absolute;
            width: 450px;
            height: 450px;
            border-radius: 50%;
            background: radial-gradient(circle, #d9eafd, #9aa6b2, #b4d6e8);
            animation: float 6s ease-in-out infinite;
            z-index: -2;
            pointer-events: none;
        }

        body::before {
            top: -100px;
            left: -150px;
            animation-duration: 5s;
        }

        body::after {
            bottom: -100px;
            right: -150px;
            animation-duration: 6s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(30px);
            }
        }

        /* Login form */
        form {
            position: relative;
            background-color: #e3f2fd;
            padding: 30px 30px;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 440px;
            z-index: 1;
        }

        h1 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 2rem;
            color: #2c3e50;
        }

        label {
            display: block;
            margin-bottom: 12px;
            font-weight: 600;
            color: #2c3e50;
        }

        input {
            width: 410px;
            padding: 14px;
            margin-bottom: 20px;
            border: 1px solid #d9eafd;
            border-radius: 12px;
            font-size: 1rem;
            background-color: #f8fafc;
        }

        input:focus {
            outline: none;
            border-color: #9aa6b2;
            box-shadow: 0 0 8px rgba(154, 166, 178, 0.8);
        }

        button {
            width: 410px;
            padding: 14px;
            background-color: #34495e;
            color: #ffffff;
            font-size: 1rem;
            font-weight: 600;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out, transform 0.2s ease;
        }

        button:hover {
            background-color: #4e9e9a;
            transform: scale(1.05);
        }

        p {
            text-align: center;
            font-size: 0.9rem;
            color: #2c3e50;
        }

        p a {
            color: black;
            text-decoration: none;
            font-weight: 600;
        }

        p a:hover {
            text-decoration: underline;
        }

        .alert {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
            border: 1px solid #f5c6cb;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>

<body>

    <!-- Forget Password Form -->
    <form action="" method="POST">
        <h1>Forget Password</h1>
        <label for="email">Enter your Email:</label>
        <input type="email" name="email" id="email" placeholder="Enter your email address" required>
        <button type="submit" name="submit">Send Reset Link</button>
        <p>Remember your password? <a href="loginForm.php">Login now</a></p>
    </form>

    <footer>
        <div class="alert" id="alertMessage" style="display: none;"></div>
    </footer>

</body>

</html>
