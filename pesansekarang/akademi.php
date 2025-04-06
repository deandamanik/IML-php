<?php
session_start();
include '../db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Ambil id_modul dari session
$id_modul = $_SESSION['id_modul'] ?? '';
if (empty($id_modul)) {
    die("Error: ID Modul tidak ditemukan.");
}

// Ambil nama modul
$cek_modul = $koneksi->prepare("SELECT nama_modul FROM modul WHERE id = ?");
$cek_modul->bind_param("i", $id_modul);
$cek_modul->execute();
$result = $cek_modul->get_result();
$nama_modul = $result->fetch_assoc()['nama_modul'] ?? 'Modul Tidak Ditemukan';
$cek_modul->close();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Simpan data ke session
    $_SESSION['form_data'] = [
        'nama' => trim($_POST['nama']),
        'email' => trim($_POST['email']),
        'phone' => trim($_POST['phone']),
        'discord' => trim($_POST['discord']),
        'idmlbb' => trim($_POST['idmlbb']),
        'payment' => trim($_POST['payment']),
        'id_modul' => $id_modul
    ];
    
    header("Location: ../pembayaran/akademi.php");
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
            
        <div class="px-24 pt-28 flex gap-6 items-center">
            <a href="../modul/akademi.php">
                <button type="button" class="text-white font-bold text-6xl cursor-pointer">
                &larr;
                </button>
            </a>
            <h2 class="md:text-5xl lg:text-6xl font-semibold text-white"> Modul :
                <span class="text-stack-orange font-bold"><?php echo htmlspecialchars($nama_modul); ?></span>
            </h2>
        </div>

            <section class="max-w-screen">
                <section class="flex items-center md:px-24 lg:px-24 gap-4 md:gap-6 md:py-10 py-12">
                    <h2 class="text-white md:text-4xl lg:text-5xl italic whitespace-nowrap">
                        <span class="text-stack-orange">Masukan</span> Data akun
                    </h2>
                    <div class="flex-grow border-t border-white"></div>
                </section>
            </section>

            <!-- Data diri Section -->
                <form action="" method="POST">
                    <div class="px-28 max-w-[1850px]">
                        <div class="grid grid-cols-2 md:gap-8 lg:gap-12">
                            <div class="flex flex-col gap-3">
                                <label for="nama" class="text-white font-semibold text-lg">Nama</label>
                                <input type="text" name="nama" placeholder="Contoh: Chandra Ganteng 123" class="max-w-[750px] px-4 py-3 bg-gray-200 text-black rounded-xl outline-none focus:ring-2 focus:ring-orange-500" required>
                            </div>
                        
                            <div class="flex flex-col gap-3">
                                <label for="email" class="text-white font-semibold text-lg">Alamat Email</label>
                                <input type="text" name="email" placeholder="Contoh: Chandraanjaymabar@gmail.com" class="max-w-[750px] px-4 py-3 bg-gray-200 text-black rounded-xl outline-none focus:ring-2 focus:ring-orange-500" required>
                            </div> 
                        
                            <div class="flex flex-col gap-3">
                                <label for="phone" class="text-white font-semibold text-lg">No telepon/WhatsApp</label>
                                <input type="text" name="phone" placeholder="Contoh: 08123456789" class="max-w-[750px] px-4 py-3 bg-gray-200 text-black rounded-xl outline-none focus:ring-2 focus:ring-orange-500" required>
                            </div> 
                        
                            <div class="flex flex-col gap-3">
                            <label for="discord" class="text-white font-semibold text-lg">Username Discord</label>
                            <input type="text" name="discord" placeholder="Contoh: john_doe#1234" class="max-w-[750px] px-4 py-3 bg-gray-200 text-black rounded-xl outline-none focus:ring-2 focus:ring-orange-500" required>
                        </div> 
                        
                            <div class="flex flex-col gap-3">
                                <label for="idmlbb" class="text-white font-semibold text-lg">ID MLBB</label>
                                <input type="text" name="idmlbb" placeholder="Contoh: 123456" class="max-w-[750px] px-4 py-3 bg-gray-200 text-black rounded-xl outline-none focus:ring-2 focus:ring-orange-500" required>
                            </div> 
                        </div>  
                    </div>         

            <section class="max-w-screen">
                <section class="flex items-center px-10 md:px-24 lg:px-24 gap-4 md:gap-6 py-12 md:py-16">
                    <h2 class="text-white text-3xl md:text-4xl lg:text-5xl italic whitespace-nowrap">
                        <span class="text-stack-orange">Metode</span> Pembayaran
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
                        <input type="radio" name="payment" class="peer hidden" value="Ovo" required>
                        <div class="w-full aspect-[16/9] bg-[#E65A2E] rounded-xl flex flex-col items-center justify-center px-4 pt-3
                            peer-checked:shadow-[0_0_20px_5px_rgba(255,120,0,0.9)] peer-checked:scale-105 transition-all duration-300 shadow-lg hover:scale-105 active:scale-95">
                            <img src="../img/wallet/ovo.png" alt="OVO" class="w-32 md:w-36 lg:w-44">
                            <span class="text-white font-semibold text-lg md:text-xl lg:text-2xl pt-4">OVO</span>
                        </div>
                    </label>
            
                    <label class="relative cursor-pointer w-full max-w-[400px]">
                        <input type="radio" name="payment" class="peer hidden" value="Gopay" required>
                        <div class="w-full aspect-[16/9] bg-[#E65A2E] rounded-xl flex flex-col items-center justify-center px-4 
                            peer-checked:shadow-[0_0_20px_5px_rgba(255,120,0,0.9)] peer-checked:scale-105 transition-all duration-300 shadow-lg hover:scale-105 active:scale-95">
                            <img src="../img/wallet/gopay.png" alt="Gopay" class="w-32 md:w-36 lg:w-44">
                            <span class="text-white font-semibold text-lg md:text-xl lg:text-2xl pt-4">Gopay</span>
                        </div>
                    </label>
                </div>
            </section>

            <div class="w-full px-6 md:px-24 lg:px-36 mt-16">
                
                    <button type="submit" class="w-full bg-stack-orange px-8 py-3 rounded-xl text-white font-semibold font-poppins block active:scale-95 hover:bg-orange-hover active:bg-orange-active shadow-xl hover:scale-102 transition duration-300 hover:shadow-[0_0_20px_5px_rgba(255,120,0,0.9)] cursor-pointer">
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