<?php
session_start();
require 'config.php'; // Memanggil file koneksi

// Pastikan pengguna sudah login dan memiliki hak akses admin
if (!isset($_SESSION['Username']) || $_SESSION['Role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Ambil ID pengguna dari URL
if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);

    // Hapus pengguna dari database
    $delete_sql = "DELETE FROM user WHERE id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("i", $user_id);

    if ($delete_stmt->execute()) {
        $_SESSION['message'] = "Pengguna berhasil dihapus.";
        header("Location: data.php");
        exit();
    } else {
        $_SESSION['error'] = "Error: " . $delete_stmt->error;
    }

    $delete_stmt->close();
}

$conn->close();
?>