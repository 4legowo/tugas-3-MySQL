<?php
include 'koneksi.php'; 
$sql = "SELECT b.*, l.nama_lapangan FROM bookings b JOIN lapangan l ON b.id_lapangan = l.id_lapangan ORDER BY b.tanggal_booking DESC, b.jam_mulai ASC";
$result = mysqli_query($koneksi, $sql);
$bookings_data = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);
mysqli_close($koneksi);
?>
