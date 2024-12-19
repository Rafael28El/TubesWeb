<?php
session_start();
require 'config.php'; // Memanggil file koneksi

// Pastikan pengguna sudah login dan memiliki hak akses admin
if (!isset($_SESSION['Username']) || $_SESSION['Role'] !== 'admin') {
    header("Location: login.php"); // Redirect ke halaman login jika belum login atau bukan admin
    exit();
}

// Ambil data pengguna dengan role 'user' dari database
$sql = "SELECT * FROM user WHERE Role = 'user'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$users = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Daftar Pengguna</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
        }

        .admin-container {
            max-width: 800px;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color:rgb(0, 0, 0, 0.66);
            color: white;
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
            background-color:rgb(0, 0, 0, 0.66);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color:rgb(168, 168, 168);
        }

        .action-links a {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <h2>Daftar Pengguna Terdaftar</h2>
        <?php if (empty($users)): ?>
            <div class="error">Tidak ada pengguna yang terdaftar.</div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['id']); ?></td>
                            <td><?php echo htmlspecialchars($user['Username']); ?></td>
                            <td class="action-links">
                                <a href="edit_user.php?id=<?php echo $user['id']; ?>" style="color:white;">Edit</a>
                                <a href="delete_user.php?id=<?php echo $user['id']; ?>" style="color:white;" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
        <div style="text-align: center;">
            <a href="dashboard.php">Kembali ke Dashboard</a>
        </div>
    </div>
</body>
</html>