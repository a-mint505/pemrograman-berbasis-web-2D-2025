<?php
include "connect.php";
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$nip = $_GET['nip'];

$stmt = mysqli_prepare($conn, "DELETE FROM users WHERE nip = ?");
mysqli_stmt_bind_param($stmt, "s", $nip);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header("Location: karyawan.php");
exit();
?>