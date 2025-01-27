<?php
include("../Connection/dbconnection.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get the booking_id from POST
    $booking_id = $_POST['booking_id'];
    $route_id = $_POST['route_id'];
    $student_id = $_POST['student_id'];
    $seat_number = $_POST['seat_number'];

    
    $deleteBooking = "DELETE FROM bookings WHERE booking_id = '$booking_id'";
    $deleteSeats ="DELETE FROM seats WHERE route_id = '$route_id' AND seat_number = '$seat_number' AND booked_by = '$student_id'";

    if (mysqli_query($conn, $deleteBooking) &&mysqli_query($conn,$deleteSeats)) {
        header("Location: BookingSeat.php");
    }
} else {
    header("Location: BookingSeat.php");
}
