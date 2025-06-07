<?php
include "connect.php";
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usn = $_POST['username'];
    $pw = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM admin WHERE username = ?");
    $stmt->bind_param("s", $usn);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_pw);
        $stmt->fetch();

        if (password_verify($pw, $hashed_pw)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $usn;
            header("Location: karyawan.php");
            exit();
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Username tidak ditemukan.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="container font-serif">
    <h2 class="text-center text-2xl font-bold my-7">Login Admin</h2>

    <?php if (!empty($error)) : ?>
        <p class="text-red-600 text-center"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <div class="w-4/12 mx-auto bg-gray-200 p-3 rounded-lg shadow-slate-900 shadow-md mt-24 mb-5">
        <form method="post" action="">
            <label class="font-semibold my-1 text-md">Username</label><br>
            <input type="text" name="username" required class="border-2 border-cyan-500 w-11/12 rounded-lg p-1 mt-1 mb-3 focus:outline-none focus:ring-1 focus:ring-cyan-600"><br>

            <label class="font-semibold my-1 text-md">Password</label><br>
            <input type="password" name="password" required class="border-2 border-cyan-500 w-11/12 rounded-lg p-1 mt-1 mb-3 focus:outline-none focus:ring-1 focus:ring-cyan-600"><br>

            <div class="flex justify-center items-center">
                <button type="submit" class="border-2 border-cyan-500 py-1 px-3 rounded-lg transition hover:bg-cyan-600 hover:border-cyan-600 hover:text-white mt-3">Login</button>
            </div>
        </form>

        <p class="text-center mt-10">Belum punya akun? <a href="registrasi.php" class="text-blue-600 hover:underline">Registrasi di sini</a></p>
    </div>
</body>
</html>