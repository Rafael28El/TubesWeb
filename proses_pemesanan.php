<?php
session_start();
require 'config.php'; // Pastikan Anda memiliki file koneksi.php untuk koneksi database

// Ambil data dari formulir
$nama = isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : '';
$alamat = isset($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : '';
$telepon = isset($_POST['telepon']) ? htmlspecialchars($_POST['telepon']) : '';
$jumlah = isset($_POST['jumlah']) ? intval($_POST['jumlah']) : 1;

// Simpan informasi pemesanan ke dalam sesi
$_SESSION['pesanan'] = [
    'nama' => $nama,
    'alamat' => $alamat,
    'telepon' => $telepon,
    'jumlah' => $jumlah
];

// Cek jika tombol konfirmasi ditekan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Siapkan dan bind
    $stmt = $conn->prepare("INSERT INTO pesanan (nama, alamat, telepon, jumlah) VALUES (?, ?, ?, ?)");
    
    if ($stmt === false) {
        die("Error in prepare statement: " . $conn->error);
    }

    // Bind parameter
    $stmt->bind_param("sssi", $nama, $alamat, $telepon, $jumlah);

    // Eksekusi pernyataan
    if ($stmt->execute()) {
        // Pesanan berhasil disimpan, redirect ke halaman riwayat pemesanan
        header("Location: riwayat_pemesanan.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Tutup koneksi
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pemesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .content {
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        .details {
            margin-top: 20px;
        }

        .details p {
            margin: 5px 0;
        }

        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .cancel-button {
            background-color: #dc3545; /* Merah untuk tombol batalkan */
        }

        .cancel-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="content">
        <h1>Konfirmasi Pemesanan</h1>
        <div class="details">
            <p><strong>Nama:</strong> <?= $nama ?></p>
            <p><strong>Alamat Pengiriman:</strong> <?= $alamat ?></p>
            <p><strong>Nomor Telepon:</strong> <?= $telepon ?></p>
            <p><strong>Jumlah:</strong> <?= $jumlah ?></p>
        </div>
        
        <p>Terima kasih telah melakukan pemesanan! Kami akan segera menghubungi Anda untuk konfirmasi lebih lanjut.</p>
        
        <form method="POST">
            <button type="submit" class="button">Konfirmasi Pemesanan</button>
        </form>
        <a href="halaman_pemesanan.php" class="button">Edit Pesanan</a>
        <a href="batalkan_pesanan.php" class="button cancel-button">Batalkan Pesanan</a>
    </div>
</body>
</html>