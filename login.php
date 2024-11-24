<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['email'] = $email;
            header('Location: index.php');
            exit();
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Email tidak ditemukan.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
        <?php if (isset($error)): ?>
            <p class="text-red-500 mb-4"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <input type="email" name="email" placeholder="Email" required class="w-full p-3 mb-4 border border-gray-300 rounded">
            <input type="password" name="password" placeholder="Password" required class="w-full p-3 mb-4 border border-gray-300 rounded">
            <button type="submit" class="w-full bg-blue-500 text-white p-3 rounded hover:bg-blue-600">Login</button>
        </form>
        <p class="mt-4 text-center">Belum punya akun? <a href="register.php" class="text-blue-500">Daftar</a></p>
        <p class="mt-2 text-center">Lupa password? <a href="forgot_password.php" class="text-blue-500">Reset Password</a></p>
    </div>
</body>
</html>