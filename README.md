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
