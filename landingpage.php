<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Furniture - Discover Our New Collection</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0 40px;
            color: #333;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            padding: 15px 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .logo img {
            height: 65px;
        }

        nav {
            display: flex;
            gap: 20px;
        }

        nav a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        nav a:hover {
            background-color: white;
            color: #333;
        }

        .hero {
            background: url("assets/hutomo-abrianto-X5BWooeO4Cw-unsplash.jpg") center/cover no-repeat;
            padding: 185px 20px;
            text-align: center;
        }

        .hero h1 {
            margin: 0;
            font-size: 2.5em;
        }

        .hero p {
            margin: 30px 20px;
            font-size: 1.2em;
        }

        .btn {
            padding: 10px 20px;
            background: #333;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background 0.3s;
        }

        .btn:hover {
            background: #555;
        }

        .categories {
            text-align: center;
            margin: 75px 0;
        }

        .categories h2 {
            margin-bottom: 20px;
        }

        .categories-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .category {
            background: #f2f2f2;
            margin: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            text-align: center;
            width: 300px;
        }

        .category img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
        }

        .category h3 {
            margin: 10px 0;
            font-size: 1.2em;
        }

        .category:hover {
            transform: scale(1.05);
        }

        .products {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 0px 10px;
            text-align: center;
        }

        .products h2 {
            width: 100%;
            text-align: center;
            margin-bottom: 20px;
        }

        .product {
            background: white;
            margin: 15px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 200px;
            text-align: center;
            flex: 1 1 200px;
            max-width: calc(25% - 30px);
        }

        .product img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }

        .product p {
            margin: 10px 0; /* Mengatur margin untuk keterangan produk */
            font-size: 0.9em; /* Ukuran font yang lebih kecil untuk keterangan */
            color: #666; /* Warna teks yang lebih lembut */
        }

        .show-more {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background: #333;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            width: 150px;
            transition: background 0.3s;
        }

        .show-more:hover {
            background: #555;
        }

        footer {
            text-align: center;
            padding: 20px;
            background: #333;
            color: white;
            position: relative;
            bottom: 0;
            width: 96.5%;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="assets/LOGO 1.png" alt="Logo">
        </div>
        <nav>
            <a href="landingpage.php">Home</a>
            <a href="shop.php">Shop</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
        </nav>
    </header>

    <div class="hero">
        <h1>Discover Our New Collection</h1>
        <p>Explore the latest in furniture design</p>
        <a href="login.php" class="btn">LOG IN</a>
    </div>

    <div class="categories">
        <h2>Browse The Range</h2>
        <p> Dekor Ruangan Anda Sesuai yang Anda impikan </p>
        <div class="categories-container">
            <div class="category">
                <img src="assets/living-room-2732939_1280.jpg" alt="Living Room">
                <h3>Living Room</h3>
            </div>
            <div class="category">
                <img src="assets/bedroom-7132435_1280.jpg" alt="Bedroom">
                <h3>Bedroom</h3>
            </div>
            <div class="category">
                <img src="assets/dining-room-2485946_1280.jpg" alt="Dining Room">
                <h3>Dining Room</h3>
            </div>
        </div>
    </div>

    <section id="products" class="products">
        <h2>Our Products</h2>
        <div class="product product-chair">
            <img src="assets/chair-3274474_1280.jpg" alt="Chair">
            <h3>Chair</h3>
            <p>Desain yang ergonomis dipadukan dengan sentuhan modern menciptakan kursi yang ideal untuk bersantai maupun bekerja.</p>
        </div>
        <div class="product product-bed">
            <img src="assets/chastity-cortijo-M8iGdeTSOkg-unsplash.jpg" alt="Bed">
            <h3>Bed</h3>
            <p>kenyamanan maksimal dengan lapisan busa memory foam yang lembut dan lapisan pendukung pocket spring yang kokoh</p>
        </div>
        <div class="product product-sofa">
            <img src="assets/christian-kaindl-4uD9w-pxBTA-unsplash.jpg" alt="Sofa">
            <h3>Sofa</h3>
            <p>Bantalan busa berdensitas tinggi yang dilapisi kain beludru lembut memberikan kenyamanan ekstra.</p>
        </div>
        <div class="product product-lamp">
            <img src="assets/ceiling-lamp-335975_1280.jpg" alt="Lamp">
            <h3>Lamp</h3>
            <p>perpaduan sempurna antara gaya klasik dan modern. Terbuat dari pipa besi dan kayu solid yang memberikan kesan hangat dan maskulin.</p>
        </div>
        <a href="more-products.php" class="show-more">Show More</a>
    </section>

    <footer>
        <p>&copy; 2024 Furniture Company. All rights reserved.</p>
    </footer>
</body>
</html>