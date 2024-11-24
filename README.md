# User Management System

Sistem manajemen pengguna ini menyediakan fitur login, register, lupa password, dan verifikasi email. Proyek ini dibangun menggunakan PHP dan Tailwind CSS untuk tampilan yang modern dan responsif.

## Fitur

- **Login**: Pengguna dapat masuk ke sistem menggunakan email dan password.
- **Register**: Pengguna baru dapat mendaftar dengan email dan password.
- **Lupa Password**: Pengguna dapat meminta reset password dengan mengirimkan kode OTP ke email mereka.
- **Verifikasi Email**: Pengguna harus memverifikasi email mereka dengan memasukkan kode OTP yang dikirimkan.
- **Ganti Password**: Setelah verifikasi, pengguna dapat mengganti password mereka.

## Instalasi

1. **Clone Repository**

   ```bash
   git clone https://github.com/username/repo-name.git
   cd repo-name
   ```

2. **Setup Database**

   - Buat database baru dengan nama `user_management`.
   - Jalankan skrip SQL berikut untuk membuat tabel `user`:

     ```sql
     CREATE TABLE user (
         Uid INT AUTO_INCREMENT PRIMARY KEY,
         email VARCHAR(255) NOT NULL UNIQUE,
         password VARCHAR(255) NOT NULL
     );
     ```

3. **Konfigurasi Koneksi Database**

   - Edit file `config.php` dan sesuaikan dengan kredensial database Anda:

     ```php
     <?php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "user_management";

     $conn = new mysqli($servername, $username, $password, $dbname);

     if ($conn->connect_error) {
         die("Koneksi gagal: " . $conn->connect_error);
     }
     ?>
     ```

4. **Instalasi PHPMailer**

   - Pastikan Composer terinstal di sistem Anda.
   - Jalankan perintah berikut untuk menginstal PHPMailer:

     ```bash
     composer require phpmailer/phpmailer
     ```

5. **Konfigurasi Email**

   - Edit file `forgot_password.php` dan sesuaikan dengan kredensial email Anda:

     ```php
     $mail->Username = 'gunakan email anda';
     $mail->Password = 'gunakan password email anda';
     $mail->setFrom('gunakan email anda', 'nama pengirim');
     ```

## Penggunaan

- **Akses Halaman Login**: Buka `login.php` di browser Anda.
- **Daftar Pengguna Baru**: Buka `register.php` untuk membuat akun baru.
- **Lupa Password**: Buka `forgot_password.php` untuk memulai proses reset password.
- **Verifikasi Email**: Masukkan kode OTP yang dikirim ke email Anda di `verif_email.php`.
- **Ganti Password**: Setelah verifikasi, Anda dapat mengganti password di `reset_password.php`.

## Teknologi yang Digunakan

- PHP
- MySQL
- Tailwind CSS
- PHPMailer

## Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).
