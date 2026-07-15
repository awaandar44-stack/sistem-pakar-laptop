<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location:login.php");
}

include "../config/koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pertanyaan - LapMatch</title>
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
        
        .btn-back {
            background: #fff;
            color: #ff3d9a;
            border: 2px solid #ffb3d1;
            border-radius: 30px;
            padding: 8px 22px;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        
        .btn-back:hover {
            background: #fff5f8;
            border-color: #ff3d9a;
            color: #ff3d9a;
            transform: translateY(-2px);
        }
        
        /* Main Container */
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        
        /* Page Header */
        .page-header {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(255, 158, 203, 0.2);
            border-radius: 24px;
            padding: 30px 35px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }
        
        .page-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #ff3d9a;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .page-title i {
            font-size: 2rem;
        }
        
        .page-subtitle {
            color: #8a5a6f;
            font-size: 0.9rem;
            margin-top: 6px;
            font-weight: 500;
        }
        
        .total-badge {
            background: linear-gradient(135deg, #ffe4ef, #fff0f6);
            color: #ff3d9a;
            padding: 10px 22px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 1px solid #ffb3d1;
        }
        
        /* Info Box */
        .info-box {
            background: linear-gradient(135deg, #fff0f6, #ffe4ef);
            border-left: 4px solid #ff3d9a;
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }
        
        .info-box i {
            color: #ff3d9a;
            font-size: 1.2rem;
            flex-shrink: 0;
            margin-top: 2px;
        }
        
        .info-box p {
            color: #5a3548;
            font-size: 0.88rem;
            margin: 0;
            line-height: 1.5;
            font-weight: 500;
        }
        
        /* Table Container */
        .table-container {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 158, 203, 0.2);
            border-radius: 24px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(255, 61, 154, 0.1);
            overflow-x: auto;
        }
        
        .custom-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .custom-table thead th {
            background: linear-gradient(135deg, #ff6fb4, #ff3d9a);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            padding: 16px 14px;
            border: none;
            white-space: nowrap;
            text-align: left;
        }
        
        .custom-table thead th:first-child {
            border-radius: 12px 0 0 0;
        }
        
        .custom-table thead th:last-child {
            border-radius: 0 12px 0 0;
        }
        
        .custom-table tbody tr {
            transition: all 0.3s ease;
        }
        
        .custom-table tbody tr:hover {
            background: #fff5f8;
        }
        
        .custom-table tbody td {
            background: white;
            padding: 18px 14px;
            border-bottom: 1px solid #ffe4ef;
            color: #5a3548;
            font-weight: 500;
            font-size: 0.9rem;
            vertical-align: middle;
        }
        
        .custom-table tbody tr:last-child td {
            border-bottom: none;
        }
        
        .custom-table tbody td:first-child {
            font-weight: 700;
            color: #ff3d9a;
        }
        
        /* Kode Badge */
        .kode-badge {
            background: linear-gradient(135deg, #ff6fb4, #ff3d9a);
            color: white;
            padding: 5px 14px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.85rem;
            display: inline-block;
            box-shadow: 0 3px 10px rgba(255, 61, 154, 0.25);
            letter-spacing: 0.5px;
        }
        
        /* Kategori Badge */
        .kategori-badge {
            background: linear-gradient(135deg, #ffe4ef, #fff0f6);
            color: #ff3d9a;
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: 1px solid #ffb3d1;
            text-transform: capitalize;
        }
        
        .kategori-badge.kebutuhan {
            background: linear-gradient(135deg, #ffe4ef, #fff0f6);
        }
        
        .kategori-badge.budget {
            background: linear-gradient(135deg, #fff0f6, #ffe4ef);
        }
        
        /* Pertanyaan Text */
        .pertanyaan-text {
            color: #3a1a2a;
            font-weight: 500;
            line-height: 1.5;
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #8a5a6f;
        }
        
        .empty-state i {
            font-size: 4rem;
            color: #ffb3d1;
            margin-bottom: 15px;
        }
        
        .empty-state h4 {
            font-size: 1.2rem;
            font-weight: 700;
            color: #ff3d9a;
            margin-bottom: 8px;
        }
        
        .empty-state p {
            font-size: 0.95rem;
            font-weight: 500;
            margin: 0;
            color: #8a5a6f;
        }
        
        /* Scrollbar */
        .table-container::-webkit-scrollbar {
            height: 8px;
        }
        
        .table-container::-webkit-scrollbar-track {
            background: #ffe4ef;
            border-radius: 10px;
        }
        
        .table-container::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #ff6fb4, #ff3d9a);
            border-radius: 10px;
        }
        
        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                text-align: center;
                padding: 25px 20px;
            }
            
            .page-title {
                font-size: 1.5rem;
            }
            
            .table-container {
                padding: 20px 15px;
            }
            
            .custom-table thead th,
            .custom-table tbody td {
                padding: 12px 10px;
                font-size: 0.8rem;
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
                LapMatch
            </a>
            <a href="dashboard.php" class="btn-back">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-container">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1 class="page-title">
                    <i class="bi bi-chat-left-text-fill"></i>
                    Data Pertanyaan
                </h1>
            </div>
            
            <?php
            $totalPertanyaan = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pertanyaan"));
            ?>
            <div class="total-badge">
                <i class="bi bi-list-check"></i>
                <?= $totalPertanyaan ?> Pertanyaan
            </div>
        </div>

        <!-- Table -->
        <div class="table-container">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Pertanyaan</th>
                        <th>Kategori</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $data = mysqli_query($koneksi, "SELECT * FROM pertanyaan");
                    
                    if ($data && mysqli_num_rows($data) > 0) {
                        while($d = mysqli_fetch_array($data)){
                            // Tentukan kelas badge berdasarkan kategori
                            $kategoriClass = '';
                            $kategoriIcon = 'bi-tag-fill';
                            if (strtolower($d['kategori']) == 'kebutuhan') {
                                $kategoriClass = 'kebutuhan';
                                $kategoriIcon = 'bi-bullseye';
                            } elseif (strtolower($d['kategori']) == 'budget') {
                                $kategoriClass = 'budget';
                                $kategoriIcon = 'bi-wallet2';
                            }
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td>
                            <span class="kode-badge">
                                <?= htmlspecialchars($d['kode']) ?>
                            </span>
                        </td>
                        <td>
                            <span class="pertanyaan-text">
                                <?= htmlspecialchars($d['pertanyaan']) ?>
                            </span>
                        </td>
                        <td>
                            <span class="kategori-badge <?= $kategoriClass ?>">
                                <i class="bi <?= $kategoriIcon ?>"></i>
                                <?= htmlspecialchars($d['kategori']) ?>
                            </span>
                        </td>
                    </tr>
                    <?php 
                        }
                    } else { 
                    ?>
                    <tr>
                        <td colspan="4">
                            <div class="empty-state">
                                <i class="bi bi-chat-left-text"></i>
                                <h4>Belum ada data pertanyaan</h4>
                                <p>Data pertanyaan akan muncul di sini</p>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>