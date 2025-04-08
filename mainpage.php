<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php#openModal"); 
    exit();
}
$username = $_SESSION['username'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
        <title>IML</title>
    <link rel="stylesheet" href="./src/output.css">
</head>
<body class="bg-black">

    <!-- Header Section -->
    <header>
        <div class="py-4 px-6 md:py-5 md:px-20 lg:py-7 lg:px-32 flex justify-between md:gap-20 lg:gap-32">
            <div>
                <a href="mainpage.php" class="text-white text-2xl md:text-3xl lg:text-4xl font-extrabold italic">IML</a>
            </div>
            <div class="flex justify-between items-center gap-8 md:gap-12 lg:gap-16">
                <a href="profile.php" class="text-white font-semibold text-base md:text-lg">Profile</a>
                <a href="mainpage.php" class="text-stack-orange font-semibold text-base md:text-lg">Beranda</a>
                <a href="modul/akademi.php" class="text-white font-semibold text-base md:text-lg">
                    <p class="drop-shadow-[0_0_15px_4px_rgba(255,120,0,0.9)] btn-loading">Transaksi</p>
                </a>
                <a href="berita.php" class="text-white font-semibold text-base md:text-lg">Berita</a>
                <a href="logout.php">
                    <button class="bg-stack-orange px-4 py-2 md:px-6 md:py-2.5 lg:px-8 lg:py-3 rounded-xl text-white font-semibold font-poppins block active:scale-95 hover:bg-orange-hover active:bg-orange-active shadow-lg hover:scale-105 transition duration-300 hover:shadow-[0_0_15px_4px_rgba(255,120,0,0.9)] cursor-pointer">
                        Log Out
                    </button>
                </a>
            </div>  
        </div>
    </header>


    <!-- Hero Section -->
    <section class="min-h-screen relative">
        <div class="mt-24 py-12 px-6 md:px-12 lg:px-18 flex justify-end">
            <div>
                <div class="w-full md:w-[50%] lg:w-[50%]">
                    <h1 class="text-white font-extrabold text-5xl md:text-6xl lg:text-7xl mb-6 md:mb-8 lg:mb-10 font-hero">
                        Welcome 
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-500 to-orange-500"><?php echo htmlspecialchars($username); ?></span>
                    </h1>
                </div>
                <div class="w-full md:w-[50%] lg:w-[55%]"> 
                    <p class="text-white font-semibold text-xl md:text-2xl lg:text-4xl font-hero">
                        Bergabunglah menjadi salah satu bagian dari kami dan mulai perjalanan 
                        <span class="text-orange-300">Anda</span> menuju kesuksesan di dunia
                        <span class="text-orange-300">Pro Scene</span> Mobile Legends!
                    </p>
                    <a href="./profile.php">
                        <button class="mt-7 bg-stack-orange px-4 md:px-5 lg:px-6 py-2 md:py-2.5 lg:py-3 rounded-xl text-white font-semibold font-poppins block active:scale-95 hover:bg-orange-hover active:bg-orange-active shadow-xl hover:scale-105 transition duration-300 hover:shadow-[0_0_20px_5px_rgba(255,120,0,0.9)] cursor-pointer">
                            Lihat Modul Anda
                        </button>
                    </a>
                </div> 
            </div>
        </div>
        <div class="absolute md:bottom-50 lg:bottom-20 right-0 max-w-[800px] md:max-w-[700px] lg:max-w-[1050px]">
            <img src="img/beranda.png" class="w-full object-contain drop-shadow-[0_0_50px_rgba(255,120,0,0.3)]">
        </div>
    </section>


    <!-- Program Pilihan Section -->
    <section class="px-12 py-24 flex flex-col items-center justify-center">
        <h2 class="text-white text-6xl font-bold">Program Pilihan Kami</h2>

        <div class="flex gap-10 py-16">
            <div class="max-w-sm rounded-2xl overflow-hidden shadow-lg bg-white pt-12 mt-12">
                <div class="relative">
                    <img src="img/progpil/11.png" alt="Mapping Guide" class="w-full">
                    <div class="absolute bottom-0 left-0 w-full h-16 bg-gradient-to-t from-gray-900 to-transparent"></div>
                </div>
                <div class="px-6 md:pb-2 lg:pb-8 pt-4">
                    <h2 class="text-xl font-bold text-black text-center pb-4">Mapping Guide</h2>
                    <p class="lg:mt-2 text-gray-700 text-sm">
                        Dalam Materi ini kita akan membahas mengenai pembagian role pada suatu hero. Pada dasarnya tugas dalam suatu permainan tersebut dibagi berdasarkan oleh atribut & kemampuan hero terbagi menjadi 18 Role..
                    </p>
                </div>
            <div class="px-6 md:pb-2 lg:py-4 flex md:flex-col lg:flex-row justify-between items-center md:gap-4">
                <span class="font-bold text-lg text-black">Rp.100,000</span>
                <a href="./modul/akademi.php#mapping">
                    <button class="bg-orange-500 px-4 py-2 lg:text-md rounded-lg text-white font-semibold shadow-xl active:scale-95 hover:bg-orange-600 active:bg-orange-700 transition duration-300 hover:shadow-[0_0_20px_5px_rgba(255,120,0,0.9)] cursor-pointer">
                        Lihat Selengkapnya
                    </button>
                </a>
                
            </div>
        </div>

        <div class="max-w-sm rounded-2xl overflow-hidden shadow-lg bg-white pt-12 mb-12">
            <div class="relative">
                <img src="img/progpil/22.png" alt="Mapping Guide" class="w-full">
                <div class="absolute bottom-0 left-0 w-full h-24 bg-gradient-to-t from-gray-900 to-transparent"></div>
            </div>
            <div class="px-6 pt-4 md:pb-2 lg:pb-8">
                <h2 class="text-xl font-bold text-black text-center pb-4">Chooseable Role Guide</h2>
                <p class="lg:mt-2 text-gray-700 text-sm">
                    Dalam Materi ini kita akan membahas mengenai pembagian role pada suatu hero. Pada dasarnya tugas dalam suatu permainan tersebut dibagi berdasarkan oleh atribut & kemampuan hero terbagi menjadi 18 Role..
                </p>
            </div>
            <div class="px-6 md:pb-2 lg:py-4 flex md:flex-col lg:flex-row justify-between items-center md:gap-4">
                <span class="font-bold text-lg text-black">Rp.100,000</span>
                <a href="./modul/akademi.php#role">
                    <button class="bg-orange-500 px-4 py-2 rounded-lg text-white font-semibold shadow-xl active:scale-95 hover:bg-orange-600 active:bg-orange-700 transition duration-300 hover:shadow-[0_0_20px_5px_rgba(255,120,0,0.9)] cursor-pointer">
                        Lihat Selengkapnya
                    </button>
                </a>
                
            </div>
        </div>

        <div class="max-w-sm rounded-2xl overflow-hidden shadow-lg bg-white pt-12 mt-12">
            <div class="relative">
                <img src="img/progpil/33.png" alt="Mapping Guide" class="w-full">
                <div class="absolute bottom-0 left-0 w-full h-16 bg-gradient-to-t from-gray-900 to-transparent"></div>
            </div>
            <div class="px-6 pt-4 md:pb-2 lg:pb-8">
                <h2 class="text-xl font-bold text-black text-center pb-4">Drafting Guide</h2>
                <p class="lg:mt-2 text-gray-700 text-sm">
                    Dalam Materi ini kita akan membahas mengenai pembagian role pada suatu hero. Pada dasarnya tugas dalam suatu permainan tersebut dibagi berdasarkan oleh atribut & kemampuan hero terbagi menjadi 18 Role..
                </p>
            </div>
            <div class="px-6 md:pb-2 lg:py-4 flex md:flex-col lg:flex-row justify-between items-center md:gap-4">
                <span class="font-bold text-lg text-black">Rp.100,000</span>
                <a href="./modul/akademi.php#drafting">
                    <button class="bg-orange-500 px-4 py-2 rounded-lg text-white font-semibold shadow-xl active:scale-95 hover:bg-orange-600 active:bg-orange-700 transition duration-300 hover:shadow-[0_0_20px_5px_rgba(255,120,0,0.9)] cursor-pointer">
                        Lihat Selengkapnya
                    </button>
                </a> 
            </div>
        </div>
    </div>
</section>

    <!-- Info Tournament Section -->
    <section class="px-6 md:px-12 lg:px-24 py-16 flex flex-col items-center justify-center">
        <h2 class="text-white text-4xl md:text-5xl lg:text-6xl font-bold text-center">Info Tournament</h2>

        <div class="w-full max-w-4xl mt-12 space-y-6">
        
        <!-- Event Item 1-->
        <div class="flex items-center space-x-4 w-full max-w-4xl gap-12">
            <div class="flex flex-col items-center w-24 md:w-28 lg:w-32 rounded-lg shadow-lg overflow-hidden">
                <div class="bg-orange-500 text-black font-bold text-3xl lg:text-4xl py-3 w-full text-center">
                    999
                </div>
                <div class="bg-white text-gray-800 text-sm md:text-base py-2 w-full text-center">
                    Feb 2025
                </div>
            </div>
            <div class="flex items-center justify-between flex-1 bg-gradient-to-r from-gray-200 to-gray-400 rounded-lg shadow-md px-4 md:px-6 py-4">
                <div>
                    <h2 class="text-lg md:text-xl lg:text-2xl font-bold">Coming Soon</h2>
                    <div class="flex items-center space-x-4 mt-2 text-gray-700 text-sm md:text-base">
                        <span class="flex items-center">⏰ xx.00</span>
                        <span class="flex items-center">📍 Discord & Youtube</span>
                    </div>
                </div>
                <button class="bg-white px-6 py-4 rounded-lg shadow-md hover:bg-gray-100 active:scale-95 transition cursor-pointer">
                    ➝
                </button>
            </div>
        </div>

        <!-- Event Item 2 -->
        <div class="flex items-center space-x-4 w-full max-w-4xl gap-12">
            <div class="flex flex-col items-center w-24 md:w-28 lg:w-32 rounded-lg shadow-lg overflow-hidden">
                <div class="bg-orange-500 text-black font-bold text-3xl lg:text-4xl py-3 w-full text-center">
                    999
                </div>
                <div class="bg-white text-gray-800 text-sm md:text-base py-2 w-full text-center">
                    Feb 2025
                </div>
            </div>

            <div class="flex items-center justify-between flex-1 bg-gradient-to-r from-gray-200 to-gray-400 rounded-lg shadow-md px-4 md:px-6 py-4">
                <div>
                    <h2 class="text-lg md:text-xl lg:text-2xl font-bold">Coming Soon</h2>
                    <div class="flex items-center space-x-4 mt-2 text-gray-700 text-sm md:text-base">
                        <span class="flex items-center">⏰ xx.00</span>
                        <span class="flex items-center">📍 Discord & Youtube</span>
                    </div>
                </div>

                <button class="bg-white px-6 py-4 rounded-lg shadow-md hover:bg-gray-100 active:scale-95 transition cursor-pointer">
                    ➝
                </button>
            </div>
        </div>

        <!-- Event Item 3 -->
        <div class="flex items-center space-x-4 w-full max-w-4xl gap-12">
            <div class="flex flex-col items-center w-24 md:w-28 lg:w-32 rounded-lg shadow-lg overflow-hidden">
                <div class="bg-orange-500 text-black font-bold text-3xl lg:text-4xl py-3 w-full text-center">
                    999
                </div>
                <div class="bg-white text-gray-800 text-sm md:text-base py-2 w-full text-center">
                    Feb 2025
                </div>
            </div>

            <div class="flex items-center justify-between flex-1 bg-gradient-to-r from-gray-200 to-gray-400 rounded-lg shadow-md px-4 md:px-6 py-4">
                <div>
                    <h2 class="text-lg md:text-xl lg:text-2xl font-bold">Coming Soon</h2>
                    <div class="flex items-center space-x-4 mt-2 text-gray-700 text-sm md:text-base">
                        <span class="flex items-center">⏰ xx.00</span>
                        <span class="flex items-center">📍 Discord & Youtube</span>
                    </div>
                </div>

                <button class="bg-white px-6 py-4 rounded-lg shadow-md hover:bg-gray-100 active:scale-95 transition cursor-pointer">
                    ➝
                </button>
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
        
    <script src="js/loginredirect.js"></script>
</body>
</html>



