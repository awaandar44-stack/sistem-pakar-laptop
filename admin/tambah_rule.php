<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location:login.php");
}

include "../config/koneksi.php";

if(isset($_POST['simpan'])){

    $budget = $_POST['budget'];
    $kebutuhan = $_POST['kebutuhan'];
    $id_laptop = $_POST['id_laptop'];

    mysqli_query($koneksi,"INSERT INTO rule(budget,kebutuhan,id_laptop)
    VALUES('$budget','$kebutuhan','$id_laptop')");

    header("Location:rule.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Rule - LapMatch</title>
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
            max-width: 800px;
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
            margin-bottom: 22px;
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
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23ff3d9a' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            padding-right: 3rem;
            cursor: pointer;
        }
        
        .input-group-custom select:focus {
            border-color: #ff6fb4;
            box-shadow: 0 0 0 4px rgba(255, 111, 180, 0.15);
            background-color: #fff;
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
            
            .page-title {
                font-size: 1.5rem;
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
            <a href="rule.php" class="btn-back">
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
                <i class="bi bi-diagram-3-fill"></i>
                Tambah Rule Forward Chaining
            </h1>
        </div>

        <!-- Form -->
        <div class="form-container">
            <form method="POST">
                
                <!-- Info Box -->
                <div class="info-box">
                    <i class="bi bi-info-circle-fill"></i>
                    <p>Rule akan digunakan oleh sistem untuk mencocokkan jawaban pengguna dengan laptop yang tepat berdasarkan metode Forward Chaining.</p>
                </div>

                <!-- Section: Budget -->
                <div class="form-section-title">
                    <i class="bi bi-cash-coin"></i>
                    Pilih Budget
                </div>
                
                <div class="input-group-custom">
                    <label><i class="bi bi-wallet2"></i> Range Budget</label>
                    <select name="budget" required>
                        <option value="">-- Pilih Budget --</option>
                        <option value="<6">&lt; Rp 6.000.000</option>
                        <option value="6-10">Rp 6.000.000 - Rp 10.000.000</option>
                        <option value=">10">&gt; Rp 10.000.000</option>
                    </select>
                    <div class="helper-text">
                        <i class="bi bi-info-circle"></i> Pilih range harga laptop yang akan direkomendasikan
                    </div>
                </div>

                <!-- Section: Kebutuhan -->
                <div class="form-section-title" style="margin-top: 30px;">
                    <i class="bi bi-target"></i>
                    Pilih Kebutuhan
                </div>
                
                <div class="input-group-custom">
                    <label><i class="bi bi-bullseye"></i> Kategori Kebutuhan</label>
                    <select name="kebutuhan" required>
                        <option value="">-- Pilih Kebutuhan --</option>
                        <option value="Office">💼 Office</option>
                        <option value="Coding">👨‍💻 Coding</option>
                        <option value="Desain">🎨 Desain</option>
                        <option value="Gaming">🎮 Gaming</option>
                    </select>
                    <div class="helper-text">
                        <i class="bi bi-info-circle"></i> Pilih kategori penggunaan utama laptop
                    </div>
                </div>

                <!-- Section: Laptop -->
                <div class="form-section-title" style="margin-top: 30px;">
                    <i class="bi bi-laptop"></i>
                    Pilih Laptop
                </div>
                
                <div class="input-group-custom">
                    <label><i class="bi bi-pc-display"></i> Laptop yang Direkomendasikan</label>
                    <select name="id_laptop" required>
                        <option value="">-- Pilih Laptop --</option>
                        <?php
                        $laptop = mysqli_query($koneksi,"SELECT * FROM laptop");
                        while($l = mysqli_fetch_array($laptop)){
                        ?>
                        <option value="<?= $l['id_laptop']; ?>">
                            <?= htmlspecialchars($l['nama_laptop']); ?>
                        </option>
                        <?php } ?>
                    </select>
                    <div class="helper-text">
                        <i class="bi bi-info-circle"></i> Laptop ini akan direkomendasikan jika kombinasi budget & kebutuhan cocok
                    </div>
                </div>

                <!-- Buttons -->
                <div class="button-group">
                    <button type="submit" name="simpan" class="btn-simpan">
                        <i class="bi bi-check-circle-fill"></i>
                        Simpan Rule
                    </button>
                    <a href="rule.php" class="btn-batal">
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