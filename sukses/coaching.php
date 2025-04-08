<?php
session_start();
include '../db.php';

if (!isset($_GET['id'])) {
    header("Location: ../coaching.php");
    exit();
}

$transaksi_id = (int)$_GET['id'];

$sql = "SELECT r.*, m.nama_modul, m.harga
        FROM riwayat_coaching r
        JOIN modul m ON r.id_modul = m.id
        WHERE r.id = ? AND r.user_id = ?";
        
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("ii", $transaksi_id, $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Transaksi tidak ditemukan!");
}

$transaksi = $result->fetch_assoc();
$stmt->close();
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
    <title>Transaksi Berhasil</title>
    <link rel="stylesheet" href="../src/output.css">
</head>
<body class="bg-black text-white min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-2xl bg-black rounded-xl border border-gray-700 shadow-2xl overflow-hidden">
        <div class="bg-gradient-to-r from-stack-orange to-orange-600 p-6 text-center">
            <div class="flex flex-col items-center">
                <img src="../img/berhasil/berhasil.png" alt="Success" class="w-32 h-32 md:w-40 md:h-40 animate-bounce">
                <h1 class="mt-4 text-3xl md:text-4xl font-bold text-white">Transaksi Berhasil!</h1>
                <p class="mt-2 text-orange-100">Pembelian Anda telah diproses</p>
            </div>
        </div>

        <div class="p-6 md:p-8 space-y-6">
            <div class="space-y-4">
                <div class="flex justify-between border-b border-gray-700 pb-3">
                    <span class="text-gray-400 font-medium">Detail Produk:</span>
                    <span class="font-bold text-stack-orange"><?= htmlspecialchars($transaksi['nama_modul']) ?></span>
                </div>
                
                <div class="flex justify-between border-b border-gray-700 pb-3">
                    <span class="text-gray-400 font-medium">Nama:</span>
                    <span class="font-semibold"><?= htmlspecialchars($transaksi['nama']) ?></span>
                </div>
                
                <div class="flex justify-between border-b border-gray-700 pb-3">
                    <span class="text-gray-400 font-medium">Coach:</span>
                    <span class="font-semibold"><?= htmlspecialchars($transaksi['pilihan_coach']) ?></span>
                </div>
                
                <div class="flex justify-between border-b border-gray-700 pb-3">
                    <span class="text-gray-400 font-medium">Harga:</span>
                    <span class="font-semibold">Rp <?= number_format($transaksi['harga'], 0, ',', '.') ?></span>
                </div>
                
                <div class="flex justify-between">
                    <span class="text-gray-400 font-medium">Metode Pembayaran:</span>
                    <span class="font-semibold"><?= htmlspecialchars($transaksi['metode_pembayaran']) ?></span>
                </div>
            </div>
        </div>

        <!-- Footer Section -->
        <div class="px-6 md:px-8 pb-6 md:pb-8">
            <p class="text-center text-sm text-gray-400 italic mb-4">*Cek detail coaching Anda di menu Profile</p>
            <a href="../profile.php">
            <button class="w-full py-3 bg-stack-orange rounded-xl text-white font-semibold block active:scale-98 hover:bg-orange-hover     active:bg-orange-active shadow-xl transition duration-300 hover:shadow-[0_0_20px_5px_rgba(255,120,0,0.9)] cursor-pointer">
                        Kembali ke Beranda
                </button>
            </a>
        </div>
    </div>

</body>
</html>