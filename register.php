<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password === $confirm_password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO user (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $hashedPassword);

        if ($stmt->execute()) {
            header('Location: login.php');
            exit();
        } else {
            $error = "Terjadi kesalahan saat mendaftar.";
        }

        $stmt->close();
    } else {
        $error = "Password tidak cocok.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>
        <?php if (isset($error)): ?>
            <p class="text-red-500 mb-4"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="register.php" method="POST">
            <input type="email" name="email" placeholder="Email" required class="w-full p-3 mb-4 border border-gray-300 rounded">
            <input type="password" name="password" placeholder="Password" required class="w-full p-3 mb-4 border border-gray-300 rounded">
            <input type="password" name="confirm_password" placeholder="Konfirmasi Password" required class="w-full p-3 mb-4 border border-gray-300 rounded">
            <button type="submit" class="w-full bg-blue-500 text-white p-3 rounded hover:bg-blue-600">Daftar</button>
        </form>
        <p class="mt-4 text-center">Sudah punya akun? <a href="login.php" class="text-blue-500">Login</a></p>
    </div>
</body>
</html>