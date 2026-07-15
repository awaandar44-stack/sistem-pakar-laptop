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
    <title>Data Laptop - LapMatch</title>
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
        
        /* Action Buttons Container - biar sejajar */
        .action-buttons {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
        }
        
        .btn-back {
            background: #fff;
            color: #ff3d9a;
            border: 2px solid #ffb3d1;
            border-radius: 30px;
            padding: 10px 22px;
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
        
        .btn-add {
            background: linear-gradient(135deg, #ff6fb4, #ff3d9a);
            color: white;
            border: none;
            border-radius: 30px;
            padding: 12px 28px;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 8px 25px rgba(255, 61, 154, 0.3);
        }
        
        .btn-add:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(255, 61, 154, 0.4);
            color: white;
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
            white-space: nowrap;
        }
        
        .custom-table tbody tr:last-child td {
            border-bottom: none;
        }
        
        .custom-table tbody td:first-child {
            font-weight: 700;
            color: #ff3d9a;
        }
        
        .harga-badge {
            background: linear-gradient(135deg, #ffe4ef, #fff0f6);
            color: #ff3d9a;
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-block;
            border: 1px solid #ffb3d1;
        }
        
        .kategori-badge {
            background: linear-gradient(135deg, #ffe4ef, #fff0f6);
            color: #ff3d9a;
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-block;
            text-transform: capitalize;
            border: 1px solid #ffb3d1;
        }
        
        .btn-edit, .btn-hapus {
            border: none;
            border-radius: 20px;
            padding: 6px 14px;
            font-weight: 600;
            font-size: 0.8rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            color: white;
        }
        
        .btn-edit {
            background: linear-gradient(135deg, #ffc107, #ffb300);
            box-shadow: 0 4px 12px rgba(255, 193, 7, 0.25);
        }
        
        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(255, 193, 7, 0.4);
            color: white;
        }
        
        .btn-hapus {
            background: linear-gradient(135deg, #ff6b6b, #ee5a6f);
            box-shadow: 0 4px 12px rgba(255, 107, 107, 0.25);
        }
        
        .btn-hapus:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(255, 107, 107, 0.4);
            color: white;
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
        
        .empty-state p {
            font-size: 1.1rem;
            font-weight: 500;
            margin: 0;
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
            
            .action-buttons {
                justify-content: center;
                width: 100%;
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
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-container">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">
                <i class="bi bi-laptop"></i>
                Data Laptop
            </h1>
            
            <!-- Tombol dibungkus dalam satu container biar sejajar -->
            <div class="action-buttons">
                <a href="dashboard.php" class="btn-back">
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>
                <a href="tambah_laptop.php" class="btn-add">
                    <i class="bi bi-plus-circle"></i>
                    Tambah Laptop
                </a>
            </div>
        </div>

        <!-- Table -->
        <div class="table-container">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Laptop</th>
                        <th>Processor</th>
                        <th>RAM</th>
                        <th>SSD</th>
                        <th>VGA</th>
                        <th>Harga</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $data = mysqli_query($koneksi, "SELECT * FROM laptop");
                    
                    if (mysqli_num_rows($data) > 0) {
                        while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><strong><?= htmlspecialchars($d['nama_laptop']) ?></strong></td>
                        <td><?= htmlspecialchars($d['processor']) ?></td>
                        <td><?= htmlspecialchars($d['ram']) ?></td>
                        <td><?= htmlspecialchars($d['ssd']) ?></td>
                        <td><?= htmlspecialchars($d['vga']) ?></td>
                        <td><span class="harga-badge">Rp <?= number_format($d['harga'], 0, ',', '.') ?></span></td>
                        <td><span class="kategori-badge"><?= htmlspecialchars($d['kategori']) ?></span></td>
                        <td>
                            <a href="edit_laptop.php?id=<?= $d['id_laptop'] ?>" class="btn-edit">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <a href="hapus_laptop.php?id=<?= $d['id_laptop'] ?>" class="btn-hapus" onclick="return confirm('Yakin mau hapus laptop ini?')">
                                <i class="bi bi-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                    <?php 
                        }
                    } else { 
                    ?>
                    <tr>
                        <td colspan="9">
                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                <p>Belum ada data laptop</p>
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