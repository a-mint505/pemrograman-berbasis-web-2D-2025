<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline Pengalaman Kuliah</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
    <div class="w-full py-1 bg-gray-700 flex justify-between">
        <div></div>
        <div class="p-3">
            <a href="modul5_halaman1.php" class="bg-white color-black p-1.5 mx-1 rounded-lg font-semibold hover:bg-gray-200">Profil Interaktif</a>
            <a href="modul5_halaman2.php" class="bg-white color-black p-1.5 mx-1 rounded-lg font-semibold hover:bg-gray-200">Timeline Kuliah</a>
            <a href="modul5_halaman3.php" class="bg-white color-black p-1.5 mr-2 ml-1 rounded-lg font-semibold hover:bg-gray-200">Blog/Artikel</a>
        </div>
    </div>

    <div class="max-w-10/12 container m-auto">
    <h1 class="text-center text-3xl font-bold m-4">
        Timeline Pengalaman Kuliah
    </h1>

    <div class="m-auto max-w-full">
        <?php
        function tampilkan($waktu, $kegiatan){
            echo "<div class='my-6 bg-inherit w-full'>";
            echo "<div class='px-3 py-3 bg-gray-200 w-full rounded-md hover:bg-gray-300 transition hover:transition duration-200'>";
            echo "<div class='font-bold mb-1 color-blue-500'>" . htmlspecialchars($waktu) . "</div>";
            echo "<p>" . htmlspecialchars($kegiatan) . "</p>";
            echo "</div>";
            echo "</div>";
        }

        $pengalaman = [
            [
                "waktu" => "Agustus - September 2024",
                "kegiatan" => "Awal masuk kuliah, mengikuti ospek Universitas, Fakultas, hingga Prodi, pertama kali mengikuti pembelajaran di kelas, mengikuti rentetan kegiatan ospek, dari ospek Prodi hingga UKM."
            ],
            [
                "waktu" => "Oktober - November 2024",
                "kegiatan" => "Awal praktikum semester 1, UTS, mengikuti kegiatan puncak ospek UKM dan Prodi, menjadi panitia event TechnoTainment,"
            ],
            [
                "waktu" => "Desember 2024 - Januari 2025",
                "kegiatan" => "UAS, akhir dari perkuliahan semester 1, libur semester."
            ],
            [
                "waktu" => "Februari - Maret 2025",
                "kegiatan" => "Masa pengisiam KRS, awal masuk perkuliahan semester 2, awal praktikum semester 2."
            ],
            [
                "waktu" => "April - Mei 2025",
                "kegiatan" => "UTS, menjadi panitian event IGTS."
            ]
        ];

            foreach($pengalaman as $i){
                tampilkan($i["waktu"], $i["kegiatan"]);
            }
        ?>
    </div>
    </div>
</body>
</html>