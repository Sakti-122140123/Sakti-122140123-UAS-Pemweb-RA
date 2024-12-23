-- Buat database
CREATE DATABASE IF NOT EXISTS lomba_17agustus;
USE lomba_17agustus;

-- Buat tabel peserta dengan validasi dan indeks
CREATE TABLE IF NOT EXISTS peserta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_lengkap VARCHAR(100) NOT NULL,
    umur INT NOT NULL CHECK (umur >= 5 AND umur <= 60),
    jenis_kelamin ENUM('Laki-laki', 'Perempuan') NOT NULL,
    nomor_telepon VARCHAR(15) NOT NULL,
    pilihan_lomba ENUM('Balap Karung', 'Panjat Pinang', 'Lomba Makan Kerupuk') NOT NULL,
    browser VARCHAR(100),
    ip_address VARCHAR(45),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_nama (nama_lengkap),
    INDEX idx_lomba (pilihan_lomba)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;