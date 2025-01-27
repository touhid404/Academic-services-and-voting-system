<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Include the database connection file
    include("../Connection/dbconnection.php");

    // Function to generate a random booking ID
    function generateBookingId($length = 5)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $bookingId = '';
        for ($i = 0; $i < $length; $i++) {
            $bookingId .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $bookingId;
    }

    // Generate a unique booking ID
    do {
        $bookingId = generateBookingId();
        $checkQuery = "SELECT booking_id FROM bookings WHERE booking_id = '$bookingId'";
        $checkResult = mysqli_query($conn, $checkQuery);
    } while (mysqli_num_rows($checkResult) > 0); // Repeat until a unique ID is found

    // Get the form data
    $studentId = mysqli_real_escape_string($conn, $_POST['studentId']);
    $routeId = mysqli_real_escape_string($conn, $_POST['selected-route']);
    $SeatNumber = mysqli_real_escape_string($conn, $_POST['selected-seats']);
    $session_nameC = mysqli_real_escape_string($conn, $_POST['session_nameC']);

    if ($SeatNumber == 'None') {
        echo "<script>
        alert('Error: Select seats before confirm');
        location.assign('BookingSeat.php'); 
      </script>";
        exit;
    }


    // Insert the data into the bookings table
    $bookingInsertQuery = "INSERT INTO bookings (booking_id, student_id, route_id, booked_seat, booking_created,session_name) 
                               VALUES ('$bookingId', '$studentId', '$routeId',  '$SeatNumber', NOW(),'$session_nameC')";

    if (mysqli_query($conn, $bookingInsertQuery)) {
        // Insert the data into the seats table
        $seatInsertQuery = "INSERT INTO seats (route_id, seat_number, booked_by,session_name) 
                                VALUES ('$routeId','$SeatNumber','$studentId','$session_nameC')";

        if (mysqli_query($conn, $seatInsertQuery)) {
            echo "<script>
                        alert('Booking successfully added! Your Booking ID is $routeId');
                        location.assign('BookingSeat.php'); 
                      </script>";
        } else {
            echo "<script>
                        alert('Error: Could not update the seats table. Please try again later.');
                        location.assign('BookingSeat.php'); 
                      </script>";
        }
    } else {
        echo "<script>
                    alert('Error: Could not add the booking. Please try again later.');
                    location.assign('BookingSeat.php'); 
                  </script>";
    }

    mysqli_close($conn);
}
