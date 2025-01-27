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

        * {
            font-family: 'Poppins';
        }
        body{
            background: #eeeeee;
        }

        .container11 {

            display: flex;
            justify-content: center;
            margin-top: 80px;


        }

        .head {
            text-align: center;
            margin-bottom: 20px;
        }

        #booking-results {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .table {
            width: 1200px;
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

        /* Add this to the existing style block */
        .table td.route-info {
            font-size: 12px;
            /* Smaller font size */
            word-wrap: break-word;
            /* Ensure text breaks into multiple lines */
            white-space: normal;
            /* Allow text to wrap */
            max-width: 180px;
            /* Set a max-width to prevent text from stretching too far */
        }

        .btn {
            background-color: #2c3e50;
            color: #ffffff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
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
            border-radius: 12px;
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
            text-align: left;
            margin-left: 110px;
            font-size: 14px;
            color: #555;
            margin-bottom: 8px;
            display: block;
        }

        .booking-form input,
        .booking-form select,
        textarea {
            width: 60%;
            padding: 10px;
            padding-left: 30px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .booking-form select {
            width: 68%;
            margin-left: 10px;
            appearance: none;
            background: #fff url('data:image/svg+xml;charset=US-ASCII,%3Csvg xmlns%3D%22http://www.w3.org/2000/svg%22 fill%3D%22%23000000%22 viewBox%3D%220 0 24 24%22%3E%3Cpath d%3D%22M7 10l5 5 5-5H7z%22/%3E%3C/svg%3E') no-repeat right 10px center;
            background-size: 12px;
        }

        .booking-form .btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
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
    </style>


</head>

<body>

    <?php
    $resultSql = "SELECT * FROM `booking_session` 
                    ORDER BY id ASC";

    $resultSqlResult = mysqli_query($conn, $resultSql);

    if (!mysqli_num_rows($resultSqlResult)) { ?>
        <div class="container11">
            <div id="noCustomers" class="alert alert-dark " role="alert">
                <h1 class="alert-heading">No Sessions Found!!</h1>
                <p class="fw-light"> Add one!</p>
                <hr>
                <div>
                    <button id="add-button" class='btn' onclick="openModal()">Add now</button>
                </div>
            </div>
        </div>
    <?php } else { ?>

        <div class="container11">
            <section id="booking">
                <div id="head" class="head">
                    <h2>Route Status</h2>
                </div>
                <div id="booking-results">
                    <div>
                        <button id="add-button" class='btn' onclick="openModal()">Add now</button>
                    </div>
                    <table class="table table-hover table-bordered">
                        <thead>

                            <th>Session name</th>
                            <th>Strating time</th>
                            <th>Ending time</th>
                            <th>Action</th>

                        </thead>
                        <?php
                        while ($row = mysqli_fetch_assoc($resultSqlResult)) {
                            $id = $row["id"];

                            $session_name = $row["session_name"];
                            $starting_time = $row["starting_time"];
                            $ending_time = $row["ending_time"];
                            $dateTime = new DateTime($starting_time);
                            $sTime = $dateTime->format('g:i A');
                            $dateTime = new DateTime($ending_time);
                            $eTime = $dateTime->format('g:i A');



                        ?>
                            <tr>
                                <td>
                                    <?php
                                    echo $session_name;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $sTime;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $eTime;
                                    ?>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <form method="POST" action="DeleteSession.php">

                                            <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">

                                            <button class="delete-btn" type="submit" name="delete_btn">Delete</button>
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
            <form method="POST" action="AddSessionProcess.php" class="booking-form">
                <h2>Add a Session</h2>

                <!-- Session Name -->
                <label for="sessionName">Session Name</label>
                <input type="text" id="sessionName" name="sname" placeholder="Enter Session Name" required>

                <!-- Starting Time -->
                <label for="startTime">Starting Time</label>
                <input type="time" id="startTime" name="sTime" required>

                <!-- Ending Time -->
                <label for="endTime">Ending Time</label>
                <input type="time" id="endTime" name="eTime" required>
                <div class="modal-buttons">
                    <br><br>
                    <button type="submit" class="btn">Yes, Confirm</button>
                </div>
            </form>

        </div>
    </div>

    <script>
        function openModal() {
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

</html>