<?php
session_start();
require 'config.php'; // Memanggil file koneksi

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Mengambil data user dari database
    $sql = "SELECT * FROM user WHERE Username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Memverifikasi password
        if (password_verify($password, $user['Password'])) {
            // Set session dan redirect berdasarkan role
            $_SESSION['Username'] = $user['Username'];
            $_SESSION['Role'] = $user['Role'];
            if ($user['Role'] === 'admin') {
                header("Location: DashboardAdmin.php"); // Redirect ke halaman admin
            } else {
                header("Location: dashboard.php"); // Redirect ke halaman user
            }
            exit();
        } else {
            $error_message = "Password salah!";
        }
    } else {
        $error_message = "Username tidak ditemukan!";
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Furniture Company</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url("assets/hutomo-abrianto-X5BWooeO4Cw-unsplash.jpg") center/cover no-repeat;
            color: #333;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            padding: 20px 30px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .logo img {
            height: 50px;
        }

        nav {
            display: flex;
            gap: 30px;
        }

        nav a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .login-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .login-container h2 {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px; /* Ukuran font yang lebih besar untuk input */
            box-sizing: border-box; /* Menjaga lebar input sesuai dengan pengaturan padding */
        }

        .btn {
            padding: 10px 20px;
            background: #333;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn:hover {
            background: #555;
        }

        footer {
            text-align: center;
            padding: 23px;
            background: #333;
            color: white;
            position: relative;
            bottom: 0;
            width: 96%;
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
            <a href="#shop">Shop</a>
            <a href="#about">About</a>
            <a href="#contact">Contact</a>
        </nav>
    </header>

    <div class="login-container">
        <h2>Login to Your Account</h2>
        <?php if (!empty($error_message)): ?>
        <div class="error"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
        <p>Belum punya akun? <a href="daftar.php">Daftar di sini</a></p>
    </div>

    <footer>
        <p>&copy; 2024 Furniture Company. All rights reserved.</p>
    </footer>
</body>
</html>