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
include_once "../Header/StudentHeader.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard Calendar</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;700&display=swap");

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #eeeeee;
        }

        .calendar-container {
            margin-top: 90px;
            background: #eeeeee;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            height: 500px;
            max-width: 1000px;
            padding: 20px;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .calendar-header h2 {
            font-size: 1.5rem;
            margin: 0;
        }

        .calendar-header button {
            background: #2c3e50;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }

        .calendar-header button:hover {
            background: #0056b3;
        }

        .days-of-week {
            display: flex;
            background: #2c3e50;
            color: #fff;
            padding: 10px;
            border-radius: 5px 5px 0 0;
        }

        .days-of-week div {
            flex: 1;
            text-align: center;
            font-weight: bold;
        }

        .dates {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
            padding: 10px;
        }

        .dates div {
            text-align: center;
            padding: 5px;
            border-radius: 50px;
            cursor: pointer;
            width: 70px;
            height: 50px;
            display: flex;
            font-weight: 600;
            justify-content: center;
            align-items: center;
        }

        .dates div:hover {
            background: #2c3e50;
            color: white;
        }

        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
            background: #fff;
            padding: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 400px;
        }

        .modal-content {
            position: relative;
        }

        .modal-content h2 {
            color: #2c3e50;
            text-align: center;
        }

        .modal-content p {
            text-align: center;
            
        }

        .modal-content textarea {
            
            resize: none;
            width: 95%;
            margin-top: 10px;
            padding: 5px;
            border: 1px solid #ccc;
            background-color: transparent;
            border-radius: 10px;
            font-size: 15px;
            color: black;
            text-align: justify;
        }

        #close-modal {
            position: absolute;
            background-color: #2c3e50;
            top: 5px;
            right: 10px;
            cursor: pointer;
            font-size: 1rem;
            color: white;
            font-weight: bold;
            padding: 10px;
            border-radius: 20px;
            transition: transform 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        #close-modal:hover {
            transform: scale(1.1);
        }

        .note-badge {
            color: red;
            font-size: 18px;
            margin-top: 5px;
        }

        .bus-image {
            width: 25px;
            height: 25px;
            cursor: pointer;
        }

        .current-date {
            background-color: rebeccapurple;
            color: white;
            font-weight: bold;
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
    <div class="calendar-container">
        <div class="calendar-header">
            <button id="prev">❮</button>
            <h2 id="month-year"></h2>
            <button id="next">❯</button>
        </div>
        <div class="calendar">
            <div class="days-of-week">
                <div>Sun</div>
                <div>Mon</div>
                <div>Tue</div>
                <div>Wed</div>
                <div>Thu</div>
                <div>Fri</div>
                <div>Sat</div>
            </div>
            <div class="dates" id="calendar-dates"></div>
        </div>
    </div>

    <!-- Modal for Notes -->
    <div id="note-modal" class="modal">
        <div class="modal-content">
            <span id="close-modal">OK</span>
            <form action="Note.php" method="POST">
                <h2>Important notice</h2>
                <p id="selected-date"></p>
                <textarea id="note-text" name="note" rows="5" readonly></textarea>
            </form>
        </div>
    </div>

    <footer>
    <?php include_once "../Header/Footer.php"; ?>

        
    </footer>

    <script src="TSD.js"></script>
</body>

</html>
