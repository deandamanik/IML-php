<?php
session_start();
include '../db.php';

if (!isset($_SESSION['form_data'])) {
    header("Location: ../pesansekarang/akademi.php");
    exit();
}

$form_data = $_SESSION['form_data'];
$modul_stmt = $koneksi->prepare("SELECT nama_modul, harga FROM modul WHERE id = ?");
$modul_stmt->bind_param("i", $form_data['id_modul']);
$modul_stmt->execute();
$modul_result = $modul_stmt->get_result();

if ($modul_result->num_rows === 0) {
    die("Module not found!");
}

$modul_data = $modul_result->fetch_assoc();
$nama_modul = $modul_data['nama_modul'];
$harga = $modul_data['harga'];
$modul_stmt->close();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $sql = "INSERT INTO riwayat_akademi (user_id, nama, email, phone, discord_username, id_mlbb, id_modul, metode_pembayaran) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("isssssis", 
            $_SESSION['user_id'],
            $form_data['nama'],
            $form_data['email'],
            $form_data['phone'],
            $form_data['discord'],
            $form_data['idmlbb'],
            $form_data['id_modul'],
            $form_data['payment']
        );
        
        if ($stmt->execute()) {
            $last_id = $koneksi->insert_id;
            unset($_SESSION['form_data']);
            header("Location: ../sukses/akademi.php?id=".$last_id);
            exit();
        } else {
            throw new Exception("Error: " . $stmt->error);
        }
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <title>Pembayaran</title>
    <link rel="stylesheet" href="../src/output.css">
</head>
<body class="bg-black text-white">

    <!-- Header Section -->
    <section class="max-w-screen">
        <section class="flex items-center px-6 md:px-12 lg:px-24 gap-4 py-8 md:py-12">
            <h2 class="text-2xl md:text-3xl lg:text-4xl italic font-bold">
                <span class="text-stack-orange">Konfirmasi</span> Pembayaran
            </h2>
            <div class="flex-grow border-t border-white"></div>
        </section>
    </section>

    <!-- Transaction Details -->
    <div class="px-6 md:px-12 lg:px-24 pt-4 pb-4">
        <div class="mx-auto bg-opacity-5 backdrop-blur-md border border-white border-opacity-10 rounded-xl p-6 md:p-8 shadow-lg">
            <div class="space-y-4">
                <div class="border-b border-white border-opacity-10 pb-4">
                    <p class="text-lg font-medium text-gray-300">Nama User</p>
                    <p class="text-xl mt-1"><?= htmlspecialchars($form_data['nama']) ?></p>
                </div>
                
                <div class="border-b border-white border-opacity-10 pb-4">
                    <p class="text-lg font-medium text-gray-300">Email</p>
                    <p class="text-xl mt-1"><?= htmlspecialchars($form_data['email']) ?></p>
                </div>
                
                <div class="border-b border-white border-opacity-10 pb-4">
                    <p class="text-lg font-medium text-gray-300">ID MLBB</p>
                    <p class="text-xl mt-1 font-mono">
                        <?= htmlspecialchars($form_data['idmlbb']) ?>
                    </p>
                </div>
                
                <div class="border-b border-white border-opacity-10 pb-4">
                    <p class="text-lg font-medium text-gray-300">Produk</p>
                    <p class="text-xl mt-1 text-stack-orange font-semibold">
                        <?= htmlspecialchars($nama_modul) ?>
                    </p>
                </div>
                
                <div class="border-b border-white border-opacity-10 pb-4">
                    <p class="text-lg font-medium text-gray-300">Harga</p>
                    <p class="text-xl mt-1">Rp <?= number_format($harga, 0, ',', '.') ?>,-</p>
                </div>
                
                <div class="">
                    <p class="text-lg font-medium text-gray-300">Metode Pembayaran</p>
                    <p class="text-xl mt-1 text-stack-orange font-semibold">
                        <?= htmlspecialchars($form_data['payment']) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 px-6 md:px-12 lg:px-24 text-gray-400 text-sm">
        <p>*Pastikan data yang dimasukkan sudah benar</p>
    </div>

    <!-- Action Buttons -->
    <div class="px-6 md:px-12 lg:px-24 mt-4 space-y-4">
        <form method="POST">
            <button type="submit" 
                    class="w-full py-3 bg-stack-orange rounded-xl text-white font-semibold block active:scale-98 hover:bg-orange-hover active:bg-orange-active shadow-xl transition duration-300 hover:shadow-[0_0_20px_5px_rgba(255,120,0,0.9)] cursor-pointer">
                KONFIRMASI PEMBAYARAN
            </button>
        </form>
        
        <a href="../pesansekarang/akademi.php" class="block">
        <button class="w-full bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-lg 
                    transition-all duration-300 hover:shadow-[0_0_20px_5px_rgba(75,85,99,0.9)] cursor-pointer">
            BATALKAN TRANSAKSI
        </button>

        </a>
    </div>
</body>
</html>