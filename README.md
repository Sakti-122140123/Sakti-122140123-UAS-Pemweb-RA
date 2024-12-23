# Dokumentasi UAS Pemrograman Web

Website Pendaftaran Lomba 17 Agustus

## Cara Penggunaan

Website dapat diakses di: https://daftarlomba17.wuaze.com/

## Pengembang

Nama   : Sakti Mujahid Imani

NIM    : 122140123

Kelas  : RA

## Deskripsi Project

Website ini dibuat untuk memudahkan pendaftaran peserta lomba 17 Agustus. Aplikasi ini memungkinkan pengguna untuk:

- Mendaftar sebagai peserta lomba
- Memilih jenis lomba yang diikuti
- Melihat daftar peserta yang sudah mendaftar
- Menampilkan informasi lomba yang tersedia

## Struktur File

```
📦 UAS_RA
 ├── connection.php       # Konfigurasi database
 ├── daftar.php           # Halaman pendaftaran
 ├── index.php            # Halaman utama
 ├── Logo.png             # Logo Website
 ├── peserta.php          # Halaman daftar peserta
 ├── script.js            # File JavaScript
 ├── style.css            # File CSS
 └── lomba_17agustus.sql  # File database
```

## Bagian 1: Client-side Programming (30%)

### 1.1 Manipulasi DOM (15%)

Pada website ini, manipulasi DOM diimplementasikan dalam form pendaftaran (`daftar.php`) yang memiliki beberapa elemen input:

```html
<!-- Form dengan berbagai tipe input -->
<form id="registrationForm">
    <input type="text" id="nama">         <!-- Input teks -->
    <input type="number" id="umur">       <!-- Input angka -->
    <input type="radio" name="gender">    <!-- Input radio -->
    <input type="tel" id="nomor_telepon"> <!-- Input telepon -->
    <select id="pilihan_lomba">           <!-- Dropdown -->
</form>
```

**Penjelasan:** Form ini memiliki validasi client-side menggunakan JavaScript untuk memastikan data yang dimasukkan sesuai kriteria sebelum dikirim ke server.

### 1.2 Event Handling (15%)

Event yang diimplementasikan dalam `script.js`:

```javascript
// 1. Event submit form
form.addEventListener("submit", function () {
  if (validateForm()) {
    // Logika submit
  }
});

// 2. Event perubahan input
input.addEventListener("change", function () {
  sessionStorage.setItem(input.id, input.value);
});

// 3. Event animasi card
card.addEventListener("mouseenter", function () {
  this.style.transform = "translateY(-10px)";
});
```

**Penjelasan:**

- Event submit: Memvalidasi form sebelum pengiriman
- Event change: Menyimpan data sementara di sessionStorage
- Event mouseenter: Memberikan efek animasi pada card lomba

## Bagian 2: Server-side Programming (30%)

### 2.1 Pengelolaan Data PHP (20%)

```php
// Validasi dan sanitasi input di daftar.php
$nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
$umur = filter_input(INPUT_POST, 'umur', FILTER_VALIDATE_INT);

// Capture informasi browser dan IP
$browser = $_SERVER['HTTP_USER_AGENT'];
$ip_address = $_SERVER['REMOTE_ADDR'];
```

**Penjelasan:** Server melakukan validasi dan pembersihan data sebelum disimpan ke database, serta mengambil informasi browser dan IP pengguna.

### 2.2 Object Oriented PHP (10%)

```php
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "lomba_17agustus";

    public function __construct() {
        // Inisialisasi koneksi
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}
```

**Penjelasan:** Class Database menerapkan konsep OOP untuk mengelola koneksi database dengan lebih terstruktur.

## Bagian 3: Database Management (20%)

### 3.1 Pembuatan Database (5%)

```sql
CREATE TABLE peserta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_lengkap VARCHAR(100) NOT NULL,
    umur INT NOT NULL,
    jenis_kelamin ENUM('Laki-laki', 'Perempuan') NOT NULL,
    nomor_telepon VARCHAR(15) NOT NULL,
    pilihan_lomba VARCHAR(50) NOT NULL,
    browser VARCHAR(100),
    ip_address VARCHAR(45),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

**Penjelasan:** Tabel peserta dirancang untuk menyimpan data pendaftaran dengan berbagai tipe data yang sesuai.

## Bagian 4: State Management (20%)

### 4.1 Session Management (10%)

```php
session_start();
$_SESSION['success_message'] = "Pendaftaran berhasil!";
```

**Penjelasan:** Session digunakan untuk menyimpan pesan sukses/error dan data temporary.

### 4.2 Cookie dan Browser Storage (10%)

```javascript
// Local Storage
localStorage.setItem(
  "lastRegistration",
  JSON.stringify({
    nama: nama,
    umur: umur,
  })
);

// Cookie
setcookie("last_registration", $nama, time() + 86400 * 30, "/");
```

**Penjelasan:** Menggunakan localStorage untuk data kompleks dan cookie untuk data sederhana.

## Bonus: Hosting Website (20%)

### 1. Langkah-Langkah Hosting (5%)

1. Persiapan file project
2. Registrasi di InfinityFree
3. Upload file via File Manager
4. Konfigurasi database
5. Aktivasi SSL/HTTPS

### 2. Pemilihan Hosting (5%)

InfinityFree dipilih karena:

- Gratis dengan fitur lengkap
- Support PHP dan MySQL
- Free SSL/HTTPS
- Control panel lengkap
- Bandwidth unlimited

### 3. Keamanan Website (5%)

1. Validasi input:

```php
$nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
```

2. Prepared Statement:

```php
$stmt = $conn->prepare("INSERT INTO peserta VALUES (?, ?)");
```

3. XSS Prevention:

```php
echo htmlspecialchars($data);
```

### 4. Konfigurasi Server (5%)

1. PHP Configuration:

```ini
php_value upload_max_filesize 10M
php_value max_execution_time 300
```

2. Security Headers:

```apache
Options -Indexes
ServerSignature Off
```

## Fitur Tambahan

1. Responsive design
2. Animasi UI/UX
3. Validasi form real-time
4. Pesan feedback untuk user
5. HTTPS/SSL security
