<?php
include 'dbconnect.php';

if (isset($_GET['token'])) {
    $token = mysqli_real_escape_string($conn, $_GET['token']);
    $result = mysqli_query($conn, "SELECT * FROM user WHERE verification_code = '$token' AND is_verified = 0");

    if (mysqli_num_rows($result) == 1) {
        // Perbarui status verifikasi
        mysqli_query($conn, "UPDATE user SET is_verified = 1 WHERE verification_code = '$token'");
        echo "Email Anda berhasil diverifikasi! Silakan login.";
    } else {
        echo "Token tidak valid atau sudah diverifikasi sebelumnya.";
    }
} else {
    echo "Token verifikasi tidak ditemukan.";
}
?>
