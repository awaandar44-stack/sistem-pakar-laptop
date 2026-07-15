<?php
session_start();

if (!isset($_SESSION['hasil'])) {
    header("Location: konsultasi.php");
    exit;
}

$data = $_SESSION['hasil'];

if (!is_array($data) || empty($data)) {
    echo "<script>
    alert('Data hasil tidak valid. Silakan konsultasi ulang.');
    window.location='konsultasi.php';
    </script>";
    exit;
}

$namaLaptop = $data['nama_laptop']  ?? 'Laptop';
$processor  = $data['processor']    ?? '-';
$ram        = $data['ram']          ?? '-';
$ssd        = $data['ssd']          ?? '-';
$vga        = $data['vga']          ?? '-';
$harga      = $data['harga'] ?? 0;
$hargaFormatted = "Rp " . number_format($harga, 0, ",", ".");
$kategori   = $data['kategori']     ?? '';
$foto       = $data['foto'] ?? 'default-laptop.png';

$alasan = "Laptop ini direkomendasikan karena sesuai dengan kebutuhan dan budget yang dipilih berdasarkan metode Forward Chaining.";

// Deskripsi kategori
$deskripsi = [
    'Office'   => 'Laptop ini cocok untuk kebutuhan kerja kantoran, presentasi, mengetik, dan aktivitas harian lainnya.',
    'Desain'   => 'Laptop ini cocok untuk editing foto, ilustrasi, desain grafis, dan pekerjaan kreatif lainnya.',
    'Coding'   => 'Laptop ini cocok untuk coding, development, dan belajar pemrograman.',
    'Gaming'   => 'Laptop ini cocok untuk bermain game dengan performa tinggi dan grafis yang memukau.'
];
$deskripsiLaptop = $deskripsi[$kategori] ?? 'Laptop ini sesuai dengan kebutuhan dan budget yang dipilih.';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Hasil Rekomendasi - LapMatch</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
  *{font-family:'Plus Jakarta Sans',sans-serif;box-sizing:border-box}
  
  body{
    background:linear-gradient(135deg,#fff5f9 0%,#ffe8f2 50%,#fff0f6 100%);
    min-height:100vh;
    padding-bottom:60px;
  }
  
  /* NAVBAR */
  .navbar-custom{
    background:rgba(255,255,255,0.9);
    backdrop-filter:blur(14px);
    padding:15px 40px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    border-bottom:1px solid rgba(255,158,203,0.2);
    position:sticky;
    top:0;
    z-index:100;
  }
  
  .navbar-brand{
    display:flex;
    align-items:center;
    gap:10px;
    font-weight:700;
    font-size:1.3rem;
    color:#ff3d9a;
    text-decoration:none;
  }
  
  .navbar-brand img{
    width:32px;
    height:32px;
  }
  
  .nav-buttons{
    display:flex;
    gap:12px;
  }
  
  .btn-nav{
    padding:8px 20px;
    border-radius:30px;
    font-size:0.9rem;
    font-weight:600;
    text-decoration:none;
    transition:all 0.3s ease;
  }
  
  .btn-nav-outline{
    background:transparent;
    border:1.5px solid #ffb3d1;
    color:#ff3d9a;
  }
  
  .btn-nav-outline:hover{
    background:#ffe4ef;
    border-color:#ff3d9a;
  }
  
  .btn-nav-solid{
    background:linear-gradient(135deg,#ff6fb4,#ff3d9a);
    color:#fff;
    border:none;
  }
  
  .btn-nav-solid:hover{
    background:linear-gradient(135deg,#ff3d9a,#e91e82);
    color:#fff;
    transform:translateY(-2px);
  }
  
  /* CONTAINER */
  .container-hasil{
    max-width:1100px;
    margin:40px auto;
    padding:0 20px;
  }
  
  /* MAIN CARD */
  .main-card{
    background:#fff;
    border-radius:30px;
    padding:40px;
    box-shadow:0 20px 60px rgba(255,105,180,0.15);
    border:1px solid rgba(255,158,203,0.2);
  }
  
  /* LAPTOP SHOWCASE (kiri) */
  .laptop-showcase{
    background:linear-gradient(135deg,#fff0f6 10%,#ffe4ef 0%);
    border-radius:30px;
    padding:35px;
    text-align:center;
    position:relative;
    overflow:hidden;
    height:95%;
  }
  
  .badge-rekomendasi{
    position:absolute;
    top:10px;
    left:10px;
    background:linear-gradient(135deg,#ff6fb4,#ff3d9a);
    color:#fff;
    padding:8px 16px;
    border-radius:20px;
    font-size:0.8rem;
    font-weight:600;
    display:inline-flex;
    align-items:center;
    gap:6px;
  }
  
  .badge-fav{
    position:absolute;
    top:20px;
    right:20px;
    width:40px;
    height:40px;
    background:#fff;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#ff3d9a;
    font-size:1.2rem;
    box-shadow:0 4px 12px rgba(255,61,154,0.2);
  }
  
  .laptop-img{
    max-width:100%;
    height:auto;
    max-height:280px;
    object-fit:contain;
    margin:60px 0;
    filter:drop-shadow(0 15px 30px rgba(255,61,154,0.25));
    animation:float 3s ease-in-out infinite;
  }
  
  @keyframes float{
    0%,100%{transform:translateY(0);}
    50%{transform:translateY(-10px);}
  }
  
  .laptop-name{
    font-size:1.5rem;
    font-weight:800;
    color:#3a1a2a;
    margin-bottom:8px;
  }
  
  .laptop-category{
    display:inline-block;
    background:#fff;
    color:#ff3d9a;
    padding:6px 16px;
    border-radius:20px;
    font-size:0.85rem;
    font-weight:600;
    margin-bottom:15px;
  }
  
  .laptop-desc{
    color:#7a5066;
    font-size:0.9rem;
    line-height:1.6;
  }
  
  /* SPECS (kanan) */
  .specs-section h3{
    font-size:1.3rem;
    margin-top:30px;
    font-weight:700;
    color:#3a1a2a;
    margin-bottom:30px;
  }
  
  .specs-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:15px;
    margin-bottom:20px;
  }
  
  .spec-item{
    background:#fff5fa;
    border:1px solid rgba(255,158,203,0.2);
    border-radius:16px;
    padding:18px;
    display:flex;
    align-items:center;
    gap:12px;
    transition:all 0.3s ease;
  }
  
  .spec-item:hover{
    transform:translateY(-3px);
    box-shadow:0 8px 20px rgba(255,105,180,0.15);
  }
  
  .spec-icon{
    width:45px;
    height:45px;
    background:linear-gradient(135deg,#ffe4ef,#fff0f6);
    border-radius:12px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:1.3rem;
    color:#ff3d9a;
    flex-shrink:0;
  }
  
  .spec-info b{
    display:block;
    font-size:0.75rem;
    color:#9a7a8a;
    font-weight:600;
    text-transform:uppercase;
    letter-spacing:0.5px;
    margin-bottom:3px;
  }
  
  .spec-info span{
    font-size:0.95rem;
    font-weight:600;
    color:#3a1a2a;
  }
  
  /* HARGA CARD */
  .harga-card{
    background:linear-gradient(135deg,#ffe4ef 0%,#fff0f6 100%);
    border-radius:16px;
    padding:20px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin-bottom:20px;
  }
  
  .harga-label{
    font-size:0.85rem;
    color:#7a5066;
    font-weight:600;
    margin-bottom:5px;
  }
  
  .harga-value{
    font-size:1.8rem;
    font-weight:800;
    color:#ff3d9a;
  }
  
  .harga-icon{
    font-size:3rem;
  }
  
  /* RATING */
  .rating-card{
    background:#fff5fa;
    border-radius:16px;
    padding:18px;
    margin-bottom:20px;
  }
  
  .rating-title{
    font-size:0.95rem;
    font-weight:700;
    color:#3a1a2a;
    margin-bottom:8px;
  }
  
  .stars{
    color:#ffc107;
    font-size:1.2rem;
    letter-spacing:2px;
  }
  
  .rating-text{
    color:#7a5066;
    font-size:0.85rem;
    margin-left:8px;
  }
  
  /* ALASAN */
  .alasan-card{
    background:#fff5fa;
    border-radius:16px;
    padding:20px;
    margin-bottom:20px;
    border-left:4px solid #ff3d9a;
  }
  
  .alasan-card h5{
    font-size:1rem;
    font-weight:700;
    color:#3a1a2a;
    margin-bottom:8px;
    display:flex;
    align-items:center;
    gap:8px;
  }
  
  .alasan-card p{
    color:#7a5066;
    font-size:0.9rem;
    margin:0;
    line-height:1.6;
  }
  
  /* KELEBIHAN */
.kelebihan-card{
  background:#fff5fa;
  border-radius:20px;
  padding:25px;
  margin-bottom:20px;
}
.kelebihan-card h5{
  font-size:1.2rem;
  font-weight:700;
  color:#3a1a2a;
  margin-bottom:20px;
  display:flex;
  align-items:center;
  gap:10px;
}
.kelebihan-list{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:15px;
}
.kelebihan-item{
  display:flex;
  align-items:center;
  gap:12px;
  font-size:1rem;
  color:#5a3548;
  font-weight:600;
  padding:10px 14px;
  background:#fff;
  border-radius:12px;
  border:1px solid rgba(255,158,203,0.2);
  transition:all 0.3s ease;
}
.kelebihan-item:hover{
  transform:translateX(5px);
  border-color:#ff3d9a;
  box-shadow:0 4px 12px rgba(255,61,154,0.15);
}
.kelebihan-item i{
  font-size:1.3rem;
  flex-shrink:0;
}
  
  /* BUTTONS */
  .action-buttons{
    display:flex;
    justify-content:center;
    gap:15px;
    margin-top:30px;
    flex-wrap:wrap;
  }
  
  .btn-action{
    padding:12px 30px;
    border-radius:30px;
    font-weight:600;
    font-size:0.95rem;
    text-decoration:none;
    display:inline-flex;
    align-items:center;
    gap:8px;
    transition:all 0.3s ease;
    border:none;
    cursor:pointer;
  }
  
  .btn-action-outline{
    background:#fff;
    color:#ff3d9a;
    border:1.5px solid #ffb3d1;
  }
  
  .btn-action-outline:hover{
    background:#ffe4ef;
    transform:translateY(-2px);
  }
  
  .btn-action-solid{
    background:linear-gradient(135deg,#ff6fb4,#ff3d9a);
    color:#fff;
    box-shadow:0 8px 20px rgba(255,61,154,0.3);
  }
  
  .btn-action-solid:hover{
    background:linear-gradient(135deg,#ff3d9a,#e91e82);
    transform:translateY(-2px);
    box-shadow:0 12px 30px rgba(255,61,154,0.4);
  }
  
  /* RESPONSIVE */
  @media (max-width:768px){
    .navbar-custom{padding:12px 20px}
    .main-card{padding:25px 20px}
    .header-hasil h1{font-size:1.8rem}
    .specs-grid{grid-template-columns:1fr}
    .kelebihan-list{grid-template-columns:1fr}
    .harga-value{font-size:1.4rem}
    .laptop-name{font-size:1.2rem}
  }
  
  @media print{
    .navbar-custom, .action-buttons{display:none !important}
    body{background:#fff}
    .main-card{box-shadow:none}
  }

  /* HEADER DI DALAM CARD */
.header-dalam{
  text-align:center;
  margin-bottom:35px;
  padding-bottom:25px;
  border-bottom:2px dashed rgba(255,158,203,0.3);
}

.header-dalam h1{
  font-size:2.3rem;
  font-weight:800;
  color:#3a1a2a;
  margin-bottom:8px;
}

.header-dalam h1 span{
  color:#ff3d9a;
}

.header-dalam p{
  color:#8a5a6f;
  font-size:1rem;
  margin:0;
}

/* BUTTONS */
.action-buttons{
  display:flex;
  justify-content:center;
  gap:15px;
  margin-top:30px;
  flex-wrap:wrap;
}
.btn-action{
  padding:14px 32px;
  border-radius:30px;
  font-weight:600;
  font-size:1rem;
  text-decoration:none;
  display:inline-flex;
  align-items:center;
  gap:10px;
  transition:all 0.3s ease;
  border:none;
  cursor:pointer;
  min-width:180px;
  justify-content:center;
}
.btn-action-outline{
  background:#fff;
  color:#ff3d9a;
  border:2px solid #ffb3d1;
}
.btn-action-outline:hover{
  background:#ffe4ef;
  border-color:#ff3d9a;
  transform:translateY(-3px);
  box-shadow:0 8px 20px rgba(255,61,154,0.2);
}
.btn-action-solid{
  background:linear-gradient(135deg,#ff6fb4,#ff3d9a);
  color:#fff;
  box-shadow:0 8px 20px rgba(255,61,154,0.3);
}
.btn-action-solid:hover{
  background:linear-gradient(135deg,#ff3d9a,#e91e82);
  transform:translateY(-3px);
  box-shadow:0 12px 30px rgba(255,61,154,0.4);
}

@media (max-width:768px){
  .kelebihan-list{grid-template-columns:1fr}
  .kelebihan-item{font-size:0.95rem}
  .btn-action{min-width:100%; width:100%}
  .action-buttons{flex-direction:column}
}
</style>
</head>
<body>

<!-- CONTAINER -->
<div class="container-hasil">

<!-- MAIN CARD -->
<div class="main-card">
<!-- HEADER DI DALAM CARD -->
<div class="header-dalam">
  <h1>Yeay, Ketemu Nih! <span>✨</span></h1>
  <p>Sistem menemukan laptop yang paling sesuai untuk kebutuhanmu.</p>
</div>

  <div class="row g-4">
    
    <!-- KOLOM KIRI: LAPTOP SHOWCASE -->
    <div class="col-lg-5">
      <div class="laptop-showcase">
        <div class="badge-rekomendasi">
          <i class="bi bi-star-fill"></i> Rekomendasi Terbaik
        </div>
        <div class="badge-fav">
          <i class="bi bi-heart-fill"></i>
        </div>
        
        <!-- FOTO LAPTOP DINAMIS -->
        <img src="assets/img/laptop/<?= htmlspecialchars($foto) ?>" 
             alt="<?= htmlspecialchars($namaLaptop) ?>" 
             class="laptop-img"
             onerror="this.src='assets/img/laptop/default-laptop.png'">
        
        <h2 class="laptop-name"><?= htmlspecialchars($namaLaptop) ?></h2>
        <span class="laptop-category">
          <i class="bi bi-tag-fill"></i> <?= htmlspecialchars($kategori) ?>
        </span>
        <p class="laptop-desc"><?= $deskripsiLaptop ?></p>
      </div>
    </div>
    
    <!-- KOLOM KANAN: SPECS -->
    <div class="col-lg-7">
      <div class="specs-section">
        <h3><i class="bi bi-gear-fill" style="color:#ff3d9a"></i> Spesifikasi Utama</h3>
        
        <div class="specs-grid">
          <div class="spec-item">
            <div class="spec-icon"><i class="bi bi-cpu-fill"></i></div>
            <div class="spec-info">
              <b>Processor</b>
              <span><?= htmlspecialchars($processor) ?></span>
            </div>
          </div>
          
          <div class="spec-item">
            <div class="spec-icon"><i class="bi bi-memory"></i></div>
            <div class="spec-info">
              <b>RAM</b>
              <span><?= htmlspecialchars($ram) ?></span>
            </div>
          </div>
          
          <div class="spec-item">
            <div class="spec-icon"><i class="bi bi-device-ssd-fill"></i></div>
            <div class="spec-info">
              <b>SSD</b>
              <span><?= htmlspecialchars($ssd) ?></span>
            </div>
          </div>
          
          <div class="spec-item">
            <div class="spec-icon"><i class="bi bi-gpu-card"></i></div>
            <div class="spec-info">
              <b>VGA</b>
              <span><?= htmlspecialchars($vga) ?></span>
            </div>
          </div>
        </div>
        
        <!-- HARGA -->
        <div class="harga-card">
          <div>
            <div class="harga-label">Estimasi Harga</div>
            <div class="harga-value"><?= $hargaFormatted ?></div>
          </div>
          <div class="harga-icon">💰</div>
        </div>
        
        <!-- RATING -->
        <div class="rating-card">
          <div class="rating-title">
            <i class="bi bi-star-fill" style="color:#ffc107"></i> Rating Rekomendasi
          </div>
          <div>
            <span class="stars">★★★★★</span>
            <span class="rating-text">Sangat Cocok Untuk Kamu</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  
  <!-- KELEBIHAN -->
  <div class="kelebihan-card">
  <h5><i class="bi bi-stars" style="color:#ff3d9a"></i> Kelebihan Laptop</h5>
  <div class="kelebihan-list">
    <div class="kelebihan-item">
      <i class="bi bi-wallet2" style="color:#ff3d9a"></i>
      Sesuai dengan budget yang dipilih
    </div>
    <div class="kelebihan-item">
      <i class="bi bi-heart-pulse" style="color:#ff6fb4"></i>
      Cocok untuk kebutuhan pengguna
    </div>
    <div class="kelebihan-item">
      <i class="bi bi-lightning-charge-fill" style="color:#c084fc"></i>
      Performa stabil untuk aktivitas harian
    </div>
    <div class="kelebihan-item">
      <i class="bi bi-robot" style="color:#ff3d9a"></i>
      Direkomendasikan metode Forward Chaining
    </div>
  </div>
</div>
  
  <!-- BUTTONS -->
  <div class="action-buttons">
    <a href="konsultasi.php" class="btn-action btn-action-outline">
      <i class="bi bi-arrow-repeat"></i> Konsultasi Lagi
    </a>
      <a href="index.php" class="btn-action btn-action-outline">
        <i class="bi bi-house-door"></i> Beranda
    </a>
      <button onclick="window.print()" class="btn-action btn-action-solid">
         <i class="bi bi-download"></i> Simpan Hasil
    </button>
</div>
  
</div>
</div>

</body>
</html>