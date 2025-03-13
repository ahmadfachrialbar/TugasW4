<?php
// dashboard.php - Halaman Dashboard
session_start(); 

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) { 
    header("Location: login.php"); 
    exit(); 
} 

// Contoh data jadwal kuliah (dalam aplikasi nyata, ini akan diambil dari database)
$jadwal_kuliah = [
    [
        'hari' => 'Senin',
        'matkul' => [
            ['nama' => 'Pengembangan Apk Website', 'waktu' => '06:30 - 08:30', 'ruang' => 'Lab Jarkom', 'dosen' => 'AZR'],
            ['nama' => 'Penambangan Data', 'waktu' => '09:30 - 12:30', 'ruang' => 'Rek203', 'dosen' => 'Ibu Rona']
        ]
    ],
    [
        'hari' => 'Selasa',
        'matkul' => [
            ['nama' => 'kosong', 'waktu' => '0', 'ruang' => 'kosan', 'dosen' => 'Bapak Kost']
        ]
    ],
    [
        'hari' => 'Rabu',
        'matkul' => [
            ['nama' => 'Rekayasa Proses Bisnis', 'waktu' => '07:30 - 09:30', 'ruang' => 'Rek 201', 'dosen' => 'Ibu Sukma']
        ]
    ],
    [
        'hari' => 'Kamis',
        'matkul' => [
            ['nama' => 'Manajemen Sumber Daya Manusia', 'waktu' => '12:30 - 15:30', 'ruang' => 'Rek302', 'dosen' => 'Ibu Sarah'],
            ['nama' => 'Pengujian dan Implementasi Sistem', 'waktu' => '15:30 - 16:30', 'ruang' => 'Rek302', 'dosen' => 'Pak Lulu']
        ]
    ],
    [
        'hari' => 'Jumat',
        'matkul' => [
            ['nama' => 'Matematika Diskrit', 'waktu' => '06:00 - 09:30', 'ruang' => 'DC 202', 'dosen' => 'Ibu Lucu'],
            ['nama' => 'Statistika Industri', 'waktu' => '09:30 - 11:30', 'ruang' => 'DC 202', 'dosen' => 'Ibu Ririn']
        ]
    ]
];

