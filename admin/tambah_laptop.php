<?php
session_start();

include "../config/koneksi.php";

if(isset($_POST['simpan'])){
    $nama = $_POST['nama'];
    $processor = $_POST['processor'];
    $ram = $_POST['ram'];
    $ssd = $_POST['ssd'];
    $vga = $_POST['vga'];
    $harga = $_POST['harga'];
    $kategori = $_POST['kategori'];

    mysqli_query($koneksi, "INSERT INTO laptop VALUES ('','$nama','$processor','$ram','$ssd','$vga','$harga','$kategori')");
    header("Location:laptop.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Laptop - LapMatch</title>
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
        
        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 61, 154, 0.4);
            color: white;
        }
        
        /* Main Container */
        .main-container {
            max-width: 900px;
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
            text-align: center;
        }
        
        .page-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #ff3d9a;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }
        
        .page-title i {
            font-size: 2rem;
        }
        
        .page-subtitle {
            color: #8a5a6f;
            font-size: 0.95rem;
            margin-top: 8px;
        }
        
        /* Form Container */
        .form-container {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 158, 203, 0.2);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(255, 61, 154, 0.1);
        }
        
        .form-section-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: #ff3d9a;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px dashed #ffe4ef;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .form-section-title i {
            font-size: 1.3rem;
        }
        
        /* Input Group */
        .input-group-custom {
            margin-bottom: 20px;
        }
        
        .input-group-custom label {
            display: block;
            font-weight: 600;
            color: #5a2540;
            margin-bottom: 8px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .input-group-custom label i {
            color: #ff3d9a;
            font-size: 1rem;
        }
        
        .input-group-custom input,
        .input-group-custom select {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #ffc9e0;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 500;
            color: #4a2636;
            background: rgba(255, 255, 255, 0.9);
            transition: all 0.25s ease;
            outline: none;
        }
        
        .input-group-custom input::placeholder {
            color: #c98aa8;
        }
        
        .input-group-custom input:focus,
        .input-group-custom select:focus {
            border-color: #ff6fb4;
            box-shadow: 0 0 0 4px rgba(255, 111, 180, 0.15);
            background: #fff;
        }
        
        .input-group-custom select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23ff3d9a' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            padding-right: 3rem;
            cursor: pointer;
        }
        
        .helper-text {
            font-size: 0.8rem;
            color: #9a7a8a;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        
        .helper-text i {
            color: #ff6fb4;
        }
        
        /* Kategori Grid */
        .kategori-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 25px;
        }
        
        .kategori-option {
            position: relative;
        }
        
        .kategori-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }
        
        .kategori-option label {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px 12px;
            border: 2px solid #ffe4ef;
            border-radius: 16px;
            background: #fff;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            min-height: 110px;
        }
        
        .kategori-option label i {
            font-size: 1.8rem;
            color: #ff3d9a;
            margin-bottom: 8px;
            transition: all 0.3s ease;
        }
        
        .kategori-option label span {
            font-weight: 600;
            color: #5a3548;
            font-size: 0.9rem;
        }
        
        .kategori-option input[type="radio"]:checked + label {
            border-color: #ff3d9a;
            background: linear-gradient(135deg, #fff0f6 0%, #ffe4ef 100%);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255, 61, 154, 0.2);
        }
        
        .kategori-option input[type="radio"]:checked + label i {
            transform: scale(1.15);
        }
        
        .kategori-option label:hover {
            border-color: #ff6fb4;
            background: #fff5f8;
        }
        
        /* Two Column Layout */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        /* Buttons */
        .button-group {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            flex-wrap: wrap;
        }
        
        .btn-simpan {
            background: linear-gradient(135deg, #ff6fb4, #ff3d9a);
            color: white;
            border: none;
            border-radius: 30px;
            padding: 13px 30px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 8px 25px rgba(255, 61, 154, 0.3);
            flex: 1;
            justify-content: center;
            min-width: 180px;
            cursor: pointer;
        }
        
        .btn-simpan:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(255, 61, 154, 0.4);
        }
        
        .btn-batal {
            background: #fff;
            color: #ff3d9a;
            border: 2px solid #ffb3d1;
            border-radius: 30px;
            padding: 13px 30px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            flex: 1;
            justify-content: center;
            min-width: 180px;
        }
        
        .btn-batal:hover {
            background: #fff5f8;
            border-color: #ff3d9a;
            transform: translateY(-3px);
            color: #ff3d9a;
        }
        
        @media (max-width: 768px) {
            .form-container {
                padding: 25px 20px;
            }
            
            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
            
            .page-title {
                font-size: 1.5rem;
            }
            
            .kategori-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .button-group {
                flex-direction: column;
            }
            
            .btn-simpan, .btn-batal {
                width: 100%;
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
            <a href="laptop.php" class="btn-back">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-container">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">
                <i class="bi bi-laptop"></i>
                Tambah Laptop Baru
            </h1>
        </div>

        <!-- Form -->
        <div class="form-container">
            <form method="POST">
                <!-- Section: Identitas Laptop -->
                <div class="form-section-title">
                    <i class="bi bi-tag-fill"></i>
                    Identitas Laptop
                </div>
                
                <div class="input-group-custom">
                    <label><i class="bi bi-laptop"></i> Nama Laptop</label>
                    <input type="text" name="nama" placeholder="Contoh: ASUS ROG Strix G15" required>
                    <div class="helper-text"><i class="bi bi-info-circle"></i> Masukkan nama lengkap laptop</div>
                </div>

                <!-- Section: Spesifikasi -->
                <div class="form-section-title" style="margin-top: 30px;">
                    <i class="bi bi-cpu-fill"></i>
                    Spesifikasi Hardware
                </div>

                <div class="form-row">
                    <div class="input-group-custom">
                        <label><i class="bi bi-cpu-fill"></i> Processor</label>
                        <input type="text" name="processor" placeholder="Contoh: Intel Core i7-12700H" required>
                    </div>

                    <div class="input-group-custom">
                        <label><i class="bi bi-memory"></i> RAM</label>
                        <input type="text" name="ram" placeholder="Contoh: 16GB DDR4" required>
                    </div>

                    <div class="input-group-custom">
                        <label><i class="bi bi-device-ssd-fill"></i> SSD / Storage</label>
                        <input type="text" name="ssd" placeholder="Contoh: 512GB NVMe" required>
                    </div>

                    <div class="input-group-custom">
                        <label><i class="bi bi-gpu-card"></i> VGA / GPU</label>
                        <input type="text" name="vga" placeholder="Contoh: RTX 3060 6GB" required>
                    </div>
                </div>

                <!-- Section: Harga & Kategori -->
                <div class="form-section-title" style="margin-top: 30px;">
                    <i class="bi bi-price-tag-fill"></i>
                    Harga & Kategori
                </div>

                <div class="input-group-custom">
                    <label><i class="bi bi-cash-stack"></i> Harga (dalam Rupiah)</label>
                    <input type="number" name="harga" placeholder="Contoh: 15000000" required>
                    <div class="helper-text"><i class="bi bi-info-circle"></i> Masukkan harga tanpa titik/koma</div>
                </div>

                <label style="font-weight: 600; color: #5a2540; margin-bottom: 12px; display: flex; align-items: center; gap: 6px; font-size: 0.9rem;">
                    <i class="bi bi-bookmark-star-fill" style="color: #ff3d9a; font-size: 1rem;"></i> 
                    Pilih Kategori
                </label>
                
                <div class="kategori-grid">
                    <div class="kategori-option">
                        <input type="radio" id="office" name="kategori" value="Office" checked>
                        <label for="office">
                            <i class="bi bi-briefcase-fill"></i>
                            <span>Office</span>
                        </label>
                    </div>
                    <div class="kategori-option">
                        <input type="radio" id="coding" name="kategori" value="Coding">
                        <label for="coding">
                            <i class="bi bi-code-slash"></i>
                            <span>Coding</span>
                        </label>
                    </div>
                    <div class="kategori-option">
                        <input type="radio" id="desain" name="kategori" value="Desain">
                        <label for="desain">
                            <i class="bi bi-palette-fill"></i>
                            <span>Desain</span>
                        </label>
                    </div>
                    <div class="kategori-option">
                        <input type="radio" id="gaming" name="kategori" value="Gaming">
                        <label for="gaming">
                            <i class="bi bi-controller"></i>
                            <span>Gaming</span>
                        </label>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="button-group">
                    <button type="submit" name="simpan" class="btn-simpan">
                        <i class="bi bi-check-circle-fill"></i>
                        Simpan Laptop
                    </button>
                    <a href="laptop.php" class="btn-batal">
                        <i class="bi bi-x-circle-fill"></i>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>