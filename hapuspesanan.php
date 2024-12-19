<?php
session_start();
require 'config.php'; // Pastikan Anda memiliki file koneksi.php untuk koneksi database

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID pesanan dari URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Siapkan dan bind
    $stmt = $conn->prepare("DELETE FROM pesanan WHERE id = ?");
    
    if ($stmt === false) {
        die("Error in prepare statement: " . $conn->error);
    }

    // Bind parameter
    $stmt->bind_param("i", $id);

    // Eksekusi pernyataan
    if ($stmt->execute()) {
        // Pesanan berhasil dihapus
        $_SESSION['message'] = "Pesanan berhasil dibatalkan.";
    } else {
        $_SESSION['message'] = "Error: " . $stmt->error;
    }

    // Tutup koneksi
    $stmt->close();
    $conn->close();
}

// Redirect kembali ke halaman riwayat pemesanan
header("Location: riwayat_pemesanan.php");
exit();
?>