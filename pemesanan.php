<?php
// Ambil nama produk dari parameter URL
$produk = isset($_GET['produk']) ? htmlspecialchars($_GET['produk']) : '';

// Contoh data produk. Gantilah dengan data yang sesuai dari database Anda.
$daftar_produk = [
    'Wooden Chair' => [
        'deskripsi' => 'Terbuat dari kayu jati berkualitas tinggi.',
        'harga' => 'Rp 50.000',
        'gambar' => 'assets/chair-3274474_1280.jpg'
    ],
    'Yellow Soffa' => [
        'deskripsi' => 'Desain yang elegan dan warna lembut.',
        'harga' => 'Rp 70.000',
        'gambar' => 'assets/christian-kaindl-4uD9w-pxBTA-unsplash.jpg'
    ],
    'Ceiling Modern Lamp' => [
        'deskripsi' => 'Bentuk yang tidak biasa dan warna berani.',
        'harga' => 'Rp 60.000',
        'gambar' => 'assets/ceiling-lamp-335975_1280.jpg'
    ],
    'Blue BedCover' => [
        'deskripsi' => 'Warna menenangkan dan desain indah.',
        'harga' => 'Rp 60.000',
        'gambar' => 'assets/chastity-cortijo-M8iGdeTSOkg-unsplash.jpg'
    ],
    'Brown Chair' => [
        'deskripsi' => 'Tampilan yang elegan dan tahan lama.',
        'harga' => 'Rp 50.000',
        'gambar' => 'assets/Mid-century leather chair _ Hemming & Wills.jpg'
    ],
    'Pink Bedcover' => [
        'deskripsi' => 'Tahan lama dengan desain minimalis.',
        'harga' => 'Rp 50.000',
        'gambar' => 'assets/wenlcv.jpg'
    ],
];

// Ambil detail produk berdasarkan nama
if (array_key_exists($produk, $daftar_produk)) {
    $detail_produk = $daftar_produk[$produk];
} else {
    $detail_produk = null;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan - <?= $produk ?></title>
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

        .content {
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .product-detail {
            display: flex;
            margin-bottom: 20px;
        }

        .product-detail img {
            width: 200px;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
            margin-right: 20px;
        }

        .product-detail div {
            flex: 1;
        }

        .product-detail h2 {
            margin: 0 0 10px;
        }

        .product-detail p {
            color: #666;
        }

        .price {
            font-size: 1.5em;
            font-weight: bold;
            color: #333;
            margin: 10px 0;
        }

        .order-form {
            margin-top: 20px;
        }

        .order-form label {
            display: block;
            margin: 10px 0 5px;
        }

        .order-form input, .order-form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .order-form button {
            background-color: #007BFF;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .order-form button:hover {
            background-color: #0056b3;
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

    <div class="content">
        <h1>Pemesanan Produk</h1>

        <?php if ($detail_produk): ?>
            <div class="product-detail">
                <img src="<?= $detail_produk['gambar'] ?>" alt="<?= $produk ?>">
                <div>
                    <h2><?= $produk ?></h2>
                    <p><?= $detail_produk['deskripsi'] ?></p>
                    <div class="price"><?= $detail_produk['harga'] ?></div>
                </div>
            </div>

            <form class="order-form" action="proses_pemesanan.php" method="POST">
                <label for="nama">Nama Lengkap:</label>
                <input type="text" id="nama" name="nama" required>

                <label for="alamat">Alamat Pengiriman:</label>
                <input type="text" id="alamat" name="alamat" required>

                <label for="telepon">Nomor Telepon:</label>
                <input type="text" id="telepon" name="telepon" required>

                <label for="jumlah">Jumlah:</label>
                <input type="number" id="jumlah" name="jumlah" value="1" min="1" required>

                <button type="submit">Kirim Pemesanan</button>
            </form>
        <?php else: ?>
            <p>Produk tidak ditemukan.</p>
        <?php endif; ?>
    </div>
</body>
</html>