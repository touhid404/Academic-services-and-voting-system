<?php
include("../Connection/dbconnection.php");


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
$sName = "";
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $seats[] = $row;
        if (empty($sessionName)) { // Save the session name only once
            $sName = $row['session_name'];
        }
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
            background-color: #f4f4f9;
        }

        h2 {
            margin-top: 10px;
            color: #333;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 10px;
        }

        label {
            font-size: 18px;
            margin-right: 10px;
        }

        select {
            padding: 15px 30px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 5px;
        }

        #seatsDiagram {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 10px;
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
            border: 1px solid #ccc;
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
            background-color: #16a085;
            transform: scale(1.1);
        }

        .seat.filled {
            background-color: #ff4d4d;
            color: white;
            cursor: not-allowed;
        }

        .aisle {
            visibility: hidden;
            width: 50px;
            height: 50px;
        }

        .legend {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 20px;
            font-size: 12px;
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

        #selected-seat-input {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        input[type="text"] {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 150px;
            text-align: center;
        }

        input[type="text"]:disabled {
            background-color: #f0f0f0;
            color: #333;
        }
    </style>
</head>

<body>
    <h2>Bus Seat Plan</h2>
    <div class="container">
        <div>
            <label for="selected-route">Select Route:</label>
            
            <select name="selected-route" id="selected-route"class="s-f" required>
                <option value="">Select a route</option>
                <?php foreach ($Rseats as $s): ?>
                    <option value="<?php echo htmlspecialchars($s['route_id']); ?>">
                        <?php echo htmlspecialchars($s['route_id']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="selected-floor">Select Floor:</label>
            <select name="selected-floor" id="selected-floor" class="s-f">
                <option value="1">1st Floor</option>
                <option value="2">2nd Floor</option>
            </select>
        </div>
        <div id="filledSeatsCard">Filled Seats: <span style="color: red;">0</span></div>
        <div id="selected-seat-input">
            
            <label for="selected-seat">Selected Seat:</label>
            <input type="text" id="selected-seat" name="selected-seats" placeholder="None" readonly required>
        </div>
        <div id="seatsDiagram"></div>
        <div class="legend">
            <div><div class="box available"></div> Available</div>
            <div><div class="box filled"></div> Filled</div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const seatData = <?php echo json_encode($seats, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
            const routeSelector = document.getElementById('selected-route');
            const floorSelector = document.getElementById('selected-floor');
            const filledSeatsCard = document.getElementById('filledSeatsCard');
            const seatsDiagram = document.getElementById('seatsDiagram');
            const selectedSeatInput = document.getElementById('selected-seat');

            const floors = {
                1: Array.from({ length: 40 }, (_, i) => i + 1),
                2: Array.from({ length: 40 }, (_, i) => i + 41)
            };

            let currentFloor = 1;
            let selectedSeat = null;

            const renderSeats = () => {
                seatsDiagram.innerHTML = '';
                const layout = [
                    floors[currentFloor].slice(0, 10),
                    floors[currentFloor].slice(10, 20),
                    [],
                    floors[currentFloor].slice(20, 30),
                    floors[currentFloor].slice(30, 40)
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
                            seatDiv.addEventListener('click', () => handleSeatClick(seatNumber));
                            rowDiv.appendChild(seatDiv);
                        });
                    }

                    seatsDiagram.appendChild(rowDiv);
                });

                updateSeats();
            };

            const updateSeats = () => {
                const selectedRoute = routeSelector.value;

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

                filledSeatsCard.innerHTML = `Filled Seats: <span style="color: red;">${filledCount}</span>`;
            };

            const handleSeatClick = (seatNumber) => {
                const selectedSeatElement = document.getElementById(`seat-${seatNumber}`);

                if (selectedSeatElement && !selectedSeatElement.classList.contains('filled')) {
                    if (selectedSeat === seatNumber) {
                        selectedSeat = null;
                        selectedSeatInput.value = "None";
                        selectedSeatElement.style.backgroundColor = "#1abc9c";
                    } else {
                        if (selectedSeat !== null) {
                            const prevSelectedElement = document.getElementById(`seat-${selectedSeat}`);
                            if (prevSelectedElement) {
                                prevSelectedElement.style.backgroundColor = "#1abc9c";
                            }
                        }
                        selectedSeat = seatNumber;
                        selectedSeatInput.value = seatNumber;
                        selectedSeatElement.style.backgroundColor = "#2c3e50";
                    }
                }
            };

            routeSelector.addEventListener('change', () => {
                selectedSeat = null;
                selectedSeatInput.value = "None";
                renderSeats();
            });

            floorSelector.addEventListener('change', () => {
                currentFloor = parseInt(floorSelector.value, 10);
                renderSeats();
            });

            renderSeats();
        });
    </script>
</body>

</html>
