<?php
session_start();
require 'config.php'; // Memanggil file koneksi

// Pastikan pengguna sudah login
if (!isset($_SESSION['Username'])) {
    header("Location: login.php"); // Redirect ke halaman login jika belum login
    exit();
}

// Ambil ID pengguna dari URL
if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);

    // Ambil data pengguna dari database
    $sql = "SELECT * FROM user WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        $error_message = "Pengguna tidak ditemukan!";
    }

    $stmt->close();
} else {
    header("Location: profil.php"); // Redirect jika ID tidak ditemukan
    exit();
}

// Proses pembaruan data pengguna
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // Hash password baru sebelum menyimpannya
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Update data pengguna
    $update_sql = "UPDATE user SET Username = ?, Password = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssi", $username, $hashed_password, $user_id);

    if ($update_stmt->execute()) {
        $_SESSION['message'] = "Profil berhasil diperbarui.";
        header("Location: login.php"); // Redirect ke halaman profil setelah berhasil
        exit();
    } else {
        $error_message = "Error: " . $update_stmt->error;
    }

    $update_stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
        }

        .profile-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .profile-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .profile-info {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 20px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .cancel-button {
            display: inline-block;
            margin-left: 10px;
            padding: 10px 20px;
            background-color: #dc3545; /* Warna merah */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .cancel-button:hover {
            background-color: #c82333; /* Warna merah gelap */
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h2>Edit Profil Pengguna</h2>
        <?php if (!empty($error_message)): ?>
            <div class="error"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="profile-info">
                <label>Username:</label>
                <input type="text" name="username" value="<?php echo htmlspecialchars($user['Username']); ?>" required>
            </div>
            <div class="profile-info">
                <label>Password Baru:</label>
                <input type="password" name="password" required>
            </div>
            <div style="text-align: center;">
                <button type="submit">Simpan Perubahan</button>
                <a href="dashboard.php" class="cancel-button">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>