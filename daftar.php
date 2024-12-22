<?php
session_start();
require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new Database();
    $conn = $db->getConnection();
    
    // Validasi input server-side
    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
    $umur = filter_input(INPUT_POST, 'umur', FILTER_VALIDATE_INT);
    $jenis_kelamin = filter_input(INPUT_POST, 'jenis_kelamin', FILTER_SANITIZE_STRING);
    $nomor_telepon = filter_input(INPUT_POST, 'nomor_telepon', FILTER_SANITIZE_STRING);
    $pilihan_lomba = filter_input(INPUT_POST, 'pilihan_lomba', FILTER_SANITIZE_STRING);
    
    // Get browser and IP information
    $browser = $_SERVER['HTTP_USER_AGENT'];
    $ip_address = $_SERVER['REMOTE_ADDR'];

    if ($nama && $umur && $jenis_kelamin && $nomor_telepon && $pilihan_lomba) {
        $stmt = $conn->prepare("INSERT INTO peserta (nama_lengkap, umur, jenis_kelamin, nomor_telepon, pilihan_lomba, browser, ip_address) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sisssss", $nama, $umur, $jenis_kelamin, $nomor_telepon, $pilihan_lomba, $browser, $ip_address);
        
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Pendaftaran berhasil!";
            setcookie("last_registration", $nama, time() + (86400 * 30), "/");
            header("Location: peserta.php");
            exit();
        } else {
            $_SESSION['error_message'] = "Terjadi kesalahan saat mendaftar.";
        }
        $stmt->close();
    }
    $db->closeConnection();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Lomba 17 Agustus</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <div class="nav-container">
            <h1>Lomba 17 Agustus</h1>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="daftar.php" class="active">Daftar</a></li>
                <li><a href="peserta.php">Data Peserta</a></li>
            </ul>
        </div>
    </nav>

    <main>
        <div class="form-container">
            <h2>Formulir Pendaftaran</h2>
            <?php if (isset($_SESSION['error_message'])): ?>
                <div class="alert error">
                    <?php 
                        echo $_SESSION['error_message'];
                        unset($_SESSION['error_message']);
                    ?>
                </div>
            <?php endif; ?>
            
            <form id="registrationForm" method="POST" action="daftar.php" onsubmit="return validateForm()">
                <div class="form-group">
                    <label for="nama">Nama Lengkap:</label>
                    <input type="text" id="nama" name="nama" required>
                </div>

                <div class="form-group">
                    <label for="umur">Umur:</label>
                    <input type="number" id="umur" name="umur" required min="5" max="60">
                </div>

                <div class="form-group">
                    <label>Jenis Kelamin:</label>
                    <div class="radio-group">
                        <input type="radio" id="laki" name="jenis_kelamin" value="Laki-laki" required>
                        <label for="laki">Laki-laki</label>
                        <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan">
                        <label for="perempuan">Perempuan</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="nomor_telepon">Nomor Telepon:</label>
                    <input type="tel" id="nomor_telepon" name="nomor_telepon" required>
                </div>

                <div class="form-group">
                    <label for="pilihan_lomba">Pilihan Lomba:</label>
                    <select id="pilihan_lomba" name="pilihan_lomba" required>
                        <option value="">Pilih Lomba</option>
                        <option value="Balap Karung">Balap Karung</option>
                        <option value="Panjat Pinang">Panjat Pinang</option>
                        <option value="Lomba Makan Kerupuk">Lomba Makan Kerupuk</option>
                    </select>
                </div>

                <button type="submit" class="btn-submit">Daftar</button>
            </form>
        </div>
    </main>

    <footer>
        <p>Sakti Mujahid Imani - 122140123 - RA</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>