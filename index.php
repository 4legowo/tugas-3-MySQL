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

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Booking</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Jadwal Booking</h1>
        <p>Kembali ke <a href="index.php">Daftar Lapangan</a></p>

        <table>
            <thead>
                <tr>
                    <th>ID Booking</th>
                    <th>Nama Pemesan</th>
                    <th>Lapangan</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings_data as $booking): ?>
                <tr>
                    <td><?php echo $booking['id_booking']; ?></td>
                    <td><?php echo $booking['nama_pemesan']; ?></td>
                    <td><?php echo $booking['nama_lapangan']; ?></td>
                    <td><?php echo date('d-m-Y', strtotime($booking['tanggal_booking'])); ?></td>
                    <td><?php echo date('H:i', strtotime($booking['jam_mulai'])) . ' - ' . date('H:i', strtotime($booking['jam_selesai'])); ?></td>
                    <td>
                        <?php
                        $status = $booking['status_pembayaran'];
                        if ($status == 'lunas') {
                            echo '<span class="status-lunas">' . ucfirst($status) . '</span>';
                        } elseif ($status == 'menunggu') {
                            echo '<span class="status-menunggu">' . ucfirst($status) . '</span>';
                        } else {
                            echo '<span class="status-batal">' . ucfirst($status) . '</span>';
                        }
                        ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>