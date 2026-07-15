<?php
include "config/koneksi.php";
session_start();
?>
<!DOCTYPE html>
<html lang='id'>
<head>
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width,initial-scale=1.0'>
<title>Konsultasi LapMatch</title>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css'>
<link href='https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap' rel='stylesheet'>
<style>
  *{font-family:'Plus Jakarta Sans',sans-serif;margin:0;padding:0;box-sizing:border-box}
  
  body{
    background:linear-gradient(135deg,#fff7fb 0%,#ffe8f3 50%,#fff1f8 100%);
    min-height:100vh;
    padding:60px 20px;
  }
  
  .container{max-width:1000px}
  
  /* HEADER */
.header{
  text-align:center;
  margin-bottom:10px;
}

.header-icon{
  width:140px;
  height:auto;
  object-fit:contain;
  margin-bottom:12px;
  filter:drop-shadow(0 15px 30px rgba(255,111,180,0.3));
  animation:float 3s ease-in-out infinite;
}

@keyframes float{
  0%,100%{transform:translateY(0);}
  50%{transform:translateY(-8px);}
}
  
  .header h1{
    font-size:2rem;
    font-weight:700;
    background:linear-gradient(135deg,#ff3d9a,#c084fc);
    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
    margin-bottom:8px;
  }
  
  .header p{
    color:#8a5a6f;
    font-size:0.95rem;
  }
  
  /* CONTENT GRID */
  .content-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:30px;
    margin-bottom:30px;
  }
  
  /* SECTION */
  .section{
    background:rgba(255,255,255,0.9);
    border-radius:20px;
    padding:30px;
    border:1px solid rgba(255,158,203,0.2);
  }
  
  .section-title{
    font-size:1.1rem;
    font-weight:700;
    color:#3a1a2a;
    margin-bottom:20px;
    display:flex;
    align-items:center;
    gap:10px;
  }
  
  .section-title span{
    background:linear-gradient(135deg,#ff3d9a,#c084fc);
    color:#fff;
    width:28px;
    height:28px;
    border-radius:8px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    font-size:0.9rem;
  }
  
  .section-desc{
    color:#9a7a8a;
    font-size:0.85rem;
    margin-bottom:20px;
  }
  
  /* OPTION */
  .option{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:16px 18px;
    background:#fff;
    border:2px solid #f0e6ed;
    border-radius:14px;
    margin-bottom:12px;
    cursor:pointer;
    transition:all 0.3s ease;
  }
  
  .option:last-child{margin-bottom:0}
  
  .option:hover{
    border-color:#ffd6e8;
    background:#fff5f8;
  }
  
  .option input[type="radio"]{
    appearance:none;
    -webkit-appearance:none;
    width:22px;
    height:22px;
    border:2px solid #ffb3d1;
    border-radius:50%;
    position:relative;
    cursor:pointer;
    transition:all 0.2s ease;
  }
  
  .option input[type="radio"]:checked{
    border-color:#ff3d9a;
    background:#ff3d9a;
  }
  
  .option input[type="radio"]:checked::after{
    content:"";
    position:absolute;
    top:50%;left:50%;
    transform:translate(-50%,-50%);
    width:8px;height:8px;
    background:#fff;
    border-radius:50%;
  }
  
  .option-content{
    display:flex;
    align-items:center;
    gap:12px;
    flex:1;
  }
  
  .option-icon{
    width:40px;
    height:40px;
    background:linear-gradient(135deg,#ffe4ef,#f0e6ff);
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:1.2rem;
  }
  
  .option-text h4{
    font-size:0.95rem;
    font-weight:600;
    color:#3a1a2a;
    margin-bottom:3px;
  }
  
  .option-text p{
    font-size:0.8rem;
    color:#9a7a8a;
    margin:0;
  }
  
  /* BUTTON */
  .btn-submit{
    width:100%;
    background:linear-gradient(135deg,#ff3d9a 0%,#c084fc 100%);
    color:#fff;
    border:none;
    padding:18px;
    border-radius:50px;
    font-size:1.05rem;
    font-weight:600;
    box-shadow:0 10px 30px rgba(255,61,154,0.3);
    transition:all 0.3s ease;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:10px;
  }
  
  .btn-submit:hover{
    transform:translateY(-3px);
    box-shadow:0 15px 40px rgba(255,61,154,0.4);
  }
  
  .note{
    text-align:center;
    margin-top:20px;
    color:#9a7a8a;
    font-size:0.85rem;
  }
  
  /* RESPONSIVE */
  @media (max-width:768px){
    .header-icon{width:90px;}
    .content-grid{grid-template-columns:1fr}
    .header h1{font-size:1.6rem}
    .section{padding:24px}
  }
</style>
</head>
<body>

<div class='container'>

<!-- HEADER -->
<div class='header'>
<img src='laptop-heart.png' alt='LapMatch Icon' class='header-icon'>
<h1>Konsultasi LapMatch</h1>
<p>Temukan laptop terbaik sesuai kebutuhanmu ✨</p>
</div>

<!-- FORM -->
<form action='proses/proses.php' method='POST'>

<div class='content-grid'>

<!-- KEBUTUHAN -->
<div class='section'>
<div class='section-title'>
<span>1</span>
Kebutuhan Laptop
</div>
<p class='section-desc'>Pilih kebutuhan utama kamu dalam menggunakan laptop</p>

<label class='option'>
<div class='option-content'>
<div class='option-icon'>💼</div>
<div class='option-text'>
<h4>Office</h4>
<p>Untuk pekerjaan kantor, mengetik, presentasi, dll</p>
</div>
</div>
<input type='radio' name='kebutuhan' value='G1' required>
</label>

<label class='option'>
<div class='option-content'>
<div class='option-icon'>🎨</div>
<div class='option-text'>
<h4>Desain Grafis</h4>
<p>Untuk editing foto, ilustrasi, desain, dll</p>
</div>
</div>
<input type='radio' name='kebutuhan' value='G2'>
</label>

<label class='option'>
<div class='option-content'>
<div class='option-icon'>‍💻</div>
<div class='option-text'>
<h4>Programming</h4>
<p>Untuk coding, development, belajar IT</p>
</div>
</div>
<input type='radio' name='kebutuhan' value='G3'>
</label>

<label class='option'>
<div class='option-content'>
<div class='option-icon'>🎮</div>
<div class='option-text'>
<h4>Gaming</h4>
<p>Untuk bermain game dengan performa tinggi</p>
</div>
</div>
<input type='radio' name='kebutuhan' value='G4'>
</label>

</div>

<!-- BUDGET -->
<div class='section'>
<div class='section-title'>
<span>2</span>
Budget
</div>
<p class='section-desc'>Pilih range budget yang kamu miliki</p>

<label class='option'>
<div class='option-content'>
<div class='option-text'>
<h4>&lt; Rp 6.000.000</h4>
</div>
</div>
<input type='radio' name='budget' value='G5' required>
</label>

<label class='option'>
<div class='option-content'>
<div class='option-text'>
<h4>Rp 6.000.000 - Rp 10.000.000</h4>
</div>
</div>
<input type='radio' name='budget' value='G6'>
</label>

<label class='option'>
<div class='option-content'>
<div class='option-text'>
<h4>&gt; Rp 10.000.000</h4>
</div>
</div>
<input type='radio' name='budget' value='G7'>
</label>

</div>

</div>

<!-- BUTTON -->
<button type='submit' class='btn-submit'>
<i class='bi bi-search-heart'></i>
Cari Laptop Terbaik
</button>



</form>

</div>

</body>
</html>