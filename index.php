<?php
include 'koneksi.php';
header('Content-Type: application/json');

$response = [];

$sql_lapangan = "SELECT * FROM lapangan";
$result_lapangan = $conn->query($sql_lapangan);
$lapangan_list = [];
while($row = $result_lapangan->fetch_assoc()) {
    $lapangan_list[] = $row;
}

$today = date('Y-m-d');
$sql_booking = "SELECT * FROM booking WHERE tanggal_booking = '$today' AND status = 'dipesan'";
$result_booking = $conn->query($sql_booking);
$booking_list = [];
while($row = $result_booking->fetch_assoc()) {
    $booking_list[] = $row;
}

$response['lapangan'] = $lapangan_list;
$response['booking'] = $booking_list;

echo json_encode($response);

$conn->close();
?>

