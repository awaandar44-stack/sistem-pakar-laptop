<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location:login.php");
}

include "../config/koneksi.php";

$totalLaptop = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM laptop"));
$totalRiwayat = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM riwayat"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - LapMatch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, #fff5f9 0%, #ffe8f2 50%, #fff0f6 100%);
            min-height: 100vh;
            color: #4a2636;
        }
        
        /* Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 2px solid #ff6fb4;
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.4rem;
            color: #ff3d9a !important;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-logout {
            background: linear-gradient(135deg, #ff6fb4, #ff3d9a);
            color: white !important;
            border: none;
            border-radius: 30px;
            padding: 8px 24px;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 61, 154, 0.25);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        
        .btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 61, 154, 0.4);
            color: white;
        }
        
        /* Main Container */
        .main-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        
        /* Welcome Section */
        .welcome-section {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .welcome-section h1 {
            font-size: 2.2rem;
            font-weight: 800;
            background: linear-gradient(135deg, #ff3d9a, #ff6fb4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 8px;
        }
        
        .welcome-section p {
            font-size: 1rem;
            color: #8a5a6f;
            font-weight: 500;
        }
        
        /* Stats Grid - Smaller & Less Prominent */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 35px;
        }
        
        .stat-card {
            background: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(255, 158, 203, 0.3);
            border-radius: 16px;
            padding: 20px 25px;
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            background: rgba(255, 255, 255, 0.9);
            border-color: rgba(255, 158, 203, 0.5);
        }
        
        .stat-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #ffe4ef, #fff0f6);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: #ff3d9a;
            margin-bottom: 12px;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #ff3d9a;
            line-height: 1;
            margin-bottom: 4px;
        }
        
        .stat-label {
            font-size: 0.8rem;
            color: #8a5a6f;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        /* Actions Section - More Prominent */
        .actions-section {
            background: linear-gradient(135deg, #fff 0%, #fff5f8 100%);
            border: 2px solid #ff6fb4;
            border-radius: 24px;
            padding: 45px 35px;
            box-shadow: 0 10px 40px rgba(255, 61, 154, 0.15);
        }
        
        .actions-section h2 {
            font-size: 1.6rem;
            font-weight: 700;
            color: #ff3d9a;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-align: center;
        }
        
        .action-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        
        .action-btn {
            background: linear-gradient(135deg, #fff0f6 0%, #ffe4ef 100%);
            border: 2px solid #ffb3d1;
            border-radius: 18px;
            padding: 28px 22px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 16px;
            position: relative;
            overflow: hidden;
        }
        
        .action-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255,61,154,0.1), rgba(255,111,180,0.1));
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .action-btn:hover::before {
            opacity: 1;
        }
        
        .action-btn:hover {
            border-color: #ff3d9a;
            background: linear-gradient(135deg, #ffe4ef 0%, #fff0f6 100%);
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(255, 61, 154, 0.2);
        }
        
        .action-icon {
            width: 55px;
            height: 55px;
            background: linear-gradient(135deg, #ff6fb4, #ff3d9a);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            color: white;
            flex-shrink: 0;
            box-shadow: 0 6px 20px rgba(255, 61, 154, 0.3);
        }
        
        .action-text {
            flex: 1;
            position: relative;
            z-index: 1;
        }
        
        .action-text h4 {
            font-size: 1.05rem;
            font-weight: 700;
            color: #ff3d9a;
            margin: 0 0 5px 0;
        }
        
        .action-text p {
            font-size: 0.85rem;
            color: #8a5a6f;
            margin: 0;
            font-weight: 500;
            line-height: 1.4;
        }
        
        .action-arrow {
            color: #ff6fb4;
            font-size: 1.3rem;
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
        }
        
        .action-btn:hover .action-arrow {
            color: #ff3d9a;
            transform: translateX(6px);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .welcome-section h1 {
                font-size: 1.6rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .action-grid {
                grid-template-columns: 1fr;
            }
            
            .stat-number {
                font-size: 1.8rem;
            }
            
            .actions-section {
                padding: 30px 20px;
            }
            
            .action-btn {
                padding: 22px 18px;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <a href="#" class="navbar-brand">
                <i class="bi bi-stars"></i>
                Dashboard Admin
            </a>
            <a href="logout.php" class="btn-logout">
                <i class="bi bi-box-arrow-right"></i>
                Logout
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-container">
        <!-- Welcome Section -->
        <div class="welcome-section">
            
        </div>
        
        <!-- Stats Grid - Smaller -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-laptop"></i>
                </div>
                <div class="stat-number"><?= $totalLaptop ?></div>
                <div class="stat-label">Total Laptop</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-chat-dots"></i>
                </div>
                <div class="stat-number"><?= $totalRiwayat ?></div>
                <div class="stat-label">Riwayat Konsultasi</div>
            </div>
        </div>

        <!-- Quick Actions - More Prominent -->
        <div class="actions-section">
            <h2><i class="bi bi-lightning-charge-fill"></i> Menu Utama</h2>
            <div class="action-grid">
                <a href="laptop.php" class="action-btn">
                    <div class="action-icon">
                        <i class="bi bi-gear-fill"></i>
                    </div>
                    <div class="action-text">
                        <h4>Kelola Laptop</h4>
                        <p>Tambah, edit, atau hapus data laptop</p>
                    </div>
                    <i class="bi bi-arrow-right action-arrow"></i>
                </a>
                
                <a href="riwayat.php" class="action-btn">
                    <div class="action-icon">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <div class="action-text">
                        <h4>Riwayat Konsultasi</h4>
                        <p>Lihat semua riwayat konsultasi</p>
                    </div>
                    <i class="bi bi-arrow-right action-arrow"></i>
                </a>
                
                <a href="rule.php" class="action-btn">
                    <div class="action-icon">
                        <i class="bi bi-clipboard-check-fill"></i>
                    </div>
                    <div class="action-text">
                        <h4>Data Rule</h4>
                        <p>Kelola rule sistem pakar</p>
                    </div>
                    <i class="bi bi-arrow-right action-arrow"></i>
                </a>
                
                <a href="pertanyaan.php" class="action-btn">
                    <div class="action-icon">
                        <i class="bi bi-chat-left-text-fill"></i>
                    </div>
                    <div class="action-text">
                        <h4>Data Pertanyaan</h4>
                        <p>Kelola pertanyaan konsultasi</p>
                    </div>
                    <i class="bi bi-arrow-right action-arrow"></i>
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>