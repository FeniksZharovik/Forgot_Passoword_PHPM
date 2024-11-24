<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-500 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-white text-2xl font-bold">Dashboard</h1>
            <div>
                <span class="text-white mr-4">Welcome, <?php echo htmlspecialchars($email); ?></span>
                <a href="logout.php" class="bg-white text-blue-500 px-4 py-2 rounded hover:bg-gray-200">Logout</a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto mt-10">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-3xl font-bold mb-4">Selamat Datang di Dashboard</h2>
            <p class="text-gray-700 mb-6">Ini adalah halaman utama setelah Anda berhasil login. Anda dapat menambahkan lebih banyak fitur dan konten di sini sesuai kebutuhan Anda.</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-blue-100 p-6 rounded-lg shadow">
                    <h3 class="text-xl font-bold mb-2">Fitur 1</h3>
                    <p class="text-gray-600">Deskripsi singkat tentang fitur ini.</p>
                </div>
                <div class="bg-blue-100 p-6 rounded-lg shadow">
                    <h3 class="text-xl font-bold mb-2">Fitur 2</h3>
                    <p class="text-gray-600">Deskripsi singkat tentang fitur ini.</p>
                </div>
                <!-- Tambahkan lebih banyak fitur atau konten di sini -->
            </div>
        </div>
    </main>
</body>
</html>