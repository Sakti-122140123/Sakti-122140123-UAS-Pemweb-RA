# UAS Web Programming Documentation

## Bagian 1: Client-side Programming (30%)

### 1.1 Manipulasi DOM dengan JavaScript (15%)
Form input dengan 4+ elemen berbeda dapat ditemukan di `daftar.php`:
```html
<form id="registrationForm" method="POST" action="daftar.php" onsubmit="return validateForm()">
    <!-- Text input -->
    <input type="text" id="nama" name="nama" required>
    
    <!-- Number input -->
    <input type="number" id="umur" name="umur" required min="5" max="60">
    
    <!-- Radio input -->
    <input type="radio" id="laki" name="jenis_kelamin" value="Laki-laki" required>
    <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan">
    
    <!-- Telephone input -->
    <input type="tel" id="nomor_telepon" name="nomor_telepon" required>
    
    <!-- Select input -->
    <select id="pilihan_lomba" name="pilihan_lomba" required>
```

Data dari server ditampilkan dalam tabel HTML di `peserta.php`:
```php
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Umur</th>
            <!-- ... other headers ... -->
        </tr>
    </thead>
    <tbody>
        <?php 
        if ($result->num_rows > 0) {
            $no = 1;
            while($row = $result->fetch_assoc()) {
                // Data display logic
            }
        }
        ?>
    </tbody>
</table>
```

### 1.2 Event Handling (15%)
Di `script.js`, terdapat beberapa event handling:

1. Form Validation Event:
```javascript
function validateForm() {
    // Nama validation
    if (nama.length < 3) {
        showAlert("Nama harus minimal 3 karakter!", "error");
        return false;
    }
    // Umur validation
    if (umur < 5 || umur > 60) {
        showAlert("Umur harus antara 5-60 tahun!", "error");
        return false;
    }
    // Nomor telepon validation
    if (!/^[0-9]{10,13}$/.test(nomorTelepon)) {
        showAlert("Nomor telepon harus 10-13 digit angka!", "error");
        return false;
    }
}
```

2. Input Change Event:
```javascript
input.addEventListener("change", function () {
    sessionStorage.setItem(input.id, input.value);
});
```

3. Card Animation Events:
```javascript
card.addEventListener("mouseenter", function () {
    this.style.transform = "translateY(-10px)";
});
card.addEventListener("mouseleave", function () {
    this.style.transform = "translateY(0)";
});
```

## Bagian 2: Server-side Programming (30%)

### 2.1 Pengelolaan Data dengan PHP (20%)

Penggunaan metode POST dan validasi server di `daftar.php`:
```php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi input server-side
    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
    $umur = filter_input(INPUT_POST, 'umur', FILTER_VALIDATE_INT);
    
    // Browser dan IP capture
    $browser = $_SERVER['HTTP_USER_AGENT'];
    $ip_address = $_SERVER['REMOTE_ADDR'];
}
```

### 2.2 Objek PHP Berbasis OOP (10%)

Class Database dengan multiple methods di `connection.php`:
```php
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = ""; 
    private $database = "lomba_17agustus";
    private $conn;

    public function __construct() {
        // Constructor method
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}
```

## Bagian 3: Database Management (20%)

### 3.1 Pembuatan Tabel Database (5%)
Di `lomba_17agustus.sql`:
```sql
CREATE TABLE IF NOT EXISTS peserta (
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

### 3.2 Konfigurasi Koneksi Database (5%)
Di `connection.php`:
```php
private $host = "localhost";
private $username = "root";
private $password = ""; 
private $database = "lomba_17agustus";
```

### 3.3 Manipulasi Data pada Database (10%)
Insert data di `daftar.php`:
```php
$stmt = $conn->prepare("INSERT INTO peserta (nama_lengkap, umur, jenis_kelamin, nomor_telepon, pilihan_lomba, browser, ip_address) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sisssss", $nama, $umur, $jenis_kelamin, $nomor_telepon, $pilihan_lomba, $browser, $ip_address);
```

## Bagian 4: State Management (20%)

### 4.1 State Management dengan Session (10%)
Session management di multiple files:
```php
session_start();

// Set session message
$_SESSION['success_message'] = "Pendaftaran berhasil!";

// Use session message
if (isset($_SESSION['success_message'])) {
    echo $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}
