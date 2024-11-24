<?php
session_start();
$email = $_SESSION['email'] ?? '';
$otp_session = $_SESSION['otp'] ?? '';
$from_register = $_SESSION['from_register'] ?? false;

if (!$email) {
    header('Location: register.php');
    exit;
}

if (isset($_POST['verify'])) {
    $otp_input_array = $_POST['otp'] ?? [];
    $otp_input = implode('', $otp_input_array);
    if ($otp_input == $otp_session) {
        if ($from_register) {
            header('Location: create_password.php');
        } else {
            header('Location: reset_password.php');
        }
        exit;
    } else {
        $error = "Kode OTP salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Verifikasi Email</h2>
        <p class="text-gray-700 mb-4 text-center">Masukkan kode OTP yang telah dikirim ke email: <strong><?php echo htmlspecialchars($email); ?></strong></p>
        <?php if (isset($error)): ?>
            <p class="text-red-500 mb-4 text-center"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="verif_email.php" method="POST" class="flex justify-center">
            <div class="flex space-x-2">
                <?php for ($i = 0; $i < 6; $i++): ?>
                    <input type="text" name="otp[]" maxlength="1" required class="w-12 h-12 text-center border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                <?php endfor; ?>
            </div>
            <button type="submit" name="verify" class="mt-6 w-full bg-blue-500 text-white p-3 rounded hover:bg-blue-600">Verifikasi</button>
        </form>
    </div>
</body>
</html>