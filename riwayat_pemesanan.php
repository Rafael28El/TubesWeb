<?php
session_start();
require 'config.php'; // Pastikan Anda memiliki file koneksi.php untuk koneksi database

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data pemesanan dari database
$sql = "SELECT * FROM pesanan ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MODERNTURE</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            display: flex;
            justify-content: center;
            background-color: #333;
        }

        .navbar ul {
            list-style-type: none;
            padding: 0;
            margin: 15px;
            display: flex;
        }

        .navbar ul li {
            margin: 0 15px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            transition: background-color 0.3s;
        }

        .navbar a:hover {
            background-color: #555;
        }

        .container {
            display: flex;
            flex: 1;
            padding: 10px;
        }

        .content {
            flex: 1;
            padding: 20px;
            background-color: #ffffff;
        }

        .hero {
            background: url("assets/hutomo-abrianto-X5BWooeO4Cw-unsplash.jpg") center/cover no-repeat;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .hero h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .hero p {
            font-size: 1.2em;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: rgba(0, 0, 0, 0.66);
            color: white;
        }
        .button, .action-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: rgba(0, 0, 0, 0.66);
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .button:hover, .action-btn:hover {
            background-color: rgba(0, 0, 0, 0.88);
        }

        .action-btn {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <ul>
            <li><a href="dashboard.php">Home</a></li>
            <li><a href="produk.php">Produk</a></li>
            <li><a href="riwayat_pemesanan.php">Pesanan</a></li>
            <li><a href="profil.php">Profil</a></li>
            <li><a href="landingpage.php">Keluar</a></li>
        </ul>
    </nav>

    <div class="container">
        <section class="content">
            <div class="hero">
                <h1>Discover Our Quality</h1>
                <p>Furniture yang Modern & Minimalis</p>
            </div>

			<?php if (isset($_SESSION['message'])): ?>
    <div style="color: green; margin-bottom: 20px;">
        <?= $_SESSION['message']; ?>
        <?php unset($_SESSION['message']); // Hapus pesan setelah ditampilkan ?>
    </div>
<?php endif; ?>

            <h2>Riwayat Pemesanan</h2>
            <div class="products">
                <?php if ($result->num_rows > 0): ?>
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                        </tr>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['alamat'] ?></td>
                                <td><?= $row['telepon'] ?></td>
                                <td><?= $row['jumlah'] ?></td>
                                <td><?= ucfirst($row['status']) ?></td>
                                <td>
                                    <?php if ($row['status'] === 'pending'): ?>
                                        <a href="hapuspesanan.php?id=<?= $row['id'] ?>" class="action-btn">Batalkan</a>
                                        <a href="terima_pemesanan.php?id=<?= $row['id'] ?>" class="action-btn">Selesai</a>
                
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </table>
                <?php else: ?>
                    <p>Tidak ada riwayat pemesanan.</p>
                <?php endif; ?>
                
                <a href="dashboard.php" class="button">Kembali ke Beranda</a>
                
                <?php
                // Tutup koneksi
                $conn->close();
                ?>
            </div>
        </section>
    </div>
</body>
</html>