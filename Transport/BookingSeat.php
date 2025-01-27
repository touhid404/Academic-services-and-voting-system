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
include_once "../Header/StudentHeader.php";
include("../Connection/dbconnection.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings</title>


    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap");



        body {
            font-family: 'Poppins';
            background: #eeeeee;

        }

        .container11 {


            margin-top: 90px;
            margin-bottom: 100px;

        }

        .head {
            text-align: center;
            margin-bottom: 20px;
        }

        #booking-results {
            margin: 0px auto;
            background-color: #ffffff;
            max-width: 1100px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 100px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .table th,
        .table td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .table th {
            background-color: #2c3e50;
            color: #ffffff;
        }

        .table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table tr:hover {
            background-color: #f1f1f1;
        }

        .btn {
            background-color: #2c3e50;
            color: #ffffff;
            padding: 10px 15px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        .btn-cancel {
            background-color: #e74c3c;
        }

        .btn-cancel:hover {
            background-color: #c0392b;
        }

        .modal-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            display: none;
            z-index: 999;
        }

        .btn-cancel {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #e74c3c;
            color: #ffffff;
            padding: 5px 10px;
            font-size: 14px;
            font-weight: bold;
            border: none;
            border-radius: 12px;
            cursor: pointer;
        }

        .btn-cancel:hover {
            background-color: #c0392b;
        }

        .modal {
            height: auto;
            max-height: 70vh;
            width: 700px;
            position: relative;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            text-align: center;
            display: none;
            z-index: 1000;
            overflow-y: auto;
            /* Allows scrolling */
        }

        .modal.show {
            display: block;
        }

        .modal-background.show {
            display: block;
        }

        .modal h2 {
            font-size: 22px;
            color: #2c3e50;
            margin-bottom: 15px;
        }

        .booking-form {
            margin: 0 auto;
            background: #fff;
            border-radius: 8px;
            width: 600px;
            padding: 20px;
        }

        .booking-form h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
            text-align: center;
        }

        .booking-form label {
            text-align: center;

            font-size: 14px;
            color: #555;
            margin-bottom: 8px;
            display: block;
        }

        .booking-form input,
        .booking-form select {
            width: 40%;
            padding: 15px;

            margin-bottom: 15px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 30px;
            font-weight: 600;
            font-size: 17px;
        }

        .booking-form select {
            border-radius: 10px;
            padding: 10px;
            font-weight: 500;
            width: 100%;
            margin-left: 10px;
            appearance: none;
            background: #fff url('data:image/svg+xml;charset=US-ASCII,%3Csvg xmlns%3D%22http://www.w3.org/2000/svg%22 fill%3D%22%23000000%22 viewBox%3D%220 0 24 24%22%3E%3Cpath d%3D%22M7 10l5 5 5-5H7z%22/%3E%3C/svg%3E') no-repeat right 10px center;
            background-size: 12px;
        }

        .booking-form .btn {
            background-color: #2c3e50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
            text-align: center;
        }

        .booking-form .btn:hover {
            background-color: #0056b3;
        }

        .modal-buttons {
            text-align: center;
        }

        .delete-btn {

            background-color: red;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-weight: bold;
            border-radius: 10px;
            transition: background-color 0.3s ease;
        }

        .nobus {
            font-size: 25px;
            padding: 15px;
        }

        .no-bookings {
            text-align: center;
            padding: 10px;
            background-color: #ffffff;
            width: 600px;
            margin: 0 auto;
            border-radius: 10px;
        }
    </style>


</head>


