<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Interaktif Mahasiswa</title>
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
        Profil Interaktif
    </h1>

    <table class="border-collapse w-full mt-5 mb-10">
        <tr>
            <th class="bg-gray-300 font-semibold p-1 border-2">Informasi</th>
            <th class="bg-gray-300 font-semibold p-1 border-2">Detail</th>
        </tr>
        <tr>
            <td class="border-2 p-1">Nama</td>
            <td  class="border-2 p-1">M. Aminuddin Marhan</td>
        </tr>
        <tr>
            <td class="border-2 p-1">NIM</td>
            <td class="border-2 p-1">240441100018</td>
        </tr>
        <tr>
            <td class="border-2 p-1">Tempat, Tanggal Lahir</td>
            <td class="border-2 p-1">Surabaya, 26 Februari 2006</td>
        </tr>
        <tr>
            <td class="border-2 p-1">Email</td>
            <td class="border-2 p-1">aaminuddin81@gmail.com</td>
        </tr>
        <tr>
            <td class="border-2 p-1">Nomor HP</td>
            <td class="border-2 p-1">+62 858-3052-1398</td>
        </tr>
    </table>

    <p class="text-center text-2xl font-bold m-2">
        Form
    </p>

    <form method="post" action="">
        <label class="font-semibold">Bahasa Pemrograman yang Dikuasai</label><br>
        <div id="bahasa">
            <input type="text" name="bahasa[]" class="border-2 rounded-lg border-gray-400 w-7/12 p-1 m-1"><br>
        </div>
        <button type="button" onclick="tambah()" class="bg-yellow-300 border-2 p-2 m-1 mb-4 rounded-md hover:bg-yellow-500 transition hover:transition duration-200">
            Tambah Bahasa
        </button><br>

        <label class="font-semibold">Penjelasan Singkat Pengalaman Membuat Projek</label><br>
        <textarea name="pengalaman" class="border-2 border-gray-400 rounded-lg w-7/12 h-24 p-1 m-1 mb-4"></textarea><br>

        <label class="font-semibold">Software yang Sering Digunakan</label><br>
        <input type="checkbox" name="software[]" value="VS Code" class="m-2 w-4 h-4">VS Code
        <input type="checkbox" name="software[]" value="Figma" class="m-2 w-4 h-4">Figma
        <input type="checkbox" name="software[]" value="Word" class="m-2 w-4 h-4 mb-4">Word<br>

        <label class="font-semibold">Sistem Operasi yang Digunakan</label><br>
        <input type="radio" name="os" value="Windows" class="m-2 w-4 h-4">Windows
        <input type="radio" name="os" value="Linux" class="m-2 w-4 h-4">Linux
        <input type="radio" name="os" value="MacOS" class="m-2 w-4 h-4 mb-4">MacOS<br>

        <label class="font-semibold">Tingkat Penguasaan PHP</label><br>
        <select name="tingkat_php" class="border-2 border-gray-400 rounded-lg p-1 m-1 mb-4">
            <option value="Pemula">Pemula</option>
            <option value="Menengah">Menengah</option>
            <option value="Mahir">Mahir</option>
        </select><br>

        <input type="submit" value="Submit" class="bg-gray-300 px-3 py-2 m-3 ml-1 rounded-lg border-2 font-semibold hover:bg-gray-400 transition hover:transition duration-200">
    </form>

    <?php
    function tampilkan($bahasa, $software, $os, $tingkat_php, $pengalaman) {
        $output = "
            <p class='text-2xl font-bold mt-7  mb-2 text-center'>Hasil</p>
            <table class='border-collapse w-full mb-4'>
                <tr>
                    <th class='border-2 bg-gray-200 p-1 text-center font-semibold'>Kategori</th>
                    <th class='border-2 bg-gray-200 p-1 text-center font-semibold'>Isi</th>
                </tr>
                <tr>
                    <td class='border-2 p-1'>Bahasa Pemrograman</td>
                    <td class='border-2 p-1'>" . htmlspecialchars(implode(', ', $bahasa)) . "</td>
                </tr>
                <tr>
                    <td class='border-2 p-1'>Software yang Sering Digunakan</td>
                    <td class='border-2 p-1'>" . htmlspecialchars(implode(', ', $software)) . "</td>
                </tr>
                <tr>
                    <td class='border-2 p-1'>Sistem Operasi</td>
                    <td class='border-2 p-1'>" . htmlspecialchars($os) . "</td>
                </tr>
                <tr>
                    <td class='border-2 p-1'>Tingkat Penguasaan PHP</td>
                    <td class='border-2 p-1'>" . htmlspecialchars($tingkat_php) . "</td>
                </tr>
            </table>
            <p class='mb-4'><strong>Pengalaman Proyek:</strong><br>" . nl2br(htmlspecialchars($pengalaman)) . "</p>
        ";
        if (count(array_filter($bahasa)) > 2) {
            $output .= "<p class='mb-4 text-green-600 font-semibold'>Anda cukup berpengalaman dalam pemrograman!</p>";
        }
        return $output;
    }

    $error = '';
    $hasil = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (
            empty($_POST["bahasa"]) ||
            empty($_POST["pengalaman"]) ||
            empty($_POST["software"]) ||
            empty($_POST["os"]) ||
            empty($_POST["tingkat_php"])
        ) {
            $error = "Semua input wajib diisi!";
        } else {
            $bahasa = $_POST["bahasa"];
            $pengalaman = htmlspecialchars($_POST["pengalaman"]);
            $software = $_POST["software"];
            $os = $_POST["os"];
            $tingkat_php = $_POST["tingkat_php"];

            $hasil = tampilkan($bahasa, $software, $os, $tingkat_php, $pengalaman);
        }
    }

    if (!empty($error)) {
        echo "<p class='mb-4 text-red-600 font-semibold mt-6'>$error</p>";
    } elseif (!empty($hasil)) {
        echo $hasil;
    }
    ?>
    </div>

    <script>
        function tambah() {
            const container = document.getElementById('bahasa');
            const inputBaru = document.createElement('input');
            inputBaru.type = 'text';
            inputBaru.name = 'bahasa[]';
            inputBaru.className = 'border-2 rounded-lg border-gray-400 w-7/12 p-1 m-1 mb-4 block';
            container.appendChild(inputBaru);
        }
    </script>
</body>
</html>