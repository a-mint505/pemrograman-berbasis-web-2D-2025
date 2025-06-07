<?php
include "connect.php";
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Tangani aksi POST terlebih dahulu
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah-absen'])) {
    $nip = $_POST["nip"];
    $nama = $_POST["nama"];
    $tanggal_absensi = $_POST["tanggal_absensi"];
    $jam_masuk = $_POST["jam_masuk"];
    $jam_pulang = $_POST["jam_pulang"];

    // Cek apakah absensi untuk tanggal ini sudah ada
    $cek = mysqli_prepare($conn, "SELECT COUNT(*) FROM karyawan_absensi WHERE nip = ? AND tanggal_absensi = ?");
    mysqli_stmt_bind_param($cek, "ss", $nip, $tanggal_absensi);
    mysqli_stmt_execute($cek);
    mysqli_stmt_bind_result($cek, $count);
    mysqli_stmt_fetch($cek);
    mysqli_stmt_close($cek);

    if ($count > 0) {
        $error = "Absensi dengan tanggal ini untuk karyawan tersebut sudah ada.";
    } elseif ($jam_masuk >= $jam_pulang) {
        $error = "Jam masuk harus lebih awal dari jam pulang.";
    } else {
        $query = "INSERT INTO karyawan_absensi (nip, nama, tanggal_absensi, jam_masuk, jam_pulang) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssss", $nip, $nama, $tanggal_absensi, $jam_masuk, $jam_pulang);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            header("Location: absen.php");
            exit;
        } else {
            $error = "Gagal menambahkan data: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    }
}

// Ambil data karyawan jika `nip` ada di URL
$data = null;
if (isset($_GET['nip'])) {
    $nip = $_GET['nip'];
    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE nip = ?");
    mysqli_stmt_bind_param($stmt, "s", $nip);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
}

// Ambil semua user untuk ditampilkan di tabel
$query_users = "SELECT * FROM users";
$result_users = mysqli_query($conn, $query_users);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Absensi</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="container font-serif">
    <div class="bg-blue-300 p-1 py-3">
        <a href="absen.php" class="text-lg font-semibold m-2 ml-4 hover:underline">← Kembali ke Daftar Absensi</a>
    </div>

    <h2 class="text-center text-2xl font-bold my-7">Daftar Karyawan</h2>

    <table class="border-2 mx-auto w-5/12 mb-10">
        <tr class="bg-gray-300">
            <th class="border-2 p-1">NIP</th>
            <th class="border-2 p-1">Nama</th>
            <th class="border-2 p-1">Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result_users)) : ?>
        <tr>
            <td class="border-2 p-1"><?= htmlspecialchars($row['nip']) ?></td>
            <td class="border-2 p-1"><?= htmlspecialchars($row['nama']) ?></td>
            <td class="border-2 p-1 text-center">
                <a href="?nip=<?= urlencode($row['nip']) ?>" class="text-blue-600 hover:underline">Tambah absen</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <?php if ($data): ?>
        <hr class="border-2">
        <h2 class="font-semibold text-center my-7 text-2xl">Tambah Absensi Karyawan</h2>

        <?php if (isset($error)): ?>
            <p class="text-red-600 text-center font-semibold mb-4"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <div class="w-5/12 bg-gray-200 mx-auto p-3 rounded-lg shadow-slate-900 shadow-md mb-5">
            <p class="text-center font-bold">NIP: <?= htmlspecialchars($data["nip"]) ?></p>
            <p class="text-center font-bold">Nama: <?= htmlspecialchars($data["nama"]) ?></p>

            <form method="post">
                <input type="hidden" name="nip" value="<?= htmlspecialchars($data['nip']) ?>">
                <input type="hidden" name="nama" value="<?= htmlspecialchars($data['nama']) ?>">

                <label for="tanggal_absensi" class="font-semibold my-1 text-md">Tanggal Absensi</label><br>
                <input type="date" id="tanggal_absensi" name="tanggal_absensi" required class="border-2 border-cyan-500 w-11/12 rounded-lg p-1 mt-1 mb-3 focus:outline-none focus:ring-1 focus:ring-cyan-600"><br>

                <label for="jam_masuk" class="font-semibold my-1 text-md">Jam Masuk</label><br>
                <input type="time" id="jam_masuk" name="jam_masuk" required class="border-2 border-cyan-500 w-11/12 rounded-lg p-1 mt-1 mb-3 focus:outline-none focus:ring-1 focus:ring-cyan-600"><br>

                <label for="jam_pulang" class="font-semibold my-1 text-md">Jam Pulang</label><br>
                <input type="time" id="jam_pulang" name="jam_pulang" required class="border-2 border-cyan-500 w-11/12 rounded-lg p-1 mt-1 mb-3 focus:outline-none focus:ring-1 focus:ring-cyan-600"><br><br>
                
                <div class="flex justify-center items-center">
                    <button type="submit" name="tambah-absen" class="border-2 border-cyan-500 py-1 px-3 rounded-lg transition hover:bg-cyan-600 hover:border-cyan-600 hover:text-white mt-2">Tambah Absensi</button>
                </div>
            </form>
        </div>
    <?php endif; ?>
</body>
</html>