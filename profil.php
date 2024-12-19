<?php
session_start();
require 'config.php'; // Memanggil file koneksi

// Pastikan pengguna sudah login
if (!isset($_SESSION['Username'])) {
    header("Location: login.php"); // Redirect ke halaman login jika belum login
    exit();
}

// Ambil data pengguna dari database
$username = $_SESSION['Username'];
$sql = "SELECT * FROM user WHERE Username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    // Jika tidak ada pengguna ditemukan
    $error_message = "Pengguna tidak ditemukan!";
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
        }

        /* Tambahan CSS untuk tampilan profil */
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
            transition: background-color 0.3s;
        }

        .profile-info:hover {
            background-color: #e9ecef;
        }

        .profile-info label {
            font-weight: bold;
            color: #555;
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
    <div class="profile-container">
        <h2>Profil Pengguna</h2>
        <?php if (!empty($error_message)): ?>
            <div class="error"><?php echo $error_message; ?></div>
        <?php else: ?>
            <div class="profile-info">
                <label>Username:</label>
                <p><?php echo htmlspecialchars($user['Username']); ?></p>
            </div>
            <div class="profile-info">
                <label>Role:</label>
                <p><?php echo htmlspecialchars($user['Role']); ?></p>
            </div>
        <?php endif; ?>
        <div style="text-align: center;">
    <a href="edit_porfil.php?id=<?php echo $user['id']; ?>" style="background-color: #28a745;">Edit Profil</a>
</div>
        <div style="text-align: center;">
            <a href="dashboard.php">Kembali ke Dashboard</a>
        </div>
        
    </div>
</body>
</html>