<!-- index.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Umur</title>
    <style>
        /* Reset dan base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: #333;
        }
        
        .container {
            background-color: #ffffff;
            width: 100%;
            max-width: 460px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }
        
        .header {
            background-color:rgba(68, 88, 177, 0.99);
            color: white;
            padding: 20px;
            text-align: center;
        }
        
        .header h2 {
            font-weight: 500;
            letter-spacing: 0.5px;
        }
        
        .form-content {
            padding: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: #666;
            font-weight: 500;
        }
        
        input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e1e5eb;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s;
            background-color: #f9fafb;
        }
        
        input:focus {
            border-color: #4361ee;
            outline: none;
            box-shadow: 0 0 0 3px rgba(68, 88, 177, 0.99);
            background-color: #fff;
        }
        
        button {
            background-color: rgba(68, 88, 177, 0.99);
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            width: 100%;
            transition: all 0.2s;
            margin-top: 10px;
        }
        
        button:hover {
            background-color: rgba(68, 88, 177, 0.99);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(67, 97, 238, 0.15);
        }
        
        button:active {
            transform: translateY(0);
        }
        
        .error {
            color: #e63946;
            font-size: 13px;
            margin-top: 6px;
            display: block;
        }
        
        .result {
            margin-top: 30px;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            transition: all 0.3s;
            animation: fadeIn 0.5s;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .adult {
            background-color:rgb(216, 231, 243);
            color:rgba(68, 88, 177, 0.99);
            border: 1px solid rgba(68, 88, 177, 0.99);
        }
        
        .minor {
            background-color: #ffddd2;
            color: #9d0208;
            border: 1px solid #ffb4a2;
        }
        
        .result strong {
            font-weight: 600;
        }
        
        .result p:first-child {
            margin-bottom: 10px;
        }
        
        .title-icon {
            font-size: 24px;
            margin-right: 10px;
            vertical-align: middle;
        }
        
        /* Responsive tweaks */
        @media (max-width: 480px) {
            .container {
                border-radius: 8px;
            }
            
            .form-content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2><span class="title-icon">👤</span> Cek Status Umur</h2>
        </div>
        
        <div class="form-content">
            <?php
            // Inisialisasi variabel
            $nama = $umur = "";
            $namaErr = $umurErr = "";
            $showResult = false;
            
            // Cek jika form disubmit
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Validasi nama
                if (empty($_POST["nama"])) {
                    $namaErr = "Nama tidak boleh kosong";
                } else {
                    $nama = test_input($_POST["nama"]);
                }
                
                // Validasi umur
                if (empty($_POST["umur"])) {
                    $umurErr = "Umur tidak boleh kosong";
                } else {
                    $umur = test_input($_POST["umur"]);
                    if (!is_numeric($umur)) {
                        $umurErr = "Umur harus berupa angka";
                    }
                }
                
                // Tampilkan hasil jika tidak ada error
                if (empty($namaErr) && empty($umurErr)) {
                    $showResult = true;
                }
            }
            
            // Fungsi untuk membersihkan input
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            ?>
            
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>" placeholder="Masukkan nama Anda">
                    <span class="error"><?php echo $namaErr; ?></span>
                </div>
                
                <div class="form-group">
                    <label for="umur">Umur</label>
                    <input type="number" id="umur" name="umur" value="<?php echo $umur; ?>" placeholder="Masukkan umur Anda">
                    <span class="error"><?php echo $umurErr; ?></span>
                </div>
                
                <button type="submit">Periksa Status</button>
            </form>
            
            <?php if ($showResult): ?>
                <div class="result <?php echo ($umur >= 18) ? 'adult' : 'minor'; ?>">
                    <p>Halo, <strong><?php echo $nama; ?></strong>!</p>
                    <p>Status: <strong><?php echo ($umur >= 18) ? 'Dewasa' : 'Belum Dewasa'; ?></strong></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>