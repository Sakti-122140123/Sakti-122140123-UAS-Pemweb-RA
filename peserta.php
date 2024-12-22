<?php
session_start();
require_once 'connection.php';

$db = new Database();
$conn = $db->getConnection();

$result = $conn->query("SELECT * FROM peserta ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peserta Lomba 17 Agustus</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <div class="nav-container">
            <h1>Lomba 17 Agustus</h1>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="daftar.php">Daftar</a></li>
                <li><a href="peserta.php" class="active">Data Peserta</a></li>
            </ul>
        </div>
    </nav>

    <main>
        <div class="table-container">
            <h2>Data Peserta Lomba</h2>
            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="alert success">
                    <?php 
                        echo $_SESSION['success_message'];
                        unset($_SESSION['success_message']);
                    ?>
                </div>
            <?php endif; ?>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Umur</th>
                        <th>Jenis Kelamin</th>
                        <th>Pilihan Lomba</th>
                        <th>Waktu Daftar</th>
                        <th>Browser</th>
                        <th>IP Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if ($result->num_rows > 0) {
                        $no = 1;
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . htmlspecialchars($row['nama_lengkap']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['umur']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['jenis_kelamin']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['pilihan_lomba']) . "</td>";
                            echo "<td>" . date('d/m/Y H:i', strtotime($row['created_at'])) . "</td>";
                            echo "<td>" . htmlspecialchars($row['browser']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['ip_address']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' class='text-center'>Belum ada peserta yang terdaftar</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>

    <footer>
        <p>Sakti Mujahid Imani - 122140123 - RA</p>
    </footer>
</body>
</html>
<?php $db->closeConnection(); ?>