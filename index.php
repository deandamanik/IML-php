<?php
session_start();
include 'db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_email = $_POST['username_email'];
    $password = $_POST['password'];

    if (empty($username_email) || empty($password)) {
        $error = "Semua kolom harus diisi!";
    } else {
        $query = "SELECT * FROM users WHERE username = ? OR email = ?";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("ss", $username_email, $username_email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if ($password === $row['password']) { 
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];

                session_regenerate_id(true); 
                echo "<script>localStorage.removeItem('openLoginModal'); window.location.href = 'mainpage.php';</script>";
                exit();
            } else {
                $error = "Password Anda salah!";
            }
        } else {
            $error = "Username atau email tidak terdaftar!";
        }
    }
    echo "<script>localStorage.setItem('openLoginModal', 'true');</script>";
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
        <title>IML</title>
    <link rel="stylesheet" href="./src/output.css">
</head>
<body class="bg-black">

   <!-- Header Section -->
   <header>
    <div class="py-4 px-6 md:py-5 md:px-20 lg:py-7 lg:px-32 flex justify-between md:gap-20 lg:gap-32">
        <div>
            <a href="landingpage.html" class="text-white text-2xl md:text-3xl lg:text-4xl font-extrabold italic">IML</a>
        </div>
        <div class="flex justify-between items-center gap-8 md:gap-12 lg:gap-16">
            <a href="#" id="openModal" class="text-white font-semibold text-base md:text-lg">Log In</a>
                <a href="signup.php">
                    <button class="bg-stack-orange px-4 py-2 md:px-6 md:py-2.5 lg:px-8 lg:py-3 rounded-xl text-white font-semibold font-poppins block active:scale-95 hover:bg-orange-hover active:bg-orange-active shadow-lg hover:scale-105 transition duration-300 hover:shadow-[0_0_15px_4px_rgba(255,120,0,0.9)] cursor-pointer">
                    Sign Up 
                </button>
            </a>
        </div>  
    </div>
</header>


    <!-- Hero Section -->
    <section class="min-h-screen relative">
        <div class="mt-24 py-12 px-6 md:px-12 lg:px-18 flex justify-end">
            <div>
                <div class="w-full md:w-[40%] lg:w-[60%]">
                    <h1 class="text-white font-extrabold text-5xl md:text-6xl lg:text-7xl mb-6 md:mb-8 lg:mb-10 font-hero">
                        Be The One Above All 
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-500 to-orange-500">With Us</span>
                    </h1>
                </div>
                <div class="w-full md:w-[50%] lg:w-[55%]"> 
                    <p class="text-white font-semibold text-xl md:text-2xl lg:text-4xl font-hero">
                        60% Murid di Akademi ini berhasil masuk ke 
                        <span class="text-orange-300">Pro Scene</span> Mobile Legends dalam waktu 
                        <span class="text-orange-300">3 Bulan</span> menggunakan strategi kami.
                    </p>
                    <a href="#" id="openModal">
                        <button class="mt-7 bg-stack-orange px-4 md:px-5 lg:px-6 py-2 md:py-2.5 lg:py-3 rounded-xl text-white font-semibold font-poppins block active:scale-95 hover:bg-orange-hover active:bg-orange-active shadow-xl hover:scale-105 transition duration-300 hover:shadow-[0_0_20px_5px_rgba(255,120,0,0.9)] cursor-pointer">
                            Get started
                        </button>
                    </a>
                </div> 
            </div>
        </div>
        <div class="absolute md:bottom-[-10px] lg:bottom-[-170px] right-0 max-w-[800px] md:max-w-[700px] lg:max-w-[1000px]">
            <img src="img/index.png" class="w-full object-contain drop-shadow-[0_0_50px_rgba(255,120,0,0.3)]">
        </div>
    </section>


        <!-- Kenapa kami Section -->
        <section class="px-12 py-28 mt-24 flex flex-col items-center justify-center min-h-screen">
            <img src="img/landingpage/1.png" alt="">
            <div class="w-xl px-6 md:px-36 mt-16">
                <a href="#" id="openModal">
                    <button class="w-full bg-stack-orange px-8 py-3 rounded-xl text-white font-semibold font-poppins block active:scale-95 hover:bg-orange-hover active:bg-orange-active shadow-xl hover:scale-105 transition duration-300 hover:shadow-[0_0_20px_5px_rgba(255,120,0,0.9)] cursor-pointer">
                        Join Now
                    </button>
                </a>
            </div>
        </section>

        <section class="px-12 py-24">
            <img src="img/landingpage/2.png" alt="">
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


<!-- Pop Up Login -->
    <div id="loginModal" class="hidden">
        <div class="flex items-center justify-center fixed inset-0 bg-opacity-30 backdrop-blur-md">
            <div id="modalContent" class="relative bg-profile text-white rounded-3xl shadow-lg px-8 py-10 w-[90%] max-w-md translate-y-[-50px] opacity-0 transition-all duration-500">
                <button id="closeModal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-200 text-4xl cursor-pointer">&times;</button>
                    <img src="img/dexter1.png" alt="Karakter" class="absolute -top-20 left transform -translate-x-1/2 w-36 md:w-50">
                        <h2 class="text-center text-4xl font-bold italic mt-12">LOGIN</h2>
                        <?php if (!empty($error)): ?>
                        <p class="text-red-500 text-center mt-2 font-semibold"> <?php echo $error; ?> </p>
                        <?php endif; ?>
                <form action="" method="POST" class="mt-6 space-y-4">
                    <div>
                        <label class="text-sm font-semibold">USERNAME OR EMAIL</label>
                        <input type="text" name="username_email" required placeholder="Masukkan Alamat Email" class="w-full bg-gray-800 text-white px-4 py-2 rounded-lg mt-2 focus:ring-2 focus:ring-orange-500">
                    </div>
                    <div>
                        <label class="text-sm font-semibold">PASSWORD</label>
                        <input type="password" name="password" required placeholder="Masukkan Password" class="w-full bg-gray-800 text-white px-4 py-2 rounded-lg mt-2 focus:ring-2 focus:ring-orange-500">
                    </div>
                    <button type="submit" class="w-full bg-stack-orange text-white my-4 py-2 rounded-lg font-semibold text-lg shadow-md hover:bg-orange-hover active:bg-orange-active transition duration-300 hover:shadow-[0_0_20px_5px_rgba(255,120,0,0.9)] cursor-pointer">
                        Login
                    </button>
            </form>
            <p class="text-center text-sm mt-4">Belum memiliki akun? <a href="signup.php" class="text-orange-400 font-semibold">Daftar Sekarang</a></p>
        </div>
    </div>
</div>

<script src="js/index.js"></script>
<script src="js/loading.js"></script>

</body>
</html>



