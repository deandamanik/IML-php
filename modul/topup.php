<?php
session_start();
include '../db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate inputs
    if (empty($_POST['id_mlbb']) || empty($_POST['server_id']) || empty($_POST['payment']) || empty($_POST['id_modul'])) {
        die("Error: Harap lengkapi semua data!");
    }

    // Get module details based on selected product
    $id_modul = $_POST['id_modul'];
    $modul_stmt = $koneksi->prepare("SELECT nama_modul, harga FROM modul WHERE id = ?");
    $modul_stmt->bind_param("i", $id_modul);
    $modul_stmt->execute();
    $modul_result = $modul_stmt->get_result();

    if ($modul_result->num_rows === 0) {
        die("Produk tidak ditemukan!");
    }

    $modul_data = $modul_result->fetch_assoc();
    $modul_stmt->close();

    // Store data in session
    $_SESSION['form_data'] = [
        'id_mlbb' => trim($_POST['id_mlbb']),
        'server_id' => trim($_POST['server_id']),
        'save_id' => isset($_POST['save_id']) ? 1 : 0,
        'payment' => trim($_POST['payment']),
        'id_modul' => $id_modul,
        'nama_modul' => $modul_data['nama_modul'],
        'harga' => $modul_data['harga']
    ];
    
    header("Location: ../pembayaran/topup.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <title>Top Up Diamond</title>
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
                <button class="bg-stack-orange px-8 py-3 md:px-12 md:py-3 lg:px-16 lg:py-4 rounded-xl text-white font-semibold font-poppins block active:scale-95 hover:bg-orange-hover active:bg-orange-active hover:scale-105 transition duration-300 hover:shadow-[0_0_15px_4px_rgba(255,120,0,0.9)] text-lg md:text-xl">
                    Akademi MLBB
                </button>
            </a>            
            <a href="coaching.php">
                <button class="bg-stack-orange px-8 py-3 md:px-12 md:py-3 lg:px-16 lg:py-4 rounded-xl text-white font-semibold font-poppins block active:scale-95 hover:bg-orange-hover active:bg-orange-active shadow-md hover:scale-105 transition duration-300 hover:shadow-[0_0_15px_4px_rgba(255,120,0,0.9)] text-lg md:text-xl">
                    Private Online Coaching
                </button>
            </a>
            <a href="topup.php">
                <button class="bg-stack-orange px-8 py-3 md:px-12 md:py-3 lg:px-16 lg:py-4 rounded-xl text-white font-semibold font-poppins block active:scale-95 hover:bg-orange-hover active:bg-orange-active hover:scale-105 transition duration-300 shadow-[0_0_15px_4px_rgba(255,120,0,0.9)] text-lg md:text-xl">
                    Top Up Diamond
                </button>
            </a>
        </div>
    </section>

    <!-- Data Akun -->
    <form method="POST" action="">
        <section class="max-w-screen">
            <section class="flex items-center px-10 md:px-24 lg:px-32 gap-4 md:gap-6 py-12 md:py-16">
                <h2 class="text-white text-3xl md:text-4xl lg:text-5xl italic whitespace-nowrap">
                    <span class="text-stack-orange">Masukan</span> Data Akun
                </h2>
                <div class="flex-grow border-t border-white"></div>
            </section>
        </section>

        <!-- Section Form Input -->
        <section class="px-6 md:px-20 lg:px-32 ">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-20">
                <!-- USER ID -->
                <div class="flex flex-col gap-3 w-full">
                    <label for="id_mlbb" class="text-white font-semibold">ID MLBB</label>
                    <input type="text" name="id_mlbb" id="id_mlbb" placeholder="Contoh: 123456" required
                        class="w-full px-6 py-4 bg-gray-200 text-black rounded-xl outline-none focus:ring-2 focus:ring-orange-500 text-lg mb-6">
                </div>
                <!-- SERVER ID -->
                <div class="flex flex-col gap-3 w-full">
                    <label for="server_id" class="text-white font-semibold">SERVER ID</label>
                    <input type="text" name="server_id" id="server_id" placeholder="Contoh: 123456" required
                        class="w-full px-6 py-4 bg-gray-200 text-black rounded-xl outline-none focus:ring-2 focus:ring-orange-500 text-lg mb-6">
                </div>
            </div>
        </section>

        <section class="max-w-screen">
            <section class="flex items-center px-10 md:px-24 lg:px-32 gap-4 md:gap-6 py-12 md:py-16">
                <h2 class="text-white text-3xl md:text-4xl lg:text-5xl italic whitespace-nowrap">
                    <span class="text-stack-orange">Product</span> Category
                </h2>
                <div class="flex-grow border-t border-white"></div>
            </section>
        </section>                

        <!-- Product Section -->
        <section class="flex justify-center">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-20 px-6 md:px-28 lg:px-48 w-full max-w-full">
                <label class="relative cursor-pointer block w-full">
                    <input type="radio" name="id_modul" class="peer hidden" value="8" required> <!-- ID modul untuk 5 Diamond -->
                    <div class="w-full peer-checked:shadow-[0_0_20px_5px_rgba(255,120,0,0.9)] peer-checked:scale-105 transition-all duration-300 hover:scale-105 active:scale-95 rounded-xl">
                        <img src="../img/topup/dm1.png" alt="5 Diamond">
                    </div>
                </label>
                <label class="relative cursor-pointer block w-full">
                    <input type="radio" name="id_modul" class="peer hidden" value="9"> <!-- ID modul untuk 44 Diamond -->
                    <div class="w-full peer-checked:shadow-[0_0_20px_5px_rgba(255,120,0,0.9)] peer-checked:scale-105 transition-all duration-300 hover:scale-105 active:scale-95 rounded-xl">
                        <img src="../img/topup/dm2.png" alt="44 Diamond">
                    </div>
                </label>
                <label class="relative cursor-pointer block w-full">
                    <input type="radio" name="id_modul" class="peer hidden" value="10"> <!-- ID modul untuk 170 Diamond -->
                    <div class="w-full peer-checked:shadow-[0_0_20px_5px_rgba(255,120,0,0.9)] peer-checked:scale-105 transition-all duration-300 hover:scale-105 active:scale-95 rounded-xl">
                        <img src="../img/topup/dm3.png" alt="170 Diamond">
                    </div>
                </label>
                <label class="relative cursor-pointer block w-full">
                    <input type="radio" name="id_modul" class="peer hidden" value="11"> <!-- ID modul untuk 875 Diamond -->
                    <div class="w-full peer-checked:shadow-[0_0_20px_5px_rgba(255,120,0,0.9)] peer-checked:scale-105 transition-all duration-300 hover:scale-105 active:scale-95 rounded-xl">
                        <img src="../img/topup/dm4.png" alt="875 Diamond">
                    </div>
                </label>
                <label class="relative cursor-pointer block w-full">
                    <input type="radio" name="id_modul" class="peer hidden" value="12"> <!-- ID modul untuk 2010 Diamond -->
                    <div class="w-full peer-checked:shadow-[0_0_20px_5px_rgba(255,120,0,0.9)] peer-checked:scale-105 transition-all duration-300 hover:scale-105 active:scale-95 rounded-xl">
                        <img src="../img/topup/dm5.png" alt="2010 Diamond">
                    </div>
                </label>
                <label class="relative cursor-pointer block w-full">
                    <input type="radio" name="id_modul" class="peer hidden" value="13"> <!-- ID modul untuk 4830 Diamond -->
                    <div class="w-full peer-checked:shadow-[0_0_20px_5px_rgba(255,120,0,0.9)] peer-checked:scale-105 transition-all duration-300 hover:scale-105 active:scale-95 rounded-xl">
                        <img src="../img/topup/dm6.png" alt="4830 Diamond">
                    </div>
                </label>
            </div>
        </section>

        <section class="max-w-screen">
            <section class="flex items-center px-10 md:px-24 lg:px-32 gap-4 md:gap-6 py-12 md:py-16">
                <h2 class="text-white text-3xl md:text-4xl lg:text-5xl italic whitespace-nowrap">
                    <span class="text-stack-orange">Pem</span>bayaran
                </h2>
                <div class="flex-grow border-t border-white"></div>
            </section>
        </section> 

        <!-- Pembayaran Section -->
        <section class="flex">
            <div class="flex flex-row justify-center gap-4 md:gap-10 lg:gap-16 px-6 md:px-28 lg:px-40">
                <label class="relative cursor-pointer w-full max-w-[400px]">
                    <input type="radio" name="payment" class="peer hidden" value="Dana" required>
                    <div class="w-full aspect-[16/9] bg-[#E65A2E] rounded-xl flex flex-col items-center justify-center px-4 py-2 gap-2
                        peer-checked:shadow-[0_0_20px_5px_rgba(255,120,0,0.9)] peer-checked:scale-105 transition-all duration-300 shadow-lg hover:scale-105 active:scale-95">
                        <img src="../img/wallet/dana.png" alt="Dana" class="w-32 md:w-36 lg:w-44">
                        <span class="text-white font-semibold text-lg md:text-xl lg:text-2xl">Dana</span>
                    </div>
                </label>
        
                <label class="relative cursor-pointer w-full max-w-[400px]">
                    <input type="radio" name="payment" class="peer hidden" value="Ovo">
                    <div class="w-full aspect-[16/9] bg-[#E65A2E] rounded-xl flex flex-col items-center justify-center px-4 pt-3
                        peer-checked:shadow-[0_0_20px_5px_rgba(255,120,0,0.9)] peer-checked:scale-105 transition-all duration-300 shadow-lg hover:scale-105 active:scale-95">
                        <img src="../img/wallet/ovo.png" alt="OVO" class="w-32 md:w-36 lg:w-44">
                        <span class="text-white font-semibold text-lg md:text-xl lg:text-2xl pt-4">OVO</span>
                    </div>
                </label>
        
                <label class="relative cursor-pointer w-full max-w-[400px]">
                    <input type="radio" name="payment" class="peer hidden" value="Gopay">
                    <div class="w-full aspect-[16/9] bg-[#E65A2E] rounded-xl flex flex-col items-center justify-center px-4 
                        peer-checked:shadow-[0_0_20px_5px_rgba(255,120,0,0.9)] peer-checked:scale-105 transition-all duration-300 shadow-lg hover:scale-105 active:scale-95">
                        <img src="../img/wallet/gopay.png" alt="Gopay" class="w-32 md:w-36 lg:w-44">
                        <span class="text-white font-semibold text-lg md:text-xl lg:text-2xl pt-4">Gopay</span>
                    </div>
                </label>
            </div>
        </section>
        
        <div class="w-full px-6 md:px-24 lg:px-36 mt-16">
            <button type="submit" class="w-full bg-stack-orange px-8 py-3 rounded-xl text-white font-semibold font-poppins block active:scale-95 hover:bg-orange-hover active:bg-orange-active shadow-xl hover:scale-105 transition duration-300 hover:shadow-[0_0_20px_5px_rgba(255,120,0,0.9)]">
                Lakukan Pembayaran
            </button>
        </div>
    </form>
  
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