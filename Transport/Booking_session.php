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
    <title>Time Form</title>
    <style>
          @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap");
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        form {
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 30px;
            width: 100%;
            max-width: 550px;
            box-sizing: border-box;
        }

        h2 {
            text-align: center;
            color: #444;
            margin-bottom: 20px;
        }

        label {
            font-size: 16px;
            color: #555;
            margin-bottom: 8px;
            display: block;
        }

        input {
            width: 100%;
            padding: 12px 15px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
            background: #f9f9f9;
        }

        input:focus {
            outline: none;
            border-color: #2c3e50;
            box-shadow: 0 0 5px rgba(106, 17, 203, 0.5);
        }

        button {
            background-color: #2c3e50;
            color: white;
            padding: 14px 20px;
            margin-top: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 50%;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        button:hover {
            background-color: #2575fc;
        }

        @media (max-width: 600px) {
            form {
                padding: 20px;
                width: 90%;
            }

            h2 {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <form action="SessionProcess.php" method="post">
        <h2>Enter the session's start and end times.</h2>
        <label for="s_name">Set Session Name</label>
        <input type="text" id="s_name" name="s_name" placeholder="Enter session name" required>

        <label for="start_time">Start Time</label>
        <input type="time" id="start_time" name="start_time" required>

        <label for="end_time">End Time</label>
        <input type="time" id="end_time" name="end_time" required>

        <button type="submit">Submit</button>
    </form>
</body>

</html>