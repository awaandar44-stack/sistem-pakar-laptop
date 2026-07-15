<?php
session_start();
include "../config/koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($koneksi, "SELECT * FROM laptop WHERE id_laptop='$id'");
$d = mysqli_fetch_array($data);

if(isset($_POST['update'])){
    $nama = $_POST['nama'];
    $processor = $_POST['processor'];
    $ram = $_POST['ram'];
    $ssd = $_POST['ssd'];
    $vga = $_POST['vga'];
    $harga = $_POST['harga'];
    $kategori = $_POST['kategori'];

    mysqli_query($koneksi,"UPDATE laptop SET
        nama_laptop='$nama',
        processor='$processor',
        ram='$ram',
        ssd='$ssd',
        vga='$vga',
        harga='$harga',
        kategori='$kategori'
        WHERE id_laptop='$id'");

    header("Location:laptop.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>✨ Edit Laptop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        :root {
            --pink-light: #ffe4e8;
            --pink-main: #ff6b9d;
            --pink-dark: #ff4081;
            --white: #ffffff;
            --cream: #fff9fa;
            --purple: #a855f7;
            --purple-dark: #7c3aed;
            --mint: #10b981;
            --mint-dark: #059669;
        }
        
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        /* Animated background blobs */
        .blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.4;
            z-index: 0;
            animation: float 20s infinite ease-in-out;
        }
        
        .blob-1 {
            width: 400px;
            height: 400px;
            background: var(--pink-main);
            top: -100px;
            left: -100px;
        }
        
        .blob-2 {
            width: 300px;
            height: 300px;
            background: var(--purple);
            bottom: -50px;
            right: -50px;
            animation-delay: 5s;
        }
        
        .blob-3 {
            width: 250px;
            height: 250px;
            background: #f093fb;
            top: 50%;
            left: 50%;
            animation-delay: 10s;
        }
        
        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
        }
        
        /* Glassmorphism Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.1) !important;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
            position: relative;
            z-index: 10;
        }
        
        .navbar-brand {
            font-family: 'Quicksand', sans-serif;
            font-weight: 700;
            font-size: 1.6rem;
            background: linear-gradient(135deg, #fff 0%, #ffe4e8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .btn-back {
            background: rgba(255, 255, 255, 0.95);
            color: var(--pink-dark);
            border: none;
            border-radius: 50px;
            padding: 0.6rem 1.8rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-back:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
            color: var(--pink-dark);
        }
        
        .main-container {
            position: relative;
            z-index: 1;
            padding: 3rem 0;
        }
        
        /* Page Header */
        .page-header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 2rem 2.5rem;
            border: 2px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 2rem;
            text-align: center;
        }
        
        .page-title {
            font-family: 'Quicksand', sans-serif;
            color: white;
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
        }
        
        .page-title i {
            font-size: 2.2rem;
            background: linear-gradient(135deg, #fff 0%, #ffe4e8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .page-subtitle {
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.95rem;
            margin: 0.5rem 0 0 0;
        }
        
        /* Edit Badge */
        .edit-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.95);
            color: var(--purple-dark);
            padding: 0.5rem 1.2rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            margin-top: 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .edit-badge i {
            color: var(--pink-main);
            font-size: 1rem;
        }
        
        /* Form Container */
        .form-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            padding: 3rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.3);
            max-width: 800px;
            margin: 0 auto;
        }
        
        .form-section-title {
            font-family: 'Quicksand', sans-serif;
            color: var(--pink-dark);
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding-bottom: 0.8rem;
            border-bottom: 2px dashed var(--pink-light);
        }
        
        .form-section-title i {
            color: var(--pink-main);
            font-size: 1.5rem;
        }
        
        /* Input Group */
        .input-group-custom {
            position: relative;
            margin-bottom: 1.5rem;
        }
        
        .input-group-custom label {
            display: block;
            font-family: 'Quicksand', sans-serif;
            font-weight: 600;
            color: #555;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }
        
        .input-group-custom label i {
            color: var(--pink-main);
            font-size: 1.1rem;
        }
        
        .input-group-custom input {
            width: 100%;
            padding: 0.9rem 1.2rem 0.9rem 3rem;
            border: 2px solid var(--pink-light);
            border-radius: 15px;
            font-size: 0.95rem;
            font-weight: 500;
            color: #333;
            background: white;
            transition: all 0.3s ease;
            outline: none;
        }
        
        .input-group-custom input:focus {
            border-color: var(--pink-main);
            box-shadow: 0 0 0 4px rgba(255, 107, 157, 0.15);
            transform: translateY(-2px);
        }
        
        .input-icon {
            position: absolute;
            left: 1rem;
            top: 2.7rem;
            color: var(--pink-main);
            font-size: 1.1rem;
            pointer-events: none;
            transition: all 0.3s ease;
        }
        
        .input-group-custom input:focus ~ .input-icon {
            color: var(--pink-dark);
            transform: scale(1.1);
        }
        
        /* Helper Text */
        .helper-text {
            font-size: 0.8rem;
            color: #999;
            margin-top: 0.3rem;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }
        
        .helper-text i {
            color: var(--pink-main);
            font-size: 0.9rem;
        }
        
        /* Two Column Layout */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }
        
        /* Kategori Options - Visual Style */
        .kategori-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
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
            padding: 1.5rem 1rem;
            border: 2px solid var(--pink-light);
            border-radius: 20px;
            background: white;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            text-align: center;
            min-height: 120px;
        }
        
        .kategori-option label i {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, var(--pink-main) 0%, var(--purple) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .kategori-option label span {
            font-family: 'Quicksand', sans-serif;
            font-weight: 600;
            color: #555;
            font-size: 0.95rem;
        }
        
        .kategori-option input[type="radio"]:checked + label {
            border-color: var(--pink-main);
            background: linear-gradient(135deg, #ffe4e8 0%, #fff 100%);
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(255, 107, 157, 0.25);
        }
        
        .kategori-option input[type="radio"]:checked + label i {
            transform: scale(1.2);
        }
        
        .kategori-option label:hover {
            border-color: var(--pink-main);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255, 107, 157, 0.15);
        }
        
        /* Buttons */
        .button-group {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }
        
        .btn-update {
            background: linear-gradient(135deg, var(--mint) 0%, var(--mint-dark) 100%);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 0.9rem 2.5rem;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            box-shadow: 0 10px 30px rgba(16, 185, 129, 0.4);
            flex: 1;
            justify-content: center;
            min-width: 180px;
        }
        
        .btn-update:hover {
            transform: translateY(-3px) scale(1.03);
            box-shadow: 0 15px 40px rgba(16, 185, 129, 0.5);
            color: white;
        }
        
        .btn-batal {
            background: white;
            color: var(--pink-dark);
            border: 2px solid var(--pink-light);
            border-radius: 50px;
            padding: 0.9rem 2.5rem;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            flex: 1;
            justify-content: center;
            min-width: 180px;
        }
        
        .btn-batal:hover {
            background: var(--pink-light);
            border-color: var(--pink-main);
            transform: translateY(-3px);
            color: var(--pink-dark);
        }
        
        @media (max-width: 768px) {
            .form-container {
                padding: 2rem 1.5rem;
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
        }
    </style>
</head>

<body>
    <!-- Animated Background -->
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <span class="navbar-brand">
                <i class="bi bi-stars"></i> Dashboard Admin
            </span>
            <a href="laptop.php" class="btn-back">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container main-container">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">
                <i class="bi bi-pencil-square"></i>
                Edit Laptop
            </h1>
            <p class="page-subtitle">Update detail laptop sesuai yang kamu mau ✏️</p>
            <div class="edit-badge">
                <i class="bi bi-info-circle"></i>
                ID Laptop: #<?= $d['id_laptop'] ?>
            </div>
        </div>

        <!-- Form -->
        <div class="form-container">
            <form method="POST">
                <!-- Section: Identitas Laptop -->
                <div class="form-section-title">
                    <i class="bi bi-tag"></i>
                    Identitas Laptop
                </div>
                
                <div class="input-group-custom">
                    <label><i class="bi bi-laptop"></i> Nama Laptop</label>
                    <input type="text" name="nama" value="<?= htmlspecialchars($d['nama_laptop']); ?>" required>
                    <i class="bi bi-laptop input-icon"></i>
                </div>

                <!-- Section: Spesifikasi -->
                <div class="form-section-title" style="margin-top: 2rem;">
                    <i class="bi bi-cpu"></i>
                    Spesifikasi Hardware
                </div>

                <div class="form-row">
                    <div class="input-group-custom">
                        <label><i class="bi bi-cpu"></i> Processor</label>
                        <input type="text" name="processor" value="<?= htmlspecialchars($d['processor']); ?>" required>
                        <i class="bi bi-cpu input-icon"></i>
                    </div>

                    <div class="input-group-custom">
                        <label><i class="bi bi-memory"></i> RAM</label>
                        <input type="text" name="ram" value="<?= htmlspecialchars($d['ram']); ?>" required>
                        <i class="bi bi-memory input-icon"></i>
                    </div>

                    <div class="input-group-custom">
                        <label><i class="bi bi-device-ssd"></i> SSD / Storage</label>
                        <input type="text" name="ssd" value="<?= htmlspecialchars($d['ssd']); ?>" required>
                        <i class="bi bi-device-ssd input-icon"></i>
                    </div>

                    <div class="input-group-custom">
                        <label><i class="bi bi-gpu-card"></i> VGA / GPU</label>
                        <input type="text" name="vga" value="<?= htmlspecialchars($d['vga']); ?>" required>
                        <i class="bi bi-gpu-card input-icon"></i>
                    </div>
                </div>

                <!-- Section: Harga & Kategori -->
                <div class="form-section-title" style="margin-top: 2rem;">
                    <i class="bi bi-price-tag"></i>
                    Harga & Kategori
                </div>

                <div class="input-group-custom">
                    <label><i class="bi bi-cash-stack"></i> Harga (dalam Rupiah)</label>
                    <input type="number" name="harga" value="<?= htmlspecialchars($d['harga']); ?>" required>
                    <i class="bi bi-cash-stack input-icon"></i>
                    <div class="helper-text"><i class="bi bi-info-circle"></i> Masukkan harga tanpa titik/koma</div>
                </div>

                <label style="font-family: 'Quicksand', sans-serif; font-weight: 600; color: #555; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.4rem;">
                    <i class="bi bi-bookmark-star" style="color: var(--pink-main); font-size: 1.1rem;"></i> 
                    Pilih Kategori
                </label>
                
                <div class="kategori-grid">
                    <?php 
                    $kategori_list = [
                        'Office' => 'bi-briefcase',
                        'Coding' => 'bi-code-slash',
                        'Desain' => 'bi-palette',
                        'Gaming' => 'bi-controller'
                    ];
                    foreach ($kategori_list as $kat => $icon):
                        $checked = ($d['kategori'] == $kat) ? 'checked' : '';
                    ?>
                    <div class="kategori-option">
                        <input type="radio" id="<?= strtolower($kat) ?>" name="kategori" value="<?= $kat ?>" <?= $checked ?>>
                        <label for="<?= strtolower($kat) ?>">
                            <i class="bi <?= $icon ?>"></i>
                            <span><?= $kat ?></span>
                        </label>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Buttons -->
                <div class="button-group">
                    <button type="submit" name="update" class="btn-update">
                        <i class="bi bi-check-circle"></i>
                        Update Laptop
                    </button>
                    <a href="laptop.php" class="btn-batal">
                        <i class="bi bi-x-circle"></i>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>