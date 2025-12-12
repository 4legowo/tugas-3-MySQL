<?php
include 'koneksi.php';

$stmt = $pdo->query("SELECT * FROM lapangan");
$lapangan_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Lapangan</title>
    <href="styles.css" rel="stylesheet">
</head>
<body>
    <h1>Daftar Lapangan</h1>
    <p><a href="jadwal.php">Lihat Jadwal Booking</a></p>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Lapangan</th>
                <th>Lokasi</th>
                <th>Harga per Jam</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lapangan_data as $lapangan): ?>
                <tr>
                    <td><?php echo htmlspecialchars($lapangan['id_lapangan']); ?></td>
                    <td><?php echo htmlspecialchars($lapangan['nama_lapangan']); ?></td>
                    <td><?php echo htmlspecialchars($lapangan['lokasi']); ?></td>
                    <td>Rp <?php echo number_format($lapangan['harga_per_jam'], 0, ',', '.'); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>