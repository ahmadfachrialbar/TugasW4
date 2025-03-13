<?php
// login.php - Halaman Login
session_start(); 
if (isset($_SESSION['username'])) { 
    header("Location: dashboard.php"); 
    exit();
} 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            /* Background gradient */
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            /* Tambahkan pattern overlay */
            background-image: url('https://cdn.pixabay.com/photo/2020/02/19/22/57/blue-background-4863452_1280.jpg');
        }
        
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            /* Tambahkan efek backdrop blur */
            position: relative;
            z-index: 2;
            backdrop-filter: blur(5px);
            background-color: rgba(255, 255, 255, 0.9);
        }
        
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            font-weight: 600;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: 500;
        }
        
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            transition: all 0.3s;
        }
        
        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #4a90e2;
            outline: none;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.2);
        }
        
        button {
            background-color: #4a90e2;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 12px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s;
            font-weight: 500;
        }
        
        button:hover {
            background-color: #3a80d2;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        button:active {
            transform: translateY(0);
        }
        
        .error-message {
            background-color: #ffebee;
            color: #c62828;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            border-left: 4px solid #c62828;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        
        <?php
        if (isset($_GET['error'])) {
            echo '<div class="error-message">Login gagal! Username atau password salah.</div>';
        }
        ?>
        
        <form method="POST" action="proses_login.php">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required autofocus>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>