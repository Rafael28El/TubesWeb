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
    header("Location: admin.php");
    exit();
}

// Proses pembaruan data pengguna
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    // Update data pengguna
    $update_sql = "UPDATE user SET Username = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("si", $username, $user_id);

    if ($update_stmt->execute()) {
        $_SESSION['message'] = "Profil berhasil diperbarui.";
        header("Location: data.php");
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
    <title>Edit Pengguna</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
        }

        .admin-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 30px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .admin-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .profile-info {
            margin-bottom: 20px;
        }

        .profile-info label {
            display: block;
            margin-bottom: 5px;
        }

        .profile-info input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 20px;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <h2>Edit Pengguna</h2>
        <?php if (!empty($error_message)): ?>
            <div class="error"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="profile-info">
                <label>Username:</label>
                <input type="text" name="username" value="<?php echo htmlspecialchars($user['Username']); ?>" required>
            </div>
            <button type="submit">Simpan Perubahan</button>
        </form>
        <div style="text-align: center;">
            <a href="DashboardAdmin.php">Kembali</a>
        </div>
    </div>
</body>
</html>