// Menentukan hari ini untuk highlight
$hari_ini = date('l');
$hari_mapping = [
    'Monday' => 'Senin',
    'Tuesday' => 'Selasa',
    'Wednesday' => 'Rabu',
    'Thursday' => 'Kamis',
    'Friday' => 'Jumat',
    'Saturday' => 'Sabtu',
    'Sunday' => 'Minggu'
];
$hari_ini_indonesia = $hari_mapping[$hari_ini];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Jadwal Kuliah</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-image: url('data:image/svg+xml,%3Csvg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="white" fill-opacity="0.05" fill-rule="evenodd"%3E%3Ccircle cx="3" cy="3" r="3"/%3E%3Ccircle cx="13" cy="13" r="3"/%3E%3C/g%3E%3C/svg%3E');
        }
        
        .navbar {
            background-color: #1e5799; /* Warna biru tua */
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
        
        .navbar h1 {
            font-size: 22px;
            font-weight: 500;
        }
        
        .user-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .username {
            font-weight: 500;
            font-size: 15px;
        }
        
        .logout-btn {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            border-radius: 4px;
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .logout-btn:hover {
            background-color: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }
        
        .content {
            padding: 30px;
            flex-grow: 1;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }
        
        .welcome-card {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            backdrop-filter: blur(5px);
        }
        
        .welcome-card h2 {
            color: #333;
            margin-bottom: 10px;
        }
        
        .welcome-card p {
            color: #666;
            line-height: 1.6;
        }
        
        .jadwal-section {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            backdrop-filter: blur(5px);
        }
        
        .jadwal-header {
            background-color: #1e5799; /* Warna biru tua yang sama dengan navbar */
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
        }
        
        .jadwal-header h2 {
            font-size: 18px;
            font-weight: 500;
        }
        
        .jadwal-tabs {
            display: flex;
            background-color: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }
        
        .tab {
            padding: 15px 20px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 500;
            position: relative;
            color: #495057;
        }
        
        .tab.active {
            color: #1e5799; /* Warna biru tua */
            background-color: white;
        }
        
        .tab.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: #1e5799; /* Warna biru tua */
        }
        
        .tab.today {
            background-color: #e3f2fd;
        }
        
        .jadwal-content {
            padding: 0;
        }
        
        .hari-jadwal {
            display: none;
            padding: 20px;
        }
        
        .hari-jadwal.active {
            display: block;
        }
        
        .matkul-card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            margin-bottom: 15px;
            border-left: 4px solid #1e5799; /* Warna biru tua */
            transition: all 0.3s;
        }
        
        .matkul-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .matkul-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .matkul-title {
            font-weight: 600;
            font-size: 16px;
            color: #333;
        }
        
        .matkul-time {
            color: #1e5799; /* Warna biru tua */
            font-weight: 500;
            font-size: 15px;
        }
        
        .matkul-details {
            display: flex;
            justify-content: space-between;
            color: #666;
            font-size: 14px;
        }
        
        .no-jadwal {
            padding: 30px;
            text-align: center;
            color: #666;
        }
        
        .hari-title {
            margin-bottom: 20px;
            font-weight: 500;
            color: #333;
            display: flex;
            align-items: center;
        }
        
        .hari-title i {
            margin-right: 8px;
            color: #1e5799; /* Warna biru tua */
        }
        
        @media (max-width: 768px) {
            .jadwal-tabs {
                flex-wrap: wrap;
            }
            
            .tab {
                flex: 1 0 33.333%;
                text-align: center;
            }
            
            .matkul-header, .matkul-details {
                flex-direction: column;
                gap: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Dashboard Jadwal Kuliah</h1>
        <div class="user-actions">
            <span class="username"><?php echo $_SESSION['username']; ?></span>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </div>
    
    <div class="content">
        <div class="welcome-card">
            <h2>Selamat datang, <?php echo $_SESSION['username']; ?>!</h2>
            <p>Berikut adalah jadwal perkuliahan Anda. Jangan lupa untuk selalu hadir tepat waktu dan mempersiapkan materi sebelum kuliah dimulai.</p>
        </div>
        
        <div class="jadwal-section">
            <div class="jadwal-header">
                <h2>Jadwal Perkuliahan</h2>
                <span>Semester Genap 2024/2025</span>
            </div>
            
            <div class="jadwal-tabs">
                <?php foreach ($jadwal_kuliah as $index => $jadwal): ?>
                    <?php 
                    $is_today = $jadwal['hari'] == $hari_ini_indonesia;
                    $active_class = ($index == 0) ? 'active' : '';
                    if ($is_today) {
                        $active_class = 'active today';
                    }
                    ?>
                    <div class="tab <?php echo $active_class; ?>" data-tab="tab-<?php echo $index; ?>">
                        <?php echo $jadwal['hari']; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="jadwal-content">
                <?php foreach ($jadwal_kuliah as $index => $jadwal): ?>
                    <?php 
                    $is_today = $jadwal['hari'] == $hari_ini_indonesia;
                    $active_class = ($index == 0) ? 'active' : '';
                    if ($is_today) {
                        $active_class = 'active';
                    }
                    ?>
                    <div class="hari-jadwal <?php echo $active_class; ?>" id="tab-<?php echo $index; ?>">
                        <h3 class="hari-title">
                            <i>📅</i> Jadwal Hari <?php echo $jadwal['hari']; ?>
                            <?php if($is_today): ?> <span style="color: #e74c3c; margin-left: 10px;">(Hari Ini)</span> <?php endif; ?>
                        </h3>
                        
                        <?php if (count($jadwal['matkul']) > 0): ?>
                            <?php foreach ($jadwal['matkul'] as $matkul): ?>
                                <div class="matkul-card">
                                    <div class="matkul-header">
                                        <div class="matkul-title"><?php echo $matkul['nama']; ?></div>
                                        <div class="matkul-time"><?php echo $matkul['waktu']; ?></div>
                                    </div>
                                    <div class="matkul-details">
                                        <div>Ruang: <?php echo $matkul['ruang']; ?></div>
                                        <div>Dosen: <?php echo $matkul['dosen']; ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="no-jadwal">Tidak ada jadwal kuliah untuk hari ini.</div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    
    <script>
        // Script untuk tab jadwal
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.tab');
            
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Remove active class from all tabs and content
                    document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                    document.querySelectorAll('.hari-jadwal').forEach(content => content.classList.remove('active'));
                    
                    // Add active class to current tab
                    this.classList.add('active');
                    
                    // Show corresponding content
                    const tabId = this.getAttribute('data-tab');
                    document.getElementById(tabId).classList.add('active');
                });
            });
        });
    </script>
</body>
</html>