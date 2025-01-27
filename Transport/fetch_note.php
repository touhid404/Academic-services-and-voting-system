<?php
header('Content-Type: application/json');
include("../Connection/dbconnection.php");

$date = $_GET['date'];

$stmt = $conn->prepare("SELECT notice FROM bus_routine WHERE date = ?");
$stmt->bind_param("s", $date);
$stmt->execute();
$stmt->bind_result($note);
$stmt->fetch();

echo json_encode(["note" => $note]);

$stmt->close();
$conn->close();
?>
