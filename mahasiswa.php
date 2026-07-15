<?php
include "config/koneksi.php";
session_start(); // Pastikan session dimulai

if(isset($_POST['simpan'])){
    $nama=$_POST['nama'];
    $nim=$_POST['nim'];
    $jk=$_POST['jk'];
    $prodi=$_POST['prodi'];
    $semester=$_POST['semester'];
    $email=$_POST['email'];
    $no_hp=$_POST['no_hp'];
    
    mysqli_query($koneksi,"INSERT INTO mahasiswa
    VALUES
    ('','$nama','$nim','$jk','$prodi','$semester','$email','$no_hp',NOW())");
    
    // TAMBAHKAN INI:
    $_SESSION['nama'] = $nama;
    
    header("Location:konsultasi.php?nama=".$nama);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Data Mahasiswa 💖</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">

<style>
  :root{
    --pink-50:#fff0f6;
    --pink-100:#ffe4ef;
    --pink-200:#ffc9e0;
    --pink-300:#ff9ecb;
    --pink-400:#ff6fb4;
    --pink-500:#ff3d9a;
    --pink-600:#e91e82;
    --text:#4a2636;
  }

  *{font-family: 'Plus Jakarta Sans', sans-serif;}

  body{
    background: linear-gradient(135deg, #fff5f9 0%, #ffe8f2 50%, #fff0f6 100%);
    color: var(--text);
    min-height: 100vh;
    position: relative;
    overflow-x: hidden;
  }

  /* Blob dekoratif di background */
  body::before{
    content:"";
    position: fixed;
    width: 400px; height: 400px;
    background: radial-gradient(circle, rgba(255,158,203,0.25), transparent 70%);
    border-radius: 50%;
    top: -150px; left: -150px;
    z-index: 0;
  }
  body::after{
    content:"";
    position: fixed;
    width: 350px; height: 350px;
    background: radial-gradient(circle, rgba(232,199,255,0.3), transparent 70%);
    border-radius: 50%;
    bottom: -100px; right: -100px;
    z-index: 0;
  }

  .container.py-5{position: relative; z-index: 1;}

  /* CARD */
  .card{
    background: rgba(255,255,255,0.85) !important;
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border: 1px solid rgba(255,158,203,0.3) !important;
    box-shadow: 0 20px 60px rgba(255,61,154,0.15) !important;
    transition: all 0.3s ease;
  }
  .card:hover{
    box-shadow: 0 25px 70px rgba(255,61,154,0.2) !important;
  }

  /* HEADING */
  .card h2{
    font-weight: 800 !important;
    color: #3a1a2a !important;
    background: linear-gradient(135deg, #ff3d9a, #ff6fb4);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    display: inline-block;
    width: 100%;
  }

  /* SUBTITLE */
  .card p.text-muted{
    color: #7a5066 !important;
    font-weight: 500;
  }

  /* LABEL */
  label{
    color: #5a2540 !important;
    font-weight: 600 !important;
    margin-bottom: 6px !important;
    font-size: 0.92rem;
  }

  /* FORM CONTROL & SELECT */
  .form-control,
  .form-select{
    background: rgba(255,255,255,0.9) !important;
    border: 1.5px solid var(--pink-200) !important;
    border-radius: 14px !important;
    padding: 11px 16px !important;
    color: var(--text) !important;
    font-size: 0.95rem !important;
    transition: all 0.25s ease;
  }
  .form-control::placeholder{
    color: #c98aa8 !important;
  }
  .form-control:focus,
  .form-select:focus{
    border-color: var(--pink-400) !important;
    box-shadow: 0 0 0 4px rgba(255,111,180,0.15) !important;
    background: #fff !important;
  }

  /* BUTTON */
  .btn-primary{
    background: linear-gradient(135deg, #ff6fb4 0%, #ff3d9a 100%) !important;
    border: none !important;
    border-radius: 30px !important;
    padding: 13px 30px !important;
    font-weight: 600 !important;
    letter-spacing: 0.3px;
    box-shadow: 0 10px 30px rgba(255,61,154,0.35) !important;
    transition: all 0.3s ease !important;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
  }
  
  .btn-primary:hover{
    transform: translateY(-3px) !important;
    box-shadow: 0 15px 40px rgba(255,61,154,0.5) !important;
    background: linear-gradient(135deg, #ff3d9a 0%, #e91e82 100%) !important;
  }
  .btn-primary:active{
    transform: translateY(-1px) !important;
  }

  /* RESPONSIVE */
  @media (max-width: 768px){
    .card-body{padding: 2rem 1.5rem !important;}
    .card h2{font-size: 1.5rem !important;}
  }
</style>
</head>
<body>

<div class="container py-5">
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="card shadow-lg border-0 rounded-5">
<div class="card-body p-5">

<h2 class="text-center mb-4">
👤 Data Mahasiswa
</h2>
<p class="text-center text-muted">
Silakan isi identitas terlebih dahulu sebelum melakukan konsultasi.
</p>

<form method="POST">
<div class="row">

<div class="col-md-6 mb-3">
<label>Nama Lengkap</label>
<input type="text" name="nama" class="form-control" required>
</div>

<div class="col-md-6 mb-3">
<label>NIM</label>
<input type="text" name="nim" class="form-control" required>
</div>

<div class="col-md-6 mb-3">
<label>Jenis Kelamin</label>
<select name="jk" class="form-select" required>
<option>Laki-laki</option>
<option>Perempuan</option>
</select>
</div>

<div class="col-md-6 mb-3">
<label>Program Studi</label>
<select name="prodi" class="form-select" required>
<option>Sistem Informasi</option>
<option>Teknik Informatika</option>
<option>Bisnis Digital</option>
</select>
</div>

<div class="col-md-6 mb-3">
<label>Semester</label>
<select name="semester" class="form-select" required>
<?php
for($i=1;$i<=8;$i++){
echo "<option>$i</option>";
}
?>
</select>
</div>

<div class="col-md-6 mb-3">
<label>No HP</label>
<input type="text" name="no_hp" class="form-control">
</div>

<div class="col-12 mb-4">
<label>Email</label>
<input type="email" name="email" class="form-control">
</div>

<div class="d-grid">
<button class="btn btn-primary btn-lg" name="simpan">
Lanjut Konsultasi
</button>
</div>

</div>
</form>

</div>
</div>
</div>
</div>
</div>

</body>
</html>