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

if (isset($_POST['dates']) && !empty($_POST['dates'])) {
    $_SESSION['selectedDates'] = $_POST['dates']; 
    $notice = isset($_POST['notice']) ? $_POST['notice'] : "Regular day"; 

    $dates = $_POST['dates']; 
    $success = true; 

    foreach ($dates as $date) {
        $stmt = $conn->prepare("INSERT INTO bus_routine (date, notice) VALUES (?, ?)");
        $stmt->bind_param("ss", $date, $notice);

        if (!$stmt->execute()) {
            echo "Error inserting date: " . $stmt->error;
            $success = false;
        }
    }

    // Clear session data after insertion
    unset($_SESSION['selectedDates']);
    $stmt->close();
    $conn->close();

    if ($success) {
        echo "Booking successfully added"; // Success message
    }
    exit; 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Multiple Dates</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap");
        body {

            font-family: 'Poppins', sans-serif;

            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 45%;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 90%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-group button {
            padding: 10px 20px;
            background-color:#2c3e50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 10px;
            font-size: 16px;
        }

        .form-group button:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="container">
    <h2>Select Bus Schedule Dates for Your Upcoming Days</h2>

        <div class="form-group">
            <label for="dates">Select Dates:</label>
            <input type="text" id="dates" name="dates[]" placeholder="Select dates">
        </div>
        <div class="form-group">
            <label for="notice">Notice (Optional):</label>
            <input type="text" id="notice" name="notice" placeholder="Enter notice (optional)">
        </div>
        <div class="form-group">
            <button id="submitBtn" type="button">Submit</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
       
        flatpickr("#dates", {
            mode: "multiple",
            dateFormat: "Y-m-d", // Define date format
            disableMobile: true, 
        });

        
        $("#submitBtn").click(function() {
            var selectedDates = $("#dates").val().split(" ");
            var notice = $("#notice").val(); // Get the notice input value

            if (selectedDates.length > 0) {
                $.ajax({
                    url: "", 
                    method: "POST",
                    data: {
                        dates: selectedDates,
                        notice: notice || "Regular day"
                    }, 
                    success: function(response) {
                        alert('Booking successfully added');
                        $("#dates").val(""); 
                        $("#notice").val(""); 
                    },
                    error: function() {
                        alert("Error submitting the dates.");
                    }
                });
            } else {
                alert("Please select at least one date.");
            }
        });
    </script>

</body>

</html>