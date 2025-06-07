<?php
include "connect.php";
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}$error_message = "";

if (isset($_POST["tambah-karyawan"])) {
    $nip = $_POST["nip"];
    $nama = $_POST["nama"];
    $umur = $_POST["umur"];
    $jenis_kelamin = $_POST["jenis_kelamin"];
    $departemen = $_POST["departemen"];
    $jabatan = $_POST["jabatan"];
    $kota_asal = $_POST["kota_asal"];

    // Cek apakah NIP sudah ada
    $cek_stmt = mysqli_prepare($conn, "SELECT nip FROM users WHERE nip = ?");
    mysqli_stmt_bind_param($cek_stmt, "s", $nip);
    mysqli_stmt_execute($cek_stmt);
    mysqli_stmt_store_result($cek_stmt);

    if (mysqli_stmt_num_rows($cek_stmt) > 0) {
        $error_message = "NIP sudah digunakan oleh karyawan lain.";
    } else {
        // SQL query INSERT
        $query = "INSERT INTO users 
        (nip, nama, umur, jenis_kelamin, departemen, jabatan, kota_asal) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssissss",
            $nip, $nama, $umur, $jenis_kelamin,
            $departemen, $jabatan, $kota_asal
        );

        if (mysqli_stmt_execute($stmt)) {
            header("Location: karyawan.php");
            exit();
        } else {
            $error_message = "Gagal menambahkan data: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    }

    mysqli_stmt_close($cek_stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Karyawan</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="container font-serif">
    <div class="bg-blue-300 p-1 py-3">
        <a href="karyawan.php" class="text-lg font-semibold m-2 ml-4 hover:underline">← Kembali ke Daftar Karyawan</a>
    </div>
    
    <h2 class="text-center text-2xl font-bold my-7">Tambah Karyawan</h2>

    <?php if (!empty($error_message)): ?>
        <p class="text-center text-red-600 font-semibold mb-4"><?= htmlspecialchars($error_message) ?></p>
    <?php endif; ?>
    
    <div class="w-6/12 mx-auto bg-gray-100 p-3 rounded-lg shadow-slate-900 shadow-md mb-5">
        <form method="post" action="">
            <label class="font-semibold my-1 text-md">NIP Karyawan</label><br>
            <input type="text" name="nip" required class="border-2 border-cyan-500 w-11/12 rounded-lg p-1 mt-1 mb-3 focus:outline-none focus:ring-1 focus:ring-cyan-600"><br>

            <label class="font-semibold my-1 text-md">Nama Karyawan</label><br>
            <input type="text" name="nama" required class="border-2 border-cyan-500 w-11/12 rounded-lg p-1 mt-1 mb-3 focus:outline-none focus:ring-1 focus:ring-cyan-600"><br>

            <label class="font-semibold my-1 text-md">Umur Karyawan</label><br>
            <input type="number" name="umur" required class="border-2 border-cyan-500 w-11/12 rounded-lg p-1 mt-1 mb-3 focus:outline-none focus:ring-1 focus:ring-cyan-600"><br>

            <label class="font-semibold my-1 text-md">Jenis Kelamin Karyawan</label><br>
            <select name="jenis_kelamin" required class="border-2 border-cyan-500 rounded-lg p-1 mt-1 mb-3 focus:outline-none focus:ring-1 focus:ring-cyan-600">
                <option value="Laki-laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
            </select><br>

            <label class="font-semibold my-1 text-md">Departemen Karyawan</label><br>
            <input type="text" name="departemen" required class="border-2 border-cyan-500 w-11/12 rounded-lg p-1 mt-1 mb-3 focus:outline-none focus:ring-1 focus:ring-cyan-600"><br>

            <label class="font-semibold my-1 text-md">Jabatan Karyawan</label><br>
            <input type="text" name="jabatan" required class="border-2 border-cyan-500 w-11/12 rounded-lg p-1 mt-1 mb-3 focus:outline-none focus:ring-1 focus:ring-cyan-600"><br>

            <label class="font-semibold my-1 text-md">Kota Asal Karyawan</label><br>
            <input type="text" name="kota_asal" required class="border-2 border-cyan-500 w-11/12 rounded-lg p-1 mt-1 mb-3 focus:outline-none focus:ring-1 focus:ring-cyan-600"><br>

            <div class="flex justify-center items-center">
                <button type="submit" name="tambah-karyawan" class="border-2 border-cyan-500 py-1 px-3 rounded-lg transition hover:bg-cyan-600 hover:border-cyan-600 hover:text-white mt-2">Tambah Data</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("form");
            const nipInput = document.querySelector("input[name='nip']");
            const namaInput = document.querySelector("input[name='nama']");
            const departemenInput = document.querySelector("input[name='departemen']");
            const jabatanInput = document.querySelector("input[name='jabatan']");
            const kotaAsalInput = document.querySelector("input[name='kota_asal']");

            form.addEventListener("submit", function(event) {
                const nipValue = nipInput.value;
                const namaValue = namaInput.value;
                const departemenValue = departemenInput.value;
                const jabatanValue = jabatanInput.value;
                const kotaAsalValue = kotaAsalInput.value;

                // Regex untuk validasi
                const validasiNip = /^\d+$/;
                const validasiNama = /^(?=.*[A-Za-z])[A-Za-z\s\-']+$/;
                const validasiDepartemen = /^[A-Za-z\s]+$/;
                const validasiJabatan = /^[A-Za-z\s\d]+$/;
                const validasiKotaAsal = /^[A-Za-z\s]+$/;

                if (!validasiNip.test(nipValue)) {
                    alert("NIP hanya boleh berupa angka.");
                    event.preventDefault();
                }
                if (!validasiNama.test(namaValue)) {
                    alert("Nama harus mengandung setidaknya satu huruf dan hanya boleh mengandung huruf, spasi, simbol '-' dan ''");
                    event.preventDefault();
                }
                if (!validasiDepartemen.test(departemenValue)) {
                    alert("Departemen hanya boleh mengandung huruf dan spasi");
                    event.preventDefault();
                }
                if (!validasiJabatan(jabatanValue)) {
                    alert("Jabatan hanya boleh mengandung huruf, spasi, dan angka");
                    event.preventDefault();
                }
                if (!validasiKotaAsal(kotaAsalValue)) {
                    alert("Kota Asal hanya boleh mengandung huruf dan spasi");
                    event.preventDefault();
                }
            });
        });
    </script>
</body>
</html>