<body>

    <?php
    // Check already booked or not and bus have or not
    $hasBustoday = false;
    $HasBookAlready = false;
    $booking_session = false;
    date_default_timezone_set('Asia/Dhaka');
    $today = date("Y-m-d");
    $current_time = date('H:i:s');


    // SQL query to get the bookings of the student
    $resultSql = "SELECT * FROM `bookings` 
                  WHERE student_id = '$studentId' AND booking_created = '$today'
                    ORDER BY booking_created DESC";

    $resultSqlResult = mysqli_query($conn, $resultSql);


    // Check if the bus is available for today
    $sql = "SELECT * FROM bus_routine WHERE date = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $today);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check the result
    if ($result->num_rows > 0) {
        $hasBustoday = true;
    }


    date_default_timezone_set('Asia/Dhaka');
    $todaydate = date("Y-m-d"); // Current date
    $current_time = date("H:i:s"); // Current time
    $current_datetime = "$todaydate $current_time"; // Combine date and time

    // SQL query to handle sessions spanning midnight
    $sql = "
        SELECT session_name 
        FROM booking_session 
        WHERE (
            -- Case 1: Starting and ending times are on the same day
            STR_TO_DATE(CONCAT('$todaydate ', starting_time), '%Y-%m-%d %H:%i:%s') <= '$current_datetime'
            AND STR_TO_DATE(CONCAT('$todaydate ', ending_time), '%Y-%m-%d %H:%i:%s') > '$current_datetime'
        ) OR (
            -- Case 2: Session spans midnight (ending time is on the next day)
            STR_TO_DATE(CONCAT('$todaydate ', starting_time), '%Y-%m-%d %H:%i:%s') <= '$current_datetime'
            AND STR_TO_DATE(CONCAT(DATE_ADD('$todaydate', INTERVAL 1 DAY), ending_time), '%Y-%m-%d %H:%i:%s') > '$current_datetime'
            AND ending_time < starting_time
        )
    ";

    $result = $conn->query($sql);

    $booking_session = false;
    $session_nameC = "";

    if ($result && $result->num_rows > 0) {
        $booking_session = true;

        // Fetch the session name
        $row = $result->fetch_assoc();
        $session_nameC = $row['session_name'];
    } else {
        $booking_session = false;
    }

    // Check if the student has already booked a seat in session already
    $sqlB = "SELECT * FROM bookings WHERE  student_id = ? AND booking_created = ? AND session_name = ?";
    $stmtb =  $conn->prepare($sqlB);
    $stmtb->bind_param("sss", $studentId, $today, $session_nameC);
    $stmtb->execute();
    $resultb = $stmtb->get_result();
    if ($resultb->num_rows > 0) {
        $HasBookAlready = true;
    }




    if (!mysqli_num_rows($resultSqlResult)) { ?>

        <div class="container11">
            <div class="no-bookings">
                <h1 class="alert-heading">No Bookings Found Yet</h1>
                

                <div>
                    <?php if ($hasBustoday && $booking_session): ?>
                        <button id="add-button" class="btn" onclick="openModal()">Booking now</button>
                    <?php else: ?>
                        <?php if (!$hasBustoday): ?>
                            <h2 class="nobus">No bus schedule available today.</h2>
                        <?php else: ?>
                            <h2 class="nobus">Booking session is not active at the moment</h2>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php } else { ?>

        <div class="container11">
            <section id="booking">

                <div id="booking-results">

                    <div>
                        <?php if ($hasBustoday && !$HasBookAlready && $booking_session): ?>
                            <button id="add-button" class="btn" onclick="openModal()">Booking now</button>
                        <?php else: ?>
                            <?php if (!$hasBustoday): ?>
                                <h2 class="nobus">No bus schedule available today.</h2>
                            <?php elseif ($HasBookAlready): ?>
                                <h2 class="nobus">You have already booked a seat.</h2>
                            <?php else: ?>
                                <h2 class="nobus">Booking session is not active at the moment.</h2>
                            <?php endif; ?>
                        <?php endif; ?>


                    </div>



                    <table class="table table-hover table-bordered">
                        <thead>
                            <th>Booking Id</th>
                            <th>Student Id</th>
                            <th>Route name</th>
                            <th>Seat no.</th>
                            <th>Booked Date</th>
                            <th>Booked time</th>
                            <th>Session</th>
                            <th>Action</th>

                        </thead>
                        <?php
                        while ($row = mysqli_fetch_assoc($resultSqlResult)) {
                            $id = $row["id"];
                            $student_id = $row["student_id"];
                            $route_id = $row["route_id"];

                            $pnr = $row["booking_id"];

                            $booked_seat = $row["booked_seat"];

                            $booked_timing = $row["booking_created"]; // Example: 2025-01-26
                            $booked_time = $row['booking_time']; // Example: 21:29:31

                            $formatted_date = date("M j, Y", strtotime($booked_timing)); // Example: Jan 26, 2025

                            // Format the time
                            $formatted_time = date("g:i A", strtotime($booked_time));



                            $session_name = $row["session_name"];


                        ?>
                            <tr>
                                <td>
                                    <?php
                                    echo $pnr;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $student_id;
                                    ?>
                                </td>


                                <td>
                                    <?php
                                    echo $route_id;
                                    ?>
                                </td>

                                <td>
                                    <?php
                                    echo $booked_seat;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $formatted_date;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $formatted_time;
                                    ?>
                                </td>

                                <td>
                                    <?php
                                    echo $session_name;
                                    ?>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <form method="POST" action="DeleteBooking.php">
                                            <input type="hidden" name="booking_id" value="<?php echo $row['booking_id']; ?>">
                                            <input type="hidden" name="route_id" value="<?php echo $row["route_id"]; ?>">
                                            <input type="hidden" name="student_id" value="<?php echo $row['student_id']; ?>">
                                            <input type="hidden" name="seat_number" value="<?php echo $row['booked_seat']; ?>">
                                            <button class="delete-btn" type="submit" name="delete_btn" onclick="return confirm('Are you sure you want to delete this file?');">Delete</button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </section>
        </div>
    <?php } ?>
    </div>

    <div class="modal-background" id="modalBackground">
        <div id="Modal" class="modal">
            <button type="button" class="btn-cancel" onclick="closeModal()">X</button>
            <form method="POST" action="BookingProcess.php" class="booking-form">
                <h2>Book Your Seat</h2>
                <label for="studentId">Student ID</label>
                <input type="text" style="border: none;" id="studentId" name="studentId" placeholder="Student ID" readonly>

                <input type="hidden" name="session_nameC" value="<?php echo $session_nameC; ?>">

                <label for="studentName">Student Name</label>
                <input type="text" style="border: none;" id="studentName" name="studentName" placeholder="Student Name" readonly>


                <?php include_once "ViewSeatsWhenBooking.php"; ?>

                <div class="modal-buttons">
                    <br>
                    <br>
                    <button type="submit" name="submit" class="btn">Confirm Now</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById("studentId").value = "<?php echo $studentId; ?>";
            document.getElementById("studentName").value = "<?php echo $stname; ?>";
            document.getElementById("modalBackground").classList.add("show");
            document.getElementById("Modal").classList.add("show");
        }

        function closeModal() {
            document.getElementById("modalBackground").classList.remove("show");
            document.getElementById("Modal").classList.remove("show");
        }

        // Prevent the modal click from closing the background
        document.getElementById("Modal").addEventListener("click", function(event) {
            event.stopPropagation();
        });
    </script>
    </main>
</body>
<br>
<br>
<br>
<br>
<br>
<?php include_once "../Header/Footer.php"; ?>

</html>