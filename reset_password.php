<?php
session_start();
require 'config.php';

$email = $_SESSION['email'] ?? '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($newPassword === $confirmPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("UPDATE user SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $hashedPassword, $email);

        if ($stmt->execute()) {
            header('Location: login.php');
            exit();
        } else {
            $error = "Terjadi kesalahan saat mengubah password.";
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
    <title>Ganti Password</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Ganti Password</h2>
        <?php if (isset($error)): ?>
            <p class="text-red-500 mb-4"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="reset_password.php" method="POST">
            <input type="password" name="newPassword" placeholder="Password Baru" required class="w-full p-3 mb-4 border border-gray-300 rounded">
            <input type="password" name="confirmPassword" placeholder="Konfirmasi Password" required class="w-full p-3 mb-4 border border-gray-300 rounded">
            <button type="submit" class="w-full bg-blue-500 text-white p-3 rounded hover:bg-blue-600">Ganti Password</button>
        </form>
    </div>
</body>
</html>