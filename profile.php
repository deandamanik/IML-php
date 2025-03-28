<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Database connection
include 'db.php';

// Get user data
$user_id = $_SESSION['user_id'];

// Get learning modules (join with modul table)
$stmt = $koneksi->prepare("
    SELECT ra.*, m.nama_modul, m.harga 
    FROM riwayat_akademi ra
    JOIN modul m ON ra.id_modul = m.id
    WHERE ra.user_id = ? 
    LIMIT 5
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$modules_result = $stmt->get_result();
$stmt->close();

// Get coaching sessions (join with modul table)
$stmt = $koneksi->prepare("
    SELECT rc.*, m.nama_modul, m.harga 
    FROM riwayat_coaching rc
    JOIN modul m ON rc.id_modul = m.id
    WHERE rc.user_id = ? 
    LIMIT 2
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$coaching_result = $stmt->get_result();
$stmt->close();

// Get transaction history (combine all riwayat tables with modul joins)
$stmt = $koneksi->prepare("
    (SELECT 'akademi' as jenis, ra.tanggal_pembelian as tanggal, m.nama_modul, m.harga, ra.metode_pembayaran, ra.status
     FROM riwayat_akademi ra
     JOIN modul m ON ra.id_modul = m.id
     WHERE ra.user_id = ?)
    
    UNION ALL
    
    (SELECT 'coaching' as jenis, rc.tanggal_pembelian as tanggal, m.nama_modul, m.harga, rc.metode_pembayaran, rc.status
     FROM riwayat_coaching rc
     JOIN modul m ON rc.id_modul = m.id
     WHERE rc.user_id = ?)
    
    UNION ALL
    
    (SELECT 'topup' as jenis, rt.tanggal_pembelian as tanggal, m.nama_modul, m.harga, rt.metode_pembayaran, rt.status
     FROM riwayat_topup rt
     JOIN modul m ON rt.id_modul = m.id
     WHERE rt.user_id = ?)
    
    ORDER BY tanggal DESC
    LIMIT 10
");
$stmt->bind_param("iii", $user_id, $user_id, $user_id);
$stmt->execute();
$transactions_result = $stmt->get_result();
$stmt->close();

// Close connection
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
    <title>Profile</title>
    <link rel="stylesheet" href="./src/output.css">
</head>
<body class="bg-black">

    <!-- Header Section -->
    <header>
        <div class="py-4 px-6 md:py-5 md:px-20 lg:py-7 lg:px-32 flex justify-between md:gap-20 lg:gap-32">
            <div>
                <a href="./mainpage.php" class="text-white text-2xl md:text-3xl lg:text-4xl font-extrabold italic">IML</a>
            </div>
            <div class="flex justify-between items-center gap-8 md:gap-12 lg:gap-16">
                <a href="profile.php" class="text-stack-orange font-semibold text-base md:text-lg"><p class="drop-shadow-[0_0_15px_4px_rgba(255,120,0,0.9)]">Profile</p></a>
                <a href="./mainpage.php" class="text-white font-semibold text-base md:text-lg">Beranda</a>
                <a href="./modul/akademi.php" class="text-white font-semibold text-base md:text-lg">Transaksi</a>
                <a href="berita.php" class="text-white font-semibold text-base md:text-lg">Berita</a>
                <a href="./logout.php">
                    <button class="bg-stack-orange px-4 py-2 md:px-6 md:py-2.5 lg:px-8 lg:py-3 rounded-xl text-white font-semibold font-poppins block active:scale-95 hover:bg-orange-hover active:bg-orange-active shadow-lg hover:scale-105 transition duration-300 hover:shadow-[0_0_15px_4px_rgba(255,120,0,0.9)]">
                        Log Out
                    </button>
                </a>
            </div>  
        </div>
    </header>

    <!-- Main Content -->
    <section class="flex flex-col p-6 md:p-8 lg:p-10 gap-8">
        <!-- Top Row - Modul Belajar dan Tournament -->
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Modul Belajar Section -->
            <div class="lg:w-2/3 bg-profile p-6 rounded-xl">
                <div class="flex items-center pb-2">
                    <img src="./src/img/profile/Vector.png" alt="icon">
                    <h1 class="text-white text-2xl font-bold ml-4 italic">MODUL BELAJAR</h1>
                </div>
                <div class="w-full h-0.5 bg-white mb-4"></div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <?php if ($modules_result->num_rows > 0): ?>
                        <?php while($module = $modules_result->fetch_assoc()): ?>
                        <div class="bg-profile-modul p-4 rounded-lg">
                            <div class="flex justify-between">
                                <div>
                                    <p class="text-lg text-orange-400 font-bold ">Sedang Dipelajari</p>
                                    <p class="text-white text-md mt-3 font-semibold"><?= htmlspecialchars($module['nama_modul']) ?></p>
                                </div>
                                <a href="#">
                                    <button class="bg-stack-orange px-4 py-2 rounded-xl text-white font-semibold text-sm hover:bg-orange-600 transition duration-300 hover:shadow-[0_0_15px_4px_rgba(255,120,0,0.5)]">
                                        Buka Modul
                                    </button>
                                </a>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p class="text-gray-400 text-center py-4 col-span-2">Anda belum memiliki modul akademi</p>
                    <?php endif; ?>
                    
                    <?php if ($coaching_result->num_rows > 0): ?>
                        <?php while($coaching = $coaching_result->fetch_assoc()): ?>
                        <div class="bg-profile-modul p-4 rounded-lg">
                            <div class="flex justify-between">
                                <div>
                                    <p class="text-lg text-orange-400 font-bold">Sedang Berlangsung</p>
                                    <p class="text-white text-md mt-3 font-semibold"><?= htmlspecialchars($coaching['nama_modul']) ?></p>
                                </div>
                                <a href="#">
                                    <button class="bg-stack-orange px-4 py-2 rounded-xl text-white font-semibold text-sm hover:bg-orange-600 transition duration-300 hover:shadow-[0_0_15px_4px_rgba(255,120,0,0.5)]">
                                        Detail Modul
                                    </button>
                                </a>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Tournament Section -->
            <div class="lg:w-1/3 bg-profile p-6 rounded-xl">
                <div class="flex items-center pb">
                    <span class="text-white text-2xl">🏆</span>
                    <h1 class="text-white text-2xl font-bold ml-4 italic">TOURNAMENT</h1>
                </div>
                <div class="w-full h-0.5 bg-white mb-4 mt-[14px]"></div>
            
                <!-- Tabs -->
                <div class="flex space-x-4 mb-4">
                    <button onclick="showTab('history')" id="history-btn"
                        class="bg-orange-500 px-6 py-2 rounded-xl text-white font-semibold transition duration-300 hover:bg-orange-500 hover:shadow-[0_0_15px_4px_rgba(255,120,0,0.9)]">
                        History
                    </button>
                    <button onclick="showTab('upcoming')" id="upcoming-btn"
                        class="bg-gray-700 px-6 py-2 rounded-xl text-white font-semibold transition duration-300 hover:bg-orange-500 hover:shadow-[0_0_15px_4px_rgba(255,120,0,0.9)]">
                        Upcoming
                    </button>
                </div>
            
                <!-- History Content -->
                <div id="history" class="space-y-2">
                    <div class="bg-profile-modul p-3 rounded-lg flex justify-between">
                        <p class="text-white text-sm font-bold">MLBB AXIS TOURNAMENT SEASON 1</p>
                        <p class="text-gray-400 text-xs">01-01-2025</p>
                    </div>
                    <div class="bg-profile-modul p-3 rounded-lg flex justify-between">
                        <p class="text-white text-sm font-bold">MLBB AXIS TOURNAMENT SEASON 1</p>
                        <p class="text-gray-400 text-xs">01-01-2025</p>
                    </div>
                </div>
            
                <!-- Upcoming Tournament Content (Hidden by Default) -->
                <div id="upcoming" class="space-y-2 hidden">
                    <div class="bg-profile-modul p-3 rounded-lg flex justify-between">
                        <p class="text-white text-sm font-bold">MLBB AXIS TOURNAMENT SEASON 2</p>
                        <p class="text-gray-400 text-xs">31-03-2025</p>
                    </div>
                    <div class="bg-profile-modul p-3 rounded-lg flex justify-between">
                        <p class="text-white text-sm font-bold">MLBB AXIS TOURNAMENT SEASON 2</p>
                        <p class="text-gray-400 text-xs">31-03-2025</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Bottom Row - Riwayat Transaksi (Full Width) -->
        <div class="bg-profile p-6 rounded-xl">
            <div class="flex items-center pb-2">
                <span class="text-white text-2xl">📋</span>
                <h1 class="text-white text-2xl font-bold ml-4 italic">RIWAYAT TRANSAKSI</h1>
            </div>
            <div class="w-full h-0.5 bg-white mb-4"></div>
            
            <div class="overflow-x-auto p-2">
                <table class="w-full border-collapse rounded-xl overflow-hidden border border-gray-500 min-w-[700px]">
                    <thead>
                        <tr class="bg-stack-orange text-white">
                            <th class="p-4 border border-slate-300">NO</th>
                            <th class="p-4 border border-slate-300">JENIS</th>
                            <th class="p-4 border border-slate-300">PRODUK</th>
                            <th class="p-4 border border-slate-300">TANGGAL</th>
                            <th class="p-4 border border-slate-300">TOTAL</th>
                            <th class="p-4 border border-slate-300">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($transactions_result->num_rows > 0): ?>
                            <?php $counter = 1; ?>
                            <?php while($transaction = $transactions_result->fetch_assoc()): ?>
                            <tr class="bg-profile-modul text-white">
                                <td class="p-4 text-center border border-slate-300 font-semibold"><?= $counter ?></td>
                                <td class="p-4 text-center border border-slate-300 font-semibold">
                                    <?= strtoupper($transaction['jenis']) ?>
                                </td>
                                <td class="p-4 border border-slate-300 font-semibold">
                                    <?= htmlspecialchars($transaction['nama_modul']) ?>
                                </td>
                                <td class="p-4 text-center border border-slate-300 font-semibold">
                                    <?= date('d-m-Y', strtotime($transaction['tanggal'])) ?>
                                </td>
                                <td class="p-4 text-center border border-slate-300 font-semibold">
                                    Rp <?= number_format($transaction['harga'], 0, ',', '.') ?>
                                </td>
                                <td class="p-4 text-center border border-slate-300 font-semibold <?= $transaction['status'] === 'Berhasil' ? 'text-green-400' : 'text-red-400' ?>">
                                    <?= strtoupper($transaction['status']) ?>
                                </td>
                            </tr>
                            <?php $counter++; ?>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr class="bg-profile-modul text-white">
                                <td colspan="6" class="p-4 text-center border border-slate-300 font-semibold">Tidak ada riwayat transaksi</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script>
        function showTab(tab) {
            document.getElementById('history').classList.add('hidden');
            document.getElementById('upcoming').classList.add('hidden');
            
            document.getElementById('history-btn').classList.remove('bg-orange-500', 'shadow-[0_0_15px_4px_rgba(255,120,0,0.9)]');
            document.getElementById('history-btn').classList.add('bg-gray-700');
            
            document.getElementById('upcoming-btn').classList.remove('bg-orange-500', 'shadow-[0_0_15px_4px_rgba(255,120,0,0.9)]');
            document.getElementById('upcoming-btn').classList.add('bg-gray-700');
    
            document.getElementById(tab).classList.remove('hidden');
            document.getElementById(tab + '-btn').classList.add('bg-orange-500', 'shadow-[0_0_15px_4px_rgba(255,120,0,0.9)]');
            document.getElementById(tab + '-btn').classList.remove('bg-gray-700');
        }
    </script>

</body>
</html>