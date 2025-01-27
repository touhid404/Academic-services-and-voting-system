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
date_default_timezone_set('Asia/Dhaka');
$current_time = date('H:i:s');
$todaydate = date("Y-m-d"); // Current date
$current_time = date("H:i:s"); // Current time
$current_datetime = "$todaydate $current_time";

// Fetch booked seats
$seats = [];
$query = "SELECT s.route_id, s.seat_number  ,s.session_name FROM seats s
           JOIN booking_session bs ON s.session_name = bs.session_name
              WHERE (
            -- Case 1: Starting and ending times are on the same day
            STR_TO_DATE(CONCAT('$todaydate ', bs.starting_time), '%Y-%m-%d %H:%i:%s') <= '$current_datetime'
            AND STR_TO_DATE(CONCAT('$todaydate ', bs.ending_time), '%Y-%m-%d %H:%i:%s') > '$current_datetime'
        ) OR (
            -- Case 2: Session spans midnight (ending time is on the next day)
            STR_TO_DATE(CONCAT('$todaydate ', bs.starting_time), '%Y-%m-%d %H:%i:%s') <= '$current_datetime'
            AND STR_TO_DATE(CONCAT(DATE_ADD('$todaydate', INTERVAL 1 DAY), bs.ending_time), '%Y-%m-%d %H:%i:%s') > '$current_datetime'
            AND bs.ending_time < bs.starting_time
        )";


$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
   
    while ($row = $result->fetch_assoc()) {
        $seats[] = $row;
       
    }
}

// Fetch available routes
$Rseats = [];
$query = "SELECT route_id FROM routes";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $Rseats[] = $row;
    }
}



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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Seat Plan</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap");

        body {
            font-family: 'Poppins', sans-serif;
            text-align: center;
            background: #eeeeee;
        }

        h2 {
            color: #333;
        }

        .container {

            background-color: #fff;
            margin: 80px auto;
            max-width: 1000px;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 90px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);

        }

        label {
            font-size: 18px;
            margin-right: 10px;
        }

        select,
        button {
            padding: 8px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 5px;
            cursor: pointer;
        }

        #seatsDiagram {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-top: 20px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .seat {
            color: white;
            width: 45px;
            height: 45px;
            text-align: center;
            border: 2px solid #ccc;
            border-radius: 10px;
            background-color: #1abc9c;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            position: relative;
            transition: background-color 0.3s, transform 0.2s;
        }

        .seat:hover {
            background-color: #2c3e50;
            transform: scale(1.1);
        }

        .seat.filled {
            background-color: #ff4d4d;
            color: white;
            cursor: not-allowed;
        }

        .aisle {
            visibility: hidden;
            width: 25px;
            height: 25px;
        }

        .legend {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 20px;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .legend div {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .legend .box {
            width: 20px;
            height: 20px;
            border-radius: 5px;
        }

        .legend .available {
            background-color: #1abc9c;
            border: 1px solid #ccc;
        }

        .legend .filled {
            background-color: #ff4d4d;
        }

        #filledSeatsCard {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        #toggle-floor {
            margin-left: 10px;
            width: 170px;
            background-color: #2c3e50;
            /* Green */
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 13px;
            border-radius: 10px;
            transition: background-color 0.3s ease;
        }

        #toggle-floor:hover {
            background-color: blueviolet;
        }

        #toggle-floor:active {
            background-color: #2c3e50;
        }

        .a {
            display: flex;
            align-items: center;
        }

        .timesUp{
            width: 400px;
            height: 400px;
        }
        .sn{
            font-size:16px;
           margin: 10px;
        }
    </style>
</head>

<body>

    <?php if ($booking_session): ?>
        <div class="container">
            <h2>Bus Seat Plan</h2>
          
            <div class="a">
          
                <label for="selected-route">Select Route:</label>
                <select name="selected-route" id="selected-route" required>
                    <option value="">Select a route to see seats fill</option>
                    <?php foreach ($Rseats as $s): ?>
                        <option value="<?php echo htmlspecialchars($s['route_id']); ?>">
                            <?php echo htmlspecialchars($s['route_id']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div>
                    <button id="toggle-floor" data-current="1">Switch to 2nd Floor</button>
                </div>
            </div>

            <div id="filledSeatsCard">Filled Seats: <span style="color: red;">0</span></div>
            <div id="seatsDiagram"></div>
            <div class="legend">
                <div>
                    <div class="box available"></div> Available
                </div>
                <div>
                    <div class="box filled"></div> Filled
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="container">
            <h2>Booking is not available at the moment</h2>
            <p>Please try again during the booking session time.</p>
            <img class="timesUp" src="img/timesup.jpg" alt="">
        </div>
    <?php endif; ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const seatData = <?php echo json_encode($seats); ?>;
            const routeSelector = document.getElementById('selected-route');
            const filledSeatsCard = document.getElementById('filledSeatsCard');
            const seatsDiagram = document.getElementById('seatsDiagram');
            const toggleFloorBtn = document.getElementById('toggle-floor');

            const floors = {
                1: Array.from({
                    length: 40
                }, (_, i) => i + 1),
                2: Array.from({
                    length: 40
                }, (_, i) => i + 41)
            };

            let currentFloor = 1;

            const renderSeats = () => {
                seatsDiagram.innerHTML = '';
                const layout = [
                    floors[currentFloor].slice(0, 10), // First row
                    floors[currentFloor].slice(10, 20), // Second row
                    [], // Aisle
                    floors[currentFloor].slice(20, 30), // Third row
                    floors[currentFloor].slice(30, 40) // Fourth row
                ];

                layout.forEach(row => {
                    const rowDiv = document.createElement('div');
                    rowDiv.className = 'row';

                    if (row.length === 0) {
                        const aisleDiv = document.createElement('div');
                        aisleDiv.className = 'aisle';
                        rowDiv.appendChild(aisleDiv);
                    } else {
                        row.forEach(seatNumber => {
                            const seatDiv = document.createElement('div');
                            seatDiv.className = 'seat';
                            seatDiv.id = `seat-${seatNumber}`;
                            seatDiv.textContent = seatNumber;
                            rowDiv.appendChild(seatDiv);
                        });
                    }

                    seatsDiagram.appendChild(rowDiv);
                });

                updateSeats();
            };

            const updateSeats = () => {
                const selectedRoute = routeSelector.value;

                // Reset all seats
                document.querySelectorAll('.seat').forEach(seat => {
                    seat.classList.remove('filled');
                    seat.style.backgroundColor = '';
                    seat.removeAttribute('title');
                });

                let filledCount = 0;
                seatData.forEach(seat => {
                    if (seat.route_id == selectedRoute) {
                        const seatElement = document.getElementById('seat-' + seat.seat_number);
                        if (seatElement) {
                            seatElement.classList.add('filled');
                            seatElement.style.backgroundColor = '#ff4d4d';
                            seatElement.setAttribute('title', 'This seat is already booked');
                            filledCount++;
                        }
                    }
                });

                // Update filled seats count
                filledSeatsCard.innerHTML = `Filled Seats: <span style="color: red;">${filledCount}</span>`;
            };

            routeSelector.addEventListener('change', updateSeats);

            toggleFloorBtn.addEventListener('click', () => {
                currentFloor = currentFloor === 1 ? 2 : 1;
                toggleFloorBtn.textContent = currentFloor === 1 ? 'Switch to 2nd Floor' : 'Switch to 1st Floor';
                renderSeats();
            });

            // Initial render
            renderSeats();
        });
    </script>
</body>
<?php include_once "../Header/Footer.php"; ?>

</html>