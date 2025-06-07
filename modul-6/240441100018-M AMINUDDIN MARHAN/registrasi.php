<?php
include "connect.php";
session_start();

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usn = trim($_POST['username']);
    $pw_plain = $_POST['password'];

    if (empty($usn) || empty($pw_plain)) {
        $error = "Username dan password tidak boleh kosong.";
    } else {
        $pw_hashed = password_hash($pw_plain, PASSWORD_DEFAULT);

        // Cek apakah username sudah terdaftar
        $check = $conn->prepare("SELECT id FROM admin WHERE username = ?");
        $check->bind_param("s", $usn);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $error = "Username sudah digunakan. Silakan pilih yang lain.";
        } else {
            $stmt = $conn->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");
            if ($stmt) {
                $stmt->bind_param("ss", $usn, $pw_hashed);
                if ($stmt->execute()) {
                    $success = "Registrasi berhasil! Silakan login.";
                    header("Location: login.php");
                    exit();
                } else {
                    $error = "Gagal menyimpan data: " . $stmt->error;
                }
                $stmt->close();
            } else {
                $error = "Gagal menyiapkan statement: " . $conn->error;
            }
        }

        $check->close();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Admin</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="container font-serif">
    <h2 class="text-center text-2xl font-bold my-7">Registrasi Admin</h2>

    <?php if (!empty($error)): ?>
        <p class="text-red-600 text-center"><?= $error ?></p>
    <?php elseif (!empty($success)): ?>
        <p class="text-red-600 text-center"><?= $success ?></p>
    <?php endif; ?>

    <div class="w-4/12 mx-auto bg-gray-200 p-3 rounded-lg shadow-slate-900 shadow-md mt-24 mb-5">
        <form method="post" action="">
            <label class="font-semibold my-1 text-md">Username</label><br>
            <input type="text" name="username" required class="border-2 border-cyan-500 w-11/12 rounded-lg p-1 mt-1 mb-3 focus:outline-none focus:ring-1 focus:ring-cyan-600"><br>

            <label class="font-semibold my-1 text-md">Password</label><br>
            <input type="password" name="password" required class="border-2 border-cyan-500 w-11/12 rounded-lg p-1 mt-1 mb-3 focus:outline-none focus:ring-1 focus:ring-cyan-600"><br>

            <div class="flex justify-center items-center">
                <button type="submit" class="border-2 border-cyan-500 py-1 px-3 rounded-lg transition hover:bg-cyan-600 hover:border-cyan-600 hover:text-white mt-3">Registrasi</button>
            </div>
        </form>
        <p class="text-center mt-10">Sudah punya akun? <a href="login.php" class="text-blue-600 hover:underline">Login di sini</a></p>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.querySelector("form");
        form.addEventListener("submit", function (e) {
            const username = form.username.value.trim();
            const password = form.password.value;

            let pesanError = "";

            if (username.length < 5) {
                pesanError += "Username minimal 5 karakter.\n";
            }

            if (password.length < 8) {
                pesanError += "Password minimal 8 karakter.\n";
            }

            if (pesanError !== "") {
                alert(pesanError);
                e.preventDefault();
            }
        });
    });
    </script>
</body>
</html>