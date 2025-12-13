?php
session_start(); 
include 'koneksi.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $field_option = $_POST['field_option'];
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $booking_date = $_POST['booking_date'];
    $booking_time = $_POST['booking_time'];

    if (empty($field_option) || empty($user_name) || empty($email) || empty($booking_date) || empty($booking_time)) {
        $_SESSION['notification'] = "Error: Semua kolom harus diisi.";
        $_SESSION['notification_type'] = "danger";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['notification'] = "Error: Format email tidak valid.";
        $_SESSION['notification_type'] = "danger";
    } else {
        $stmt = $conn->prepare("INSERT INTO bookings (field_option, user_name, email, booking_date, booking_time) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $field_option, $user_name, $email, $booking_date, $booking_time);

        if ($stmt->execute()) {
            $_SESSION['notification'] = "Booking berhasil! Data Anda telah disimpan.";
            $_SESSION['notification_type'] = "success";
        } else {
            $_SESSION['notification'] = "Error: " . $stmt->error;
            $_SESSION['notification_type'] = "danger";
        }
        $stmt->close();
    }
    
    $conn->close();
} else {
    $_SESSION['notification'] = "Error: Akses tidak valid.";
    $_SESSION['notification_type'] = "danger";
}

header("Location: booking.php");
exit();
?>