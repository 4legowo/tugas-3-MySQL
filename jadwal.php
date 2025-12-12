<?php
include 'koneksi.php';
$stmt = $pdo->query("
    SELECT b.*, l.nama_lapangan 
    FROM bookings b
    JOIN lapangan l ON b.id_lapangan = l.id_lapangan
    ORDER BY b.tanggal_booking DESC, b.jam_mulai ASC
");
$bookings_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Jadwal Booking</title>
    <href="styles.css" rel="stylesheet">
</head>
<body>
    <h1>Jadwal Booking Lapangan</h1>
    <p><a href="index.php">Kembali ke Daftar Lapangan</a></p>

    <table>
        <thead>
            <tr>
                <th>ID Booking</th>
                <th>Nama Pemesan</th>
                <th>Lapangan</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Status Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bookings_data as $booking): ?>
                <tr>
                    <td><?php echo htmlspecialchars($booking['id_booking']); ?></td>
                    <td><?php echo htmlspecialchars($booking['nama_pemesan']); ?></td>
                    <td><?php echo htmlspecialchars($booking['nama_lapangan']); ?></td>
                    <td><?php echo htmlspecialchars($booking['tanggal_booking']); ?></td>
                    <td>
                        <?php 
                        $waktu_mulai = new DateTime($booking['jam_mulai']);
                        $waktu_selesai = new DateTime($booking['jam_selesai']);
                        echo $waktu_mulai->format('H:i') . ' - ' . $waktu_selesai->format('H:i');
                        ?>
                    </td>
                    <td>
                        <?php
                        $status = htmlspecialchars($booking['status_pembayaran'])
                        if ($status == 'lunas') {
                            echo '<span class="status-lunas">' . $status . '</span>';
                        } elseif ($status == 'pending') {
                            echo '<span class="status-pending">' . $status . '</span>';
                        } else {
                            echo '<span class="status-batal">' . $status . '</span>';
                        }
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        console.log("Halaman jadwal booking dimuat.");
    </script>
</body>
</html>
