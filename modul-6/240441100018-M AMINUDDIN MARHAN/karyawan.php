<?php
include "connect.php";
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Karyawan</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="container font-serif">
    <div class="bg-blue-300 p-1 justify-between flex">
        <p class="text-xl font-semibold m-2 ml-4">Admin: <?= htmlspecialchars($_SESSION['username']) ?></p>
        <div class="flex text-lg font-semibold my-auto">
            <table class="mr-4">
                <tr>
                    <td class="border-x-2 mx-2">
                        <a href="tambah_karyawan.php" class="mx-2 hover:underline">Tambah Karyawan</a>
                    </td>
                    <td class="border-x-2 mx-2">
                        <a href="absen.php" class="mx-2 hover:underline">Absensi</a>
                    </td>
                    <td class="border-x-2 mr-4 ml-2">
                        <a href="logout.php" class="mx-2 hover:underline">Logout</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <?php
    // Ambil data dari database
    $result = mysqli_query($conn, "SELECT * FROM users");
    ?>

    <h2 class="text-center text-2xl font-bold my-7">Data Karyawan</h2>

    <table class="border-2 mx-auto w-9/12">
        <tr class="bg-gray-300">
            <th class="border-2 p-1">NIP</th>
            <th class="border-2 p-1">Nama</th>
            <th class="border-2 p-1">Umur</th>
            <th class="border-2 p-1">Jenis Kelamin</th>
            <th class="border-2 p-1">Departemen</th>
            <th class="border-2 p-1">Jabatan</th>
            <th class="border-2 p-1">Kota Asal</th>
            <th class="border-2 p-1">Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr class="border-2">
            <td class="border-2 p-1"><?= $row['nip'] ?></td>
            <td class="border-2 p-1"><?= $row['nama'] ?></td>
            <td class="border-2 p-1"><?= $row['umur'] ?></td>
            <td class="border-2 p-1"><?= $row['jenis_kelamin'] ?></td>
            <td class="border-2 p-1"><?= $row['departemen'] ?></td>
            <td class="border-2 p-1"><?= $row['jabatan'] ?></td>
            <td class="border-2 p-1"><?= $row['kota_asal'] ?></td>
            <td class="px-1.5 py-1 flex justify-between">
                <p class="text-green-600 hover:underline"><a href="update_karyawan.php?nip=<?= $row['nip'] ?>">Edit</a></p>
                <p class="text-red-600 hover:underline"><a href="delete_karyawan.php?nip=<?= $row['nip'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</a></p>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>