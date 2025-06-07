<?php
include "connect.php";
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$hasil = mysqli_query($conn, "
    SELECT a.*, u.nama 
    FROM karyawan_absensi a 
    LEFT JOIN users u ON a.nip = u.nip 
    ORDER BY a.tanggal_absensi DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Karyawan</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="container font-serif">
    <div class="bg-blue-300 p-1 justify-between flex">
        <p class="text-xl font-semibold m-2 ml-4">Admin: <?= htmlspecialchars($_SESSION['username']) ?></p>
        <div class="flex text-lg font-semibold my-auto">
            <table class="mr-4">
                <tr>
                    <td class="border-x-2 mx-2">
                        <a href="tambah_absen.php" class="mx-2 hover:underline">Tambah Absensi</a>
                    </td>
                    <td class="border-x-2 mx-2">
                        <a href="karyawan.php" class="mx-2 hover:underline">Karyawan</a>
                    </td>
                    <td class="border-x-2 mr-4 ml-2">
                        <a href="logout.php" class="mx-2 hover:underline">Logout</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <h2 class="text-center text-2xl font-bold my-7">Data Absensi Karyawan</h2>

    <table class="border-2 mx-auto w-7/12">
        <tr class="bg-gray-300">
            <th class="border-2 p-1">NIP</th>
            <th class="border-2 p-1">Nama</th>
            <th class="border-2 p-1">Tanggal Absensi</th>
            <th class="border-2 p-1">Jam Masuk</th>
            <th class="border-2 p-1">Jam Pulang</th>
        </tr>
        <?php while ($kolom = mysqli_fetch_assoc($hasil)) : ?>
        <tr class="border-2">
            <td class="border-2 p-1"><?= $kolom['nip'] ?></td>
            <td class="border-2 p-1"><?= $kolom['nama'] ?></td>
            <td class="border-2 p-1"><?= $kolom['tanggal_absensi'] ?></td>
            <td class="border-2 p-1"><?= $kolom['jam_masuk'] ?></td>
            <td class="border-2 p-1"><?= $kolom['jam_pulang'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>