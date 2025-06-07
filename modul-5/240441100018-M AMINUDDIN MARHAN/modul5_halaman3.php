<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Artikel Blog</title>
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
    <div class="max-w-10/12 container m-auto">
        <?php
        $artikel = [
            1 => [
                'judul' => 'Refleksi dan Catatan Tentang Semangat Kesukarelawanan',
                'tanggal' => 'Dec 12, 2024',
                'paragraf' => 'Artikel ini mengajak kita untuk merenungkan kembali makna kesukarelawanan yang tidak hanya tentang memberi, tetapi juga tentang belajar, berbagi, dan tumbuh bersama. Semangat sukarela mengingatkan kita bahwa kontribusi kecil dengan ketulusan hati bisa menciptakan dampak besar bagi masyarakat, sekaligus memperkaya jiwa dengan kepuasan yang tak ternilai.',
                'gambar' => 'image/artikel 1.jpg',
                'kutipan' => [
                    "Kesukarelawanan adalah bahasa universal yang dipahami oleh hati, di mana setiap aksi kecil adalah benih perubahan.",
                    "Ketika kita memberi tanpa pamrih, kita justru menerima lebih banyak: kebahagiaan, makna, dan hubungan yang mendalam.",
                    "Jadilah lentera bagi orang lain, karena dengan menyalakan jalan mereka, kita juga menerangi jalan sendiri."
                ],
                'sumber' => 'https://medium.com/komunitas-blogger-m/refleksi-semangat-kesukarelawanan-5eeac760daab'
            ],
            2 => [
                'judul' => 'Evaluasi dan Refleksi Diri, Caranya?',
                'tanggal' => 'Dec 11, 2023',
                'paragraf' => 'Artikel ini mengajak kita untuk melihat evaluasi dan refleksi diri bukan sebagai beban, tetapi sebagai alat pertumbuhan yang penuh kasih. Dengan menilai diri secara jujur namun tanpa menyalahkan, kita bisa mengenali pencapaian, kegagalan, dan pelajaran tersembunyi di balik setiap pengalaman. Refleksi yang efektif membutuhkan keberanian untuk jujur pada diri sendiri, sekaligus kerendahan hati untuk terus belajar dan berubah.',
                'gambar' => 'image/artikel 2.png',
                'kutipan' => [
                    "Evaluasi diri adalah cermin yang menunjukkan bukan hanya di mana kita berdiri, tetapi juga ke mana kita bisa melangkah.",
                    "Refleksi bukan tentang menghakimi masa lalu, tapi merancang masa depan dengan lebih bijak.",
                    "Ketika kita berhenti menyangkal dan mulai merefleksikan, di situlah pertumbuhan sejati dimulai."
                ],
                'sumber' => 'https://www.loveyourselfindonesia.com/2023/12/evaluasi-dan-refleksi-diri-caranya.html'
            ],
            3 => [
                'judul' => '7 Cara Membuat Refleksi Pembelajaran yang Efektif',
                'tanggal' => 'Mar 08, 2024',
                'paragraf' => 'Artikel ini memberikan panduan praktis tentang bagaimana melakukan refleksi pembelajaran secara efektif, menekankan pentingnya mengevaluasi proses belajar untuk meningkatkan pemahaman dan pertumbuhan diri. Refleksi bukan sekadar melihat kembali apa yang telah dipelajari, tetapi juga menganalisis tantangan, keberhasilan, serta langkah perbaikan ke depan. Dengan menerapkan metode yang sistematis, seperti mencatat poin-poin penting atau berdiskusi dengan orang lain, kita bisa mengubah pengalaman belajar menjadi peluang untuk berkembang lebih optimal.',
                'gambar' => 'image/artikel 3.png',
                'kutipan' => [
                    "Refleksi adalah jembatan antara pengalaman dan pembelajaran—tanpanya, pengetahuan hanya akan berlalu begitu saja.",
                    "Dengan merenungkan proses belajar, kita tidak hanya mengingat fakta, tetapi juga menemukan makna di balik setiap langkah.",
                    "Pembelajaran yang sesungguhnya dimulai ketika kita berhenti sejenak dan bertanya: 'Apa yang bisa aku ambil dari ini?'"
                ],
                'sumber' => 'https://blog.kejarcita.id/7-cara-membuat-refleksi-pembelajaran-yang-efektif/'
            ],
        ];

        function daftarArtikel($artikel) {
            echo "<h1 class='text-center text-3xl font-bold m-4'>
                    Daftar Artikel
                </h1>";
            foreach ($artikel as $i => $a) {
                echo "<div class='bg-gray-200 p-3 rounded-md shadow my-3 hover:bg-gray-300 transition hover:transition duration-200'>
                        <a href='modul5_halaman3.php?id=$i' class='text-lg font-semibold hover:text-blue-500 hover:underline transition'>" . htmlspecialchars($a['judul']) . "</a>
                        <p class='text-sm text-gray-600'>" . htmlspecialchars($a['tanggal']) . "</p>
                    </div>";
            }
        }

        function quote($q) {
            return $q[rand(0, count($q) - 1)];
        }

        function detailArtikel($article) {
            $random_quote = quote($article['kutipan']);
            echo "<h1 class='text-center text-3xl font-bold m-4'>
                    Blog Reflektif
                </h1>";
            echo "<div class='p-6'>";
            echo "<h2 class='text-2xl font-bold mb-2'>" . htmlspecialchars($article['judul']) . "</h2>";
            echo "<p class='text-sm text-gray-600 mb-4'>" . htmlspecialchars($article['tanggal']) . "</p>";
            echo "<img src='" . htmlspecialchars($article['gambar']) . "' alt='Ilustrasi' class='w-full h-full mb-4 rounded'>";
            echo "<p class='mb-4 text-justify'>" . htmlspecialchars($article['paragraf']) . "</p>";
            echo "<blockquote class='border-l-4 pl-4 italic text-gray-700 mb-4'>“" . htmlspecialchars($random_quote) . "”</blockquote>";
            if ($article['sumber']) {
                echo "<p class='mb-6'>Sumber: <a href='" . htmlspecialchars($article['sumber']) . "' target='_blank' class='text-blue-600 hover:underline'>" . $article['sumber'] . "</a></p>";
            }
            echo "<a href='modul5_halaman3.php' class='bg-gray-300 p-2 m-3 ml-0 rounded-lg border-2 transition hover:transition duration-200 font-semibold hover:bg-gray-400'>Kembali ke daftar artikel</a>";
            echo "</div>";
        }

        if (isset($_GET['id']) && isset($artikel[$_GET['id']])) {
            $id = $_GET['id'];
            $article = $artikel[$id];
            detailArtikel($article);
        } else {
            daftarArtikel($artikel);
        }
        ?>
    </div>
</body>
</html>