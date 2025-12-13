<?php
session_start(); // Mulai session di awal halaman
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Booking Lapangan</title>
    <href="styles.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Form Booking Lapangan</h2>

        <?php
        // Tampilkan notifikasi jika ada
        if (isset($_SESSION['notification'])) {
            $alert_class = ($_SESSION['notification_type'] == 'success') ? 'alert-success' : 'alert-danger';
            echo '<div class="alert ' . $alert_class . '">' . $_SESSION['notification'] . '</div>';
            // Hapus session notifikasi setelah ditampilkan
            unset($_SESSION['notification']);
            unset($_SESSION['notification_type']);
        }
        ?>

        <form action="proses_booking.php" method="POST">
            <div class="form-group">
                <label for="field_option">Pilihan Lapangan:</label>
                <select id="field_option" name="field_option" required>
                    <option value="">-- Pilih Lapangan --</option>
                    <option value="Lapangan A">Lapangan A</option>
                    <option value="Lapangan B">Lapangan B</option>
                    <option value="Lapangan C">Lapangan C</option>
                </select>
            </div>

            <div class="form-group">
                <label for="user_name">Nama User:</label>
                <input type="text" id="user_name" name="user_name" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="booking_date">Tanggal Booking:</label>
                <input type="date" id="booking_date" name="booking_date" required>
            </div>

            <div class="form-group">
                <label for="booking_time">Jam Booking:</label>
                <input type="time" id="booking_time" name="booking_time" required>
            </div>

            <button type="submit">Booking Sekarang</button>
        </form>
    </div>
</body>
</html>