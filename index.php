<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>LapMatch</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
  :root{
    --pink-50:#fff0f6;
    --pink-100:#ffe4ef;
    --pink-200:#ffc9e0;
    --pink-300:#ff9ecb;
    --pink-400:#ff6fb4;
    --pink-500:#ff3d9a;
    --pink-600:#e91e82;
    --rose:#ff5ca8;
    --lilac:#e8c7ff;
    --cream:#fff8fb;
    --text:#4a2636;
  }

  *{font-family: 'Plus Jakarta Sans', 'Poppins', sans-serif;}
  body{
    background: linear-gradient(135deg, #fff5f9 0%, #ffe8f2 50%, #fff0f6 100%);
    color: var(--text);
    overflow-x:hidden;
  }

  /* NAVBAR */
  .navbar{
    background: rgba(255,255,255,0.85) !important;
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border-bottom: 1px solid rgba(255,158,203,0.2);
    padding: 15px 0;
    position: sticky;
    top:0;
    z-index: 1000;
  }
  .navbar .container{display:flex; align-items:center;}
  .logo{
    font-weight: 700 !important;
    font-size: 1.5rem !important;
    background: linear-gradient(135deg, #ff6fb4, #e91e82);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }
  .btn-login{
    background: linear-gradient(135deg, #ff6fb4, #ff3d9a);
    color: white !important;
    border-radius: 30px;
    padding: 8px 20px;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(255,61,154,0.25);
  }
  .btn-login:hover{
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255,61,154,0.4);
  }

  /* HERO */
  .hero{
    padding: 80px 0 60px;
    position: relative;
  }
  .hero::before{
    content:"";
    position:absolute;
    width:300px; height:300px;
    background: radial-gradient(circle, rgba(232,199,255,0.4), transparent);
    border-radius:50%;
    top:-100px; right:-100px;
    z-index:0;
  }
  .hero::after{
    content:"";
    position:absolute;
    width:250px; height:250px;
    background: radial-gradient(circle, rgba(255,158,203,0.3), transparent);
    border-radius:50%;
    bottom:-80px; left:-80px;
    z-index:0;
  }
  .hero .container{position:relative; z-index:1;}
  .badge-custom{
    display:inline-block;
    background: linear-gradient(135deg, #ffe4ef, #e8c7ff);
    color: var(--pink-600);
    padding: 8px 18px;
    border-radius: 30px;
    font-size: 0.85rem;
    font-weight: 600;
    border: 1px solid rgba(255,111,180,0.2);
  }
  .hero h1{
    font-weight: 800;
    font-size: 3.2rem;
    line-height: 1.15;
    color: #3a1a2a;
  }
  .hero h1 span{
    background: linear-gradient(135deg, #ff3d9a, #ff6fb4, #e8c7ff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }
  .hero p{
    color: #6b4a5a;
    font-size: 1.05rem;
    margin: 20px 0 30px;
    line-height: 1.7;
  }
  .btn-custom{
    display:inline-flex;
    align-items:center;
    gap:8px;
    background: linear-gradient(135deg, #ff6fb4 0%, #ff3d9a 100%);
    color:white !important;
    padding: 14px 32px;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 600;
    box-shadow: 0 10px 30px rgba(255,61,154,0.35);
    transition: all 0.3s ease;
  }
  .btn-custom:hover{
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(255,61,154,0.45);
    color:white;
  }
  .hero-img{
    max-width: 100%;
    filter: drop-shadow(0 20px 40px rgba(255,111,180,0.3));
    animation: float 4s ease-in-out infinite;
  }
  @keyframes float{
    0%,100%{transform: translateY(0);}
    50%{transform: translateY(-15px);}
  }

  /* SECTION JUDUL */
  .judul{
    font-weight: 700;
    text-align:center;
    color: #3a1a2a;
    font-size: 2.2rem;
    position: relative;
    display:inline-block;
    width:100%;
  }
  .judul::after{
    content:"";
    display:block;
    width: 60px;
    height: 4px;
    background: linear-gradient(90deg, #ff6fb4, #e8c7ff);
    border-radius: 2px;
    margin: 12px auto 0;
  }

  /* CARDS */
  .card-home{
    background: rgba(255,255,255,0.7);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,158,203,0.3);
    border-radius: 24px;
    padding: 30px 20px;
    text-align:center;
    height:100%;
    transition: all 0.4s ease;
    box-shadow: 0 4px 20px rgba(255,111,180,0.08);
  }
  .card-home:hover{
    transform: translateY(-8px);
    box-shadow: 0 15px 40px rgba(255,61,154,0.2);
    border-color: var(--pink-300);
  }
  .card-home .icon{
    width: 70px; height: 70px;
    margin: 0 auto 18px;
    background: linear-gradient(135deg, #ffe4ef, #fff0f6);
    border-radius: 50%;
    display:flex; align-items:center; justify-content:center;
    font-size: 1.8rem;
    box-shadow: 0 6px 15px rgba(255,158,203,0.25);
  }
  .card-home h5{
    color:#3a1a2a;
    font-weight:700;
    margin-bottom:8px;
  }
  .card-home p{
    color:#7a5066;
    font-size:0.92rem;
    margin:0;
  }

  /* ABOUT */
  .about{
    background: linear-gradient(135deg, #ffe4ef 0%, #fff0f6 100%);
    padding: 70px 0;
    margin-top:40px;
    border-top: 1px solid rgba(255,158,203,0.2);
    border-bottom: 1px solid rgba(255,158,203,0.2);
  }
  .about-img{
    max-width:100%;
    filter: drop-shadow(0 20px 40px rgba(255,111,180,0.25));
  }
  .about h2{
    font-weight:800;
    color:#3a1a2a;
    margin-bottom:20px;
  }
  .about p{
    color:#6b4a5a;
    line-height:1.9;
    font-size:17px;
    max-width:520px;
    text-align:justify;
    margin-bottom:25px;
}
  .about ul li{
    padding:10px 0;
    color:#5a3548;
    font-weight:400;
    font-size:16px;
    line-height:1.7;
}
 

  /* FOOTER */
  footer{
    background: linear-gradient(135deg, #3a1a2a 0%, #5a2540 100%);
    color:#ffe4ef;
    padding: 50px 0 30px;
    margin-top: 0;
  }
  footer h4{
    font-weight:700;
    background: linear-gradient(135deg, #ff9ecb, #ff6fb4);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }
  footer p{color:#ffc9e0; margin:8px 0;}
  footer small{color:#ff9ecb; opacity:0.7;}

  /* RESPONSIVE */
  @media (max-width: 768px){
    .hero h1{font-size: 2.2rem;}
    .hero{padding: 50px 0 40px;}
    .hero-img{margin-top:30px;}
  }

.about-img{
    width:100%;
    max-width:300px;
    height:auto;
}

</style>
</head>
<body>
<nav class="navbar navbar-expand-lg"><div class="container">
<a class="navbar-brand logo" href="#">LapMatch</a>
<div class="ms-auto"><a href="admin/login.php" class="btn-login">Login Admin</a></div>
</div></nav>

<section class="hero"><div class="container"><div class="row align-items-center">
<div class="col-lg-6">
<span class="badge-custom">✨ Laptop Recommendation</span>
<h1 class="mt-3">Temukan Laptop <span>Impianmu</span></h1>
<p> Cukup jawab beberapa pertanyaan, lalu sistem akan merekomendasikan laptop yang paling cocok untuk kebutuhan kuliah dan budgetmu.</p>
<a href="mahasiswa.php" class="btn-custom"><i class="bi bi-search-heart"></i> Mulai Konsultasi</a>
</div>
<div class="col-lg-6 text-center">
<img src="laptop.png" class="hero-img">
</div></div></div></section>

<section class="container py-5">
<h2 class="judul">Cara Kerja LapMatch</h2>
<div class="row mt-4 g-4">
<div class="col-md-3"><div class="card-home"><div class="icon">👩</div><h5>👤 Isi Data</h5><p>Masukkan nama dan kebutuhan.</p></div></div>
<div class="col-md-3"><div class="card-home"><div class="icon">❓</div><h5>💬 Jawab Pertanyaan</h5><p>Jawab pertanyaan sistem.</p></div></div>
<div class="col-md-3"><div class="card-home"><div class="icon">🧠</div><h5>⚙️ Forward Chaining</h5><p>Sistem mencocokkan fakta dengan rule.</p></div></div>
<div class="col-md-3"><div class="card-home"><div class="icon">💻</div><h5>✨ Rekomendasi</h5><p>Laptop terbaik ditampilkan.</p></div></div>
</div></section>

<section class="about">
<div class="container">
<div class="row align-items-center">

    <div class="col-lg-5 text-center">
        <img src="kucing.png" class="about-img" alt="LapMatch">
    </div>

    <div class="col-lg-7">
        <h2>Kenapa Memilih LapMatch?</h2>

        <p>
            Tidak perlu lagi bingung membandingkan banyak pilihan laptop.
            LapMatch membantu mahasiswa menemukan laptop yang paling sesuai
            dengan kebutuhan kuliah dan budget melalui metode
            <strong>Forward Chaining</strong>.
        </p>

        <ul>
            <li>💻 Rekomendasi sesuai kebutuhan</li>
            <li>💰 Menyesuaikan budget pengguna</li>
            <li>🧠 Menggunakan metode Forward Chaining</li>
            <li>⚡ Cepat, mudah, dan berbasis website</li>
        </ul>
    </div>

</div>
</div>
</section>

<footer><div class="container text-center"><h4>💖 Sistem Pakar Rekomendasi Laptop</h4><p>by kelompok 2</p><small>2P53</small></div></footer>
</body></html>