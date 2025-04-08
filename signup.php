<?php
require 'db.php'; 

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = trim($_POST['password']);

    $check_sql = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = $koneksi->prepare($check_sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = "Username atau Email sudah digunakan!";
    } else {
        $insert_sql = "INSERT INTO users (username, email, phone, password) VALUES (?, ?, ?, ?)";
        $stmt = $koneksi->prepare($insert_sql);
        $stmt->bind_param("ssss", $username, $email, $phone, $password);
        
        if ($stmt->execute()) {
            $success = "Pendaftaran berhasil!";
        } else {
            $error = "Gagal mendaftar, coba lagi.";
        }
    }
    $stmt->close();
    $koneksi->close();
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
<body class="h-screen bg-[url('/iml/img/signup_bg.png')] bg-cover bg-center bg-no-repeat">

    <section class="flex justify-center items-center md:pt-24 lg:pt-36">
        <div class="relative bg-profile bg-opacity-80 text-white p-8 rounded-xl w-[420px]">

            <a href="index.php">
                <button type="button" class="absolute top-3 right-3 text-gray-400 hover:text-gray-200 text-4xl">
                    &times;
                </button>
            </a>
    
            <h1 class="text-center text-2xl font-bold mb-4">DAFTAR AKUN</h1>
            
            <?php if (!empty($error)): ?>
                <div class="text-red-500 font-semibold py-4 text-center">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($success)): ?>
                <div class="text-green-500 py-4 font-semibold text-center">
                    <?php echo $success; ?>
                </div>
            <?php endif; ?>
    
            <form action="" method="POST" class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold mb-2">USERNAME</label>
                    <input type="text" name="username" placeholder="Masukkan Username" value="<?= htmlspecialchars($username ?? '') ?>" class="w-full px-4 py-2 bg-profile-modul rounded-xl text-white text-sm" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2">EMAIL</label>
                    <input type="email" name="email" placeholder="Masukkan Email" value="<?= htmlspecialchars($email ?? '') ?>" class="w-full px-4 py-2 bg-profile-modul rounded-xl text-white text-sm" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2">NO TELPON</label>
                    <input type="text" name="phone" placeholder="Masukkan No Telpon" value="<?= htmlspecialchars($phone ?? '') ?>" class="w-full px-4 py-2 bg-profile-modul rounded-xl text-white text-sm" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2">PASSWORD</label>
                    <input type="password" name="password" placeholder="Masukkan Password" class="w-full px-4 py-2 bg-profile-modul rounded-xl text-white text-sm" required>
                </div>
    
                <p class="text-sm mt-4 italic">
                    Sudah punya akun? Silahkan 
                    <a href="index.php#openModal" id="loginRedirect" class="text-orange-400">login</a> 
                    disini
                </p>
    
                <button type="submit" class="w-full bg-stack-orange py-2 mt-1 rounded-xl font-semibold text-white shadow-lg hover:bg-orange-hover active:bg-orange-active hover:shadow-[0_0_20px_5px_rgba(255,120,0,0.9)] active:scale-95 transition duration-300" required>
                    Daftar Sekarang
                </button>
            </form>
        </div>
    </section>

<script src="js/loginredirect.js"></script>


</body>
</html>
