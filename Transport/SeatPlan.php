<?php
include("../Connection/dbconnection.php");

// Fetch booked seats
$seats = [];
$query = "SELECT route_id, seat_number FROM seats";
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

        h1 {
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
            padding: 8px;
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
            width: 50px;
            height: 50px;
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
            background-color: #1abc9c;
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
    </style>
</head>

<body>
    <h2>Bus Seat Plan</h2>
    <div class="container">
        <div>
            <label for="selected-route">Select Route:</label>
            <select name="selected-route" id="selected-route" required style="padding: 8px; font-size: 16px; width: 300px; margin-top: 10px;">
                <option value="">Select your route</option>
                <?php foreach ($Rseats as $s): ?>
                    <option value="<?php echo htmlspecialchars($s['route_id']); ?>">
                        <?php echo htmlspecialchars($s['route_id']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div id="filledSeatsCard">Filled Seats: <span style="color: red;">0</span></div>
        <div id="seatsDiagram">
            <?php
            $seatLayout = [
                range(1, 10), // First row
                range(11, 20), // Second row
                [], // Aisle
                range(21, 30), // Third row
                range(31, 40), // Fourth row
            ];

            foreach ($seatLayout as $row) {
                echo '<div class="row">';
                if (empty($row)) {
                    // Render aisle row
                    echo '<div class="aisle"></div>';
                } else {
                    foreach ($row as $seatNumber) {
                        echo "<div class='seat' id='seat-{$seatNumber}' data-name='{$seatNumber}'>{$seatNumber}</div>";
                    }
                }
                echo '</div>';
            }
            ?>
        </div>
        <div>
            <br>
            <label for="selected-seats">Selected Seat:</label>
            <input type="text"name="selected-seats" id="selected-seats" placeholder="Your seat number" readonly style="padding: 8px;padding-left:30px; font-size: 16px; width: 200px; margin-top: 10px;">
        </div>
        <div class="legend">
            <div><div class="box available"></div> Available Seat</div>
            <div><div class="box filled"></div> Filled Seat</div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const seatData = <?php echo json_encode($seats); ?>;
            const routeSelector = document.getElementById('selected-route');
            const filledSeatsCard = document.getElementById('filledSeatsCard');
            const selectedSeatsInput = document.getElementById('selected-seats');
            let selectedSeat = null;

            routeSelector.addEventListener('change', function () {
                const selectedRoute = this.value;

                // Reset all seats
                document.querySelectorAll('.seat').forEach(seat => {
                    seat.classList.remove('filled');
                    seat.style.backgroundColor = '';
                    seat.removeAttribute('title');
                });

                // Reset selected seat
                selectedSeat = null;
                selectedSeatsInput.value = '';

                // Highlight filled seats for the selected route
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
            });

            // Handle single seat selection
            document.querySelectorAll('.seat').forEach(seat => {
                seat.addEventListener('click', function () {
                    if (!seat.classList.contains('filled')) {
                        // Deselect the previously selected seat
                        if (selectedSeat) {
                            const prevSeatElement = document.getElementById('seat-' + selectedSeat);
                            if (prevSeatElement) prevSeatElement.style.backgroundColor = '#1abc9c';
                        }

                        // Select the new seat
                        const seatNumber = this.getAttribute('data-name');
                        selectedSeat = seatNumber;
                        this.style.backgroundColor = '#00bfff'; // Highlight selected seat
                        selectedSeatsInput.value = seatNumber;
                    }
                });
            });
        });
    </script>
</body>

</html>