```

### 4.2 Pengelolaan State dengan Cookie dan Browser Storage (10%)
Cookie management di `daftar.php`:
```php
setcookie("last_registration", $nama, time() + (86400 * 30), "/");
```

Browser Storage di `script.js`:
```javascript
// SessionStorage
sessionStorage.setItem(input.id, input.value);

// LocalStorage
localStorage.setItem("lastRegistration", JSON.stringify({
    nama: nama,
    umur: umur,
    lomba: pilihanLomba,
    timestamp: new Date().toISOString()
}));
```

## Bagian Bonus: Hosting Aplikasi Web (20%)

### Langkah-langkah Hosting Aplikasi Web (5%)

1. Persiapan File
   - Mengorganisir semua file proyek (PHP, CSS, JavaScript) ke dalam satu folder
   - Memastikan semua path relatif dalam kode sudah benar
   - Mengekspor database MySQL dari localhost

2. Pendaftaran di InfinityFree
   - Membuat akun di infinityfree.net
   - Memilih subdomain gratis atau menggunakan domain kustom
   - Mengaktifkan akun dan menunggu verifikasi

3. Upload File
   - Login ke control panel InfinityFree
   - Menggunakan File Manager untuk upload semua file website
   - Mengatur permission file (644 untuk file, 755 untuk folder)

4. Konfigurasi Database
   ```php
   // Mengupdate connection.php dengan kredensial InfinityFree
   private $host = "sql.infinityfree.com"; // host database InfinityFree
   private $username = "nama_user_db"; // username database
   private $password = "password_db"; // password database
   private $database = "nama_database"; // nama database
   ```

### Pemilihan Penyedia Hosting (5%)

InfinityFree dipilih karena:
1. Fitur Gratis yang Memadai:
   - Hosting tanpa biaya
   - SSL gratis
   - Subdomain gratis
   - Database MySQL
   - Panel kontrol lengkap

2. Spesifikasi Teknis yang Mendukung:
   - PHP 7+ support
   - MySQL/MariaDB
   - 5GB disk space
   - Unlimited bandwidth
   - FTP access

3. Kesesuaian dengan Proyek:
   - Mendukung semua teknologi yang digunakan (PHP, MySQL, JavaScript)
   - Performa yang cukup untuk aplikasi skala kecil-menengah
   - Interface admin yang user-friendly

### Keamanan Aplikasi Web (5%)

1. Implementasi Keamanan Database
   ```php
   // Menggunakan prepared statements untuk mencegah SQL Injection
   $stmt = $conn->prepare("INSERT INTO peserta (nama_lengkap, umur) VALUES (?, ?)");
   $stmt->bind_param("si", $nama, $umur);
   ```

2. Validasi Input
   ```php
   // Server-side validation
   $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
   $umur = filter_input(INPUT_POST, 'umur', FILTER_VALIDATE_INT);
   ```

3. XSS Prevention
   ```php
   // Output escaping
   echo htmlspecialchars($row['nama_lengkap']);
   ```

4. Session Security
   ```php
   // Konfigurasi session yang aman
   ini_set('session.cookie_httponly', 1);
   ini_set('session.use_only_cookies', 1);
   session_start();
   ```

### Konfigurasi Server (5%)

1. PHP Configuration
   ```ini
   ; Mengatur php.ini melalui .htaccess
   php_value upload_max_filesize 10M
   php_value post_max_size 10M
   php_value max_execution_time 300
   php_value max_input_time 300
   ```

2. Server Security
   ```apache
   # Konfigurasi .htaccess untuk keamanan
   Options -Indexes
   ServerSignature Off
   
   # Protect Directory
   <FilesMatch "^\.">
     Order allow,deny
     Deny from all
   </FilesMatch>
   
   # Prevent Script Execution
   <Files ~ "\.(php|php3|php4|php5|phtml|pl|py|jsp|asp|htm|shtml|sh|cgi)$">
     deny from all
   </Files>
   ```

3. Database Configuration
   ```sql
   -- Mengoptimalkan performa database
   SET GLOBAL max_connections = 150;
   SET GLOBAL connect_timeout = 60;
   ```

4. Error Handling
   ```php
   // Konfigurasi error reporting yang aman untuk production
   error_reporting(E_ALL);
   ini_set('display_errors', 0);
   ini_set('log_errors', 1);
   ini_set('error_log', '/path/to/error.log');
   ```

Dengan konfigurasi ini, aplikasi web dapat berjalan dengan aman dan efisien di lingkungan hosting InfinityFree, dengan mempertimbangkan aspek keamanan, performa, dan kemudahan pengelolaan.

