<?php
/**
 * Halaman daftar peserta lomba 17 Agustus
 * Menampilkan data peserta dari database
 */
session_start();
require_once 'connection.php';

try {
    $db = Database::getInstance();
    $conn = $db->getConnection();

    // Prepare and execute query
    $query = "SELECT * FROM peserta ORDER BY created_at DESC";
    $result = $conn->query($query);

    if (!$result) {
        throw new Exception("Error executing query: " . $conn->error);
    }
} catch (Exception $e) {
    $_SESSION['error_message'] = "Terjadi kesalahan: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Daftar peserta lomba 17 Agustus">
    <title>Data Peserta Lomba 17 Agustus</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="Logo.png" type="image/x-icon">
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
                        echo htmlspecialchars($_SESSION['success_message']);
                        unset($_SESSION['success_message']);
                    ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error_message'])): ?>
                <div class="alert error">
                    <?php 
                        echo htmlspecialchars($_SESSION['error_message']);
                        unset($_SESSION['error_message']);
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
                    if (isset($result) && $result->num_rows > 0) {
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
<?php 
if (isset($db)) {
    $db->closeConnection();
} 
?>