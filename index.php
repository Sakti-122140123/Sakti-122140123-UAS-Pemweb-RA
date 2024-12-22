<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lomba 17 Agustus</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <div class="nav-container">
            <h1>Lomba 17 Agustus</h1>
            <ul>
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="daftar.php">Daftar</a></li>
                <li><a href="peserta.php">Data Peserta</a></li>
            </ul>
        </div>
    </nav>

    <main>
        <div class="hero">
            <h1>Selamat Datang di Lomba 17 Agustus</h1>
            <p>Merayakan Kemerdekaan Indonesia dengan Semangat Persatuan dan Kegembiraan!</p>
            <div class="cta-button">
                <a href="daftar.php" class="btn-daftar">Daftar Sekarang</a>
            </div>
        </div>

        <section class="lomba-info">
            <h2>Kategori Lomba</h2>
            <div class="lomba-grid">
                <div class="lomba-card">
                    <div class="lomba-icon">🏃‍♂️</div>
                    <h3>Balap Karung</h3>
                    <p>Lomba tradisional yang menguji ketangkasan dan keseimbangan peserta.</p>
                    <p class="waktu">Waktu: 09:00 WIB</p>
                    <p class="lokasi">Lokasi: Lapangan Utama</p>
                </div>
                <div class="lomba-card">
                    <div class="lomba-icon">🌴</div>
                    <h3>Panjat Pinang</h3>
                    <p>Lomba yang membutuhkan kerjasama tim dan strategi untuk mencapai puncak.</p>
                    <p class="waktu">Waktu: 10:30 WIB</p>
                    <p class="lokasi">Lokasi: Halaman Belakang</p>
                </div>
                <div class="lomba-card">
                    <div class="lomba-icon">🍘</div>
                    <h3>Lomba Makan Kerupuk</h3>
                    <p>Lomba yang menghibur dan menguji kecepatan peserta.</p>
                    <p class="waktu">Waktu: 13:00 WIB</p>
                    <p class="lokasi">Lokasi: Panggung Utama</p>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>Sakti Mujahid Imani - 122140123 - RA</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>