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
            padding: 120px;
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

        .btn {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #555;
        }

        .products {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-top: 20px;
        }

        .product {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 15px;
            margin: 10px;
            width: calc(30% - 20px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 400px; /* Menentukan tinggi tetap untuk produk */
        }

        .product img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
        }

        .product h3 {
            margin: 15px 0 5px; /* Menambahkan margin untuk keseimbangan */
            font-size: 1.5em; /* Menyesuaikan ukuran font */
        }

        .product p {
            color: #666;
            flex-grow: 1; /* Membuat deskripsi produk mengambil ruang yang tersedia */
            margin: 0 0 10px; /* Mengatur margin bawah */
        }

        .price {
            font-size: 1.2em;
            font-weight: bold;
            color: #333;
            margin: 5px 0; /* Mengatur margin untuk keseimbangan */
        }

        .order-btn {
            background-color: rgba(95, 83, 66, 0.78);
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s;
            text-decoration: none; /* Menghapus garis bawah */
            display: inline-block; /* Mengubah menjadi inline-block untuk menyesuaikan padding */
        }

        .order-btn:hover {
            background-color: #0056b3;
        }

        /* Responsif */
        @media (max-width: 768px) {
            .product {
                width: calc(45% - 20px);
            }
        }

        @media (max-width: 480px) {
            .product {
                width: calc(100% - 20px);
            }
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

            <h2>Produk Penjualan</h2>
            <div class="products">
                <?php
                // Contoh data produk. Gantilah dengan data dari database Anda.
                $produk = [
                    ['nama' => 'Wooden Chair', 'deskripsi' => 'Terbuat dari kayu jati berkualitas tinggi, kursi ini memiliki tampilan yang elegan dan tahan lama. Desainnya yang minimalis membuatnya mudah dipadukan dengan berbagai gaya interior.', 'gambar' => 'assets/chair-3274474_1280.jpg', 'harga' => 'Rp 50.000'],
                    ['nama' => 'Yellow Soffa', 'deskripsi' => 'Dengan desain yang elegan dan warna yang lembut, akan memberikan kesan yang mewah dan nyaman. Terbuat dari bahan berkualitas tinggi dan dipenuhi dengan busa yang empuk.', 'gambar' => 'assets/christian-kaindl-4uD9w-pxBTA-unsplash.jpg', 'harga' => 'Rp 70.000'],
                    ['nama' => 'Ceiling Modern Lamp', 'deskripsi' => 'Dengan bentuk yang tidak biasa dan warna yang berani, lampu ini akan menjadi titik fokus di ruangan Anda. Terbuat dari bahan berkualitas tinggi dan dipenuhi dengan cahaya yang terang.', 'gambar' => 'assets/ceiling-lamp-335975_1280.jpg', 'harga' => 'Rp 60.000'],
                    ['nama' => 'Blue BedCover', 'deskripsi' => 'Dengan warna yang menenangkan dan desain yang indah, bedcover ini akan memberikan kesan yang mewah dan nyaman. Terbuat dari bahan berkualitas tinggi dan dipenuhi dengan bulu halus.', 'gambar' => 'assets/chastity-cortijo-M8iGdeTSOkg-unsplash.jpg', 'harga' => 'Rp 60.000'],
                    ['nama' => 'Brown Chair', 'deskripsi' => 'Terbuat dari kayu jati berkualitas tinggi, kursi ini memiliki tampilan yang elegan dan tahan lama. Desainnya yang minimalis membuatnya mudah dipadukan dengan berbagai gaya interior.', 'gambar' => 'assets/Mid-century leather chair _ Hemming & Wills.jpg', 'harga' => 'Rp 50.000'],
                    ['nama' => 'Pink Bedcover', 'deskripsi' => 'Terbuat dari kayu jati berkualitas tinggi, kursi ini memiliki tampilan yang elegan dan tahan lama. Desainnya yang minimalis membuatnya mudah dipadukan dengan berbagai gaya interior.', 'gambar' => 'assets/wenlcv.jpg', 'harga' => 'Rp 50.000'],
                ];

                foreach ($produk as $item) {
                    echo "<div class='product'>
                            <img src='" . htmlspecialchars($item['gambar']) . "' alt='" . htmlspecialchars($item['nama']) . "'>
                            <h3>" . htmlspecialchars($item['nama']) . "</h3>
                            <p>" . htmlspecialchars($item['deskripsi']) . "</p>
                            <div class='price'>" . htmlspecialchars($item['harga']) . "</div>
                            <a href='pemesanan.php?produk=" . urlencode($item['nama']) . "' class='order-btn'>Pesan</a>
                          </div>";
                }
                ?>
            </div>
        </section>
    </div>
</body>
</html>