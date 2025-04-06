<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_modul'])) {
    $_SESSION['id_modul'] = $_POST['id_modul'];
    header("Location: ../pesansekarang/akademi.php"); // Redirect setelah submit
    exit();
}
?>




<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
        <title>Akademi MLBB</title>
    <link rel="stylesheet" href="../src/output.css">
</head>
<body class="bg-black">

    <!-- Header Section -->
    <header>
        <div class="py-4 px-6 md:py-5 md:px-20 lg:py-7 lg:px-32 flex justify-between md:gap-20 lg:gap-32">
            <div>
                <a href="../mainpage.php" class="text-white text-2xl md:text-3xl lg:text-4xl font-extrabold italic">IML</a>
            </div>
            <div class="flex justify-between items-center gap-8 md:gap-12 lg:gap-16">
                <a href="../profile.php" class="text-white font-semibold text-base md:text-lg">Profile</a>
                <a href="../mainpage.php" class="text-white font-semibold text-base md:text-lg">Beranda</a>
                <a href="akademi.php" class="text-stack-orange font-semibold text-base md:text-lg">
                    <p class="drop-shadow-[0_0_15px_4px_rgba(255,120,0,0.9)]">Transaksi</p>
                </a>
                <a href="../berita.php" class="text-white font-semibold text-base md:text-lg">Berita</a>
                <a href="../index.php">
                    <button class="bg-stack-orange px-4 py-2 md:px-6 md:py-2.5 lg:px-8 lg:py-3 rounded-xl text-white font-semibold font-poppins block active:scale-95 hover:bg-orange-hover active:bg-orange-active shadow-lg hover:scale-105 transition duration-300 hover:shadow-[0_0_15px_4px_rgba(255,120,0,0.9)] cursor-pointer">
                        Log Out
                    </button>
                </a>
            </div>  
        </div>
    </header>
    

    <!-- Pilihan Section -->
        <section class="max-w-screen">
            <div class="flex pt-16 px-10 md:pt-20 md:px-24 lg:px-32 gap-6 md:gap-12">
                <a href="akademi.php">
                    <button class="bg-stack-orange px-8 py-3 md:px-12 md:py-3 lg:px-16 lg:py-4 rounded-xl text-white font-semibold font-poppins block active:scale-95 hover:bg-orange-hover active:bg-orange-active hover:scale-105 transition duration-300 shadow-[0_0_15px_4px_rgba(255,120,0,0.9)] text-lg md:text-xl">
                        Akademi MLBB
                    </button>
                </a>            
                <a href="coaching.php">
                    <button class="bg-stack-orange px-8 py-3 md:px-12 md:py-3 lg:px-16 lg:py-4 rounded-xl text-white font-semibold font-poppins block active:scale-95 hover:bg-orange-hover active:bg-orange-active shadow-md hover:scale-105 transition duration-300 hover:shadow-[0_0_15px_4px_rgba(255,120,0,0.9)] text-lg md:text-xl">
                        Private Online Coaching
                    </button>
                </a>
                <a href="topup.php">
                    <button class="bg-stack-orange px-8 py-3 md:px-12 md:py-3 lg:px-16 lg:py-4 rounded-xl text-white font-semibold font-poppins block active:scale-95 hover:bg-orange-hover active:bg-orange-active shadow-md hover:scale-105 transition duration-300 hover:shadow-[0_0_15px_4px_rgba(255,120,0,0.9)] text-lg md:text-xl">
                        Top Up Diamond
                    </button>
                </a>
            </div>
        </section>
        
    <!-- Product Section -->
    <section class="max-w-screen">
        <section class="flex items-center px-10 md:px-24 lg:px-32 gap-4 md:gap-6 py-12 md:py-16">
            <h2 class="text-white text-3xl md:text-4xl lg:text-5xl italic whitespace-nowrap">
                <span class="text-stack-orange">Product</span> Category
            </h2>
            <div class="flex-grow border-t border-white"></div>
        </section>
    </section>
    

    <!-- Modul Section -->
    <section class="w-full px-8 md:px-12 lg:px-16 py-10">
        <div class="flex flex-col gap-20">
        
        <!-- Modul Item 1-->
        <div class="flex flex-col lg:flex-row items-center gap-10 lg:gap-30">
            <img src="../img/Akademimlbb/modul1.png" alt="Chooseable Hero Guide" class="w-full max-w-md lg:max-w-xl">
            <div class="text-white">
                <h1 class="text-5xl lg:text-6xl font-semibold"><span class="text-stack-orange">Chooseable</span> Hero Guide</h1>
                <h4 class="mt-5 font-semibold">MATERI 1 - KELAS ONLINE VIA DISCORD</h4>
                <p class="mt-4 text-lg max-w-2xl">Dalam Materi ini kita akan membahas mengenai pembagian role pada suatu hero. Pada dasarnya tugas dalam suatu permainan tersebut dibagi berdasarkan oleh atribut & kemampuan hero, sehingga sebenarnya pembagian pada suatu hero terbagi menjadi 18 Role secara detail. Melalui materi ini kamu akan mengetahui pembagian Role secara keseluruhan dengan detail yang harus kamu terapkan di dalam game, dengan tujuan nantinya kamu dapat memaksimalkan kemampuan hero tersebut secara efektif dan mengetahui draft pick hero lebih dalam lagi.</p>
                <div class="bg-white h-[1px] mt-7"></div>
                <h1 class="text-4xl font-bold mt-4">Rp. 100,000,-</h1>
                <form action="" method="POST">
                    <input type="hidden" name="id_modul" value="1">
                    <button class="mt-4 bg-stack-orange px-68 py-2 rounded-xl text-white font-semibold block active:scale-95 hover:bg-orange-hover active:bg-orange-active shadow-xl transition duration-300 hover:shadow-[0_0_20px_5px_rgba(255,120,0,0.9)]">
                        Pesan Sekarang
                    </button>
                </a>
                </form>
            </div>
        </div>

        <!-- Modul Item 2-->
        <div class="flex flex-col lg:flex-row items-center gap-10 lg:gap-30">
            <img src="../img/Akademimlbb/modul2.png" alt="Itemization Guide" class="w-full max-w-md lg:max-w-xl">
            <div class="text-white">
                <h1 class="text-5xl lg:text-6xl font-semibold"><span class="text-stack-orange">Itemization</span> Guide</h1>
                <h4 class="mt-5 font-semibold">MATERI 2 - KELAS ONLINE VIA DISCORD</h4>
                <p class="mt-4 text-lg max-w-2xl">Dalam Materi ini kita akan membahas mengenai pola pikir yang perlu kamu tanam untuk memilih pembelian item secara efektif. Pembelian item tidak hanyalah dibeli berdasarkan kemampuan hero saja, melainkan kamu perlu melihat kondisi dan adaptasi dengan apa yang yang sedang terjadi dalam game tersebut. Tujuan dari mindset ini agar kamu dapat memaksimalkan hero dan potensi item tersebut sehingga build item pada hero kamu lebih kuat.</p>
                <div class="bg-white h-[1px] mt-7"></div>
                <h1 class="text-4xl font-bold mt-4">Rp. 100,000,-</h1>
                <form action="" method="POST">
                    <input type="hidden" name="id_modul" value="2">
                    <button class="mt-4 bg-stack-orange px-68 py-2 rounded-xl text-white font-semibold block active:scale-95 hover:bg-orange-hover active:bg-orange-active shadow-xl transition duration-300 hover:shadow-[0_0_20px_5px_rgba(255,120,0,0.9)]">
                        Pesan Sekarang
                    </button>
                </a>
                </form>
            </div>
        </div>

            <!-- Modul Item 3-->
        <div id="mapping" class="flex flex-col lg:flex-row items-center gap-10 lg:gap-30">
            <img src="../img/Akademimlbb/modul3.png" alt="Itemization Guide" class="w-full max-w-md lg:max-w-xl">
            <div class="text-white">
                <h1 class="text-5xl lg:text-6xl font-semibold"><span class="text-stack-orange">Mapping</span> Guide</h1>
                <h4 class="mt-5 font-semibold">MATERI 3 - KELAS ONLINE VIA DISCORD</h4>
                <p class="mt-4 text-lg max-w-2xl">Dalam Materi ini kita akan membahas mengenai cara kita meningkatkan kepekaan kita terhadap Map dan mengontrol alur permainan yang sedang kita pegang. Pemahaman ini akan didasari oleh logika team kamu dalam menganalisis pergerakan lawan di Map serta apa yang perlu kamu lakukan untuk bereaksi terhadap gerakan tersebut. Beberapa isi dari Materi ini akan menjelaskan semua detik yang terdapat dalam object map, serta nama & manfaat bush dalam Mobile Legends</p>
                <div class="bg-white h-[1px] mt-7"></div>
                <h1 class="text-4xl font-bold mt-4">Rp. 100,000,-</h1>
                <form action="" method="POST">
                    <input type="hidden" name="id_modul" value="3">
                    <button class="mt-4 bg-stack-orange px-68 py-2 rounded-xl text-white font-semibold block active:scale-95 hover:bg-orange-hover active:bg-orange-active shadow-xl transition duration-300 hover:shadow-[0_0_20px_5px_rgba(255,120,0,0.9)]">
                        Pesan Sekarang
                    </button>
                </a>
                </form>
            </div>
        </div>

        <!-- Modul Item 4-->
        <div id="role" class="flex flex-col lg:flex-row items-center gap-10 lg:gap-30">
            <img src="../img/Akademimlbb/modul4.png" alt="Itemization Guide" class="w-full max-w-md lg:max-w-xl">
            <div class="text-white">
                <h1 class="text-5xl lg:text-6xl font-semibold"><span class="text-stack-orange">Chooseable</span> Role Guide</h1>
                <h4 class="mt-5 font-semibold">MATERI 2 - KELAS ONLINE VIA DISCORD</h4>
                <p class="mt-4 text-lg max-w-2xl">Dalam Materi ini kita akan membahas mengenai pembagian role pada suatu hero. Pada dasarnya tugas dalam suatu permainan tersebut dibagi berdasarkan oleh atribut & kemampuan hero, sehingga sebenarnya pembagian pada suatu hero terbagi menjadi 18 Role secara detail. Melalui materi ini kamu akan mengetahui pembagian Role secara keseluruhan dengan detail yang harus kamu terapkan di dalam game, dengan tujuan nantinya kamu dapat memaksimalkan kemampuan hero tersebut secara efektif dan mengetahui draft pick hero lebih dalam lagi.</p>
                <div class="bg-white h-[1px] mt-7"></div>
                <h1 class="text-4xl font-bold mt-4">Rp. 100,000,-</h1>
                <form action="" method="POST">
                    <input type="hidden" name="id_modul" value="4">
                    <button class="mt-4 bg-stack-orange px-68 py-2 rounded-xl text-white font-semibold block active:scale-95 hover:bg-orange-hover active:bg-orange-active shadow-xl transition duration-300 hover:shadow-[0_0_20px_5px_rgba(255,120,0,0.9)]">
                        Pesan Sekarang
                    </button>
                </a>
                </form>
            </div>
        </div>

            <!-- Modul Item 5-->
        <div id="drafting" class="flex flex-col lg:flex-row items-center gap-10 lg:gap-30">
            <img src="../img/Akademimlbb/modul5.png" alt="Itemization Guide" class="w-full max-w-md lg:max-w-xl">
            <div class="text-white">
                <h1 class="text-5xl lg:text-6xl font-semibold"><span class="text-stack-orange">Drafting</span> Guide</h1>
                <h4 class="mt-5 font-semibold">MATERI 2 - KELAS ONLINE VIA DISCORD</h4>
                <p class="mt-4 text-lg max-w-2xl">Pada Materi ini kita akan membahas mengenai rencana yang sudah kamu tentukan, dalam strategi draft kamu harus memiliki hubungan antara dalam hero yang kamu pilih dengan pengimplementasiannya ketika di dalam game. Jangan sampai kalian hanya melakukan pemilihan draft untuk sekedar counter-mengcounter hero saja, melainkan kalian harus memiliki tujuan khusus dalam memilih hero agar strategi kalian dapat berjalan secara maksimal.x</p>
                <div class="bg-white h-[1px] mt-7"></div>
                <h1 class="text-4xl font-bold mt-4">Rp. 100,000,-</h1>
                <form action="" method="POST">
                    <input type="hidden" name="id_modul" value="5">
                    <button class="mt-4 bg-stack-orange px-68 py-2 rounded-xl text-white font-semibold block active:scale-95 hover:bg-orange-hover active:bg-orange-active shadow-xl transition duration-300 hover:shadow-[0_0_20px_5px_rgba(255,120,0,0.9)]">
                        Pesan Sekarang
                    </button>
                </a>
                </form>
            </div>
        </div>      
    </div>
</section>

        <!-- Footer -->
        <div class="mt-24 mb-10 mx-auto w-full">
            <div class="bg-white py-[1px] w-full"></div>
            <div class="flex flex-col text-center justify-center text-white mt-8 px-4">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold italic">IML</h1>
                <p class="mt-4 font-bold text-lg md:text-xl lg:text-2xl">+6281XXXXXXX | email@gmail.com</p>
                <p class="font-bold text-lg md:text-xl lg:text-2xl">Copyright © 2025 All rights reserved</p>
            </div>
        </div>
</body>
</html>