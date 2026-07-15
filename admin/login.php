<?php
session_start();
include "../config/koneksi.php";

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $cek = mysqli_query($koneksi,
    "SELECT * FROM admin
    WHERE username='$username'
    AND password='$password'");

    if(mysqli_num_rows($cek)>0){

        $_SESSION['admin']=$username;

        header("Location: dashboard.php");

    }else{

        echo "<script>
        alert('Username atau Password Salah!');
        </script>";

    }

}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Admin 💖</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  * { font-family: 'Plus Jakarta Sans', sans-serif; }
  
  body {
    background: linear-gradient(135deg, #fff5f9 0%, #ffe8f2 50%, #fff0f6 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    position: relative;
    overflow-x: hidden;
  }
  
  /* Blob dekoratif subtle */
  body::before {
    content: "";
    position: fixed;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(255,158,203,0.2), transparent 70%);
    border-radius: 50%;
    top: -150px;
    left: -150px;
    z-index: 0;
  }
  
  body::after {
    content: "";
    position: fixed;
    width: 350px;
    height: 350px;
    background: radial-gradient(circle, rgba(232,199,255,0.25), transparent 70%);
    border-radius: 50%;
    bottom: -100px;
    right: -100px;
    z-index: 0;
  }
  
  .container {
    position: relative;
    z-index: 1;
  }
  
  .login-card {
    background: rgba(255,255,255,0.9);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,158,203,0.3);
    border-radius: 24px;
    box-shadow: 0 20px 60px rgba(255,61,154,0.12);
    overflow: hidden;
  }
  
  .login-header {
    text-align: center;
    padding: 40px 30px 20px;
    background: linear-gradient(135deg, #fff0f6 0%, #ffe4ef 100%);
    border-bottom: 1px solid rgba(255,158,203,0.2);
  }
  
  .login-icon {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, #ff6fb4, #ff3d9a);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    font-size: 2rem;
    box-shadow: 0 10px 25px rgba(255,61,154,0.25);
  }
  
  .login-header h3 {
    font-weight: 700;
    font-size: 1.5rem;
    background: linear-gradient(135deg, #ff3d9a, #ff6fb4);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin: 0;
  }
  
  .login-header p {
    color: #8a5a6f;
    font-size: 0.9rem;
    margin: 8px 0 0;
  }
  
  .login-body {
    padding: 35px 30px;
  }
  
  label {
    color: #5a2540;
    font-weight: 600;
    font-size: 0.9rem;
    margin-bottom: 8px;
    display: block;
  }
  
  .form-control {
    background: rgba(255,255,255,0.9);
    border: 1.5px solid #ffc9e0;
    border-radius: 12px;
    padding: 12px 16px;
    font-size: 0.95rem;
    color: #4a2636;
    transition: all 0.25s ease;
  }
  
  .form-control:focus {
    border-color: #ff6fb4;
    box-shadow: 0 0 0 4px rgba(255,111,180,0.12);
    background: #fff;
    outline: none;
  }
  
  .form-control::placeholder {
    color: #c98aa8;
  }
  
  /* Button Group */
  .button-group {
    display: flex;
    gap: 10px;
    margin-top: 15px;
  }
  
  .btn-login {
    background: linear-gradient(135deg, #ff6fb4 0%, #ff3d9a 100%);
    border: none;
    border-radius: 30px;
    padding: 13px 30px;
    font-weight: 600;
    font-size: 1rem;
    color: #fff;
    box-shadow: 0 10px 30px rgba(255,61,154,0.3);
    transition: all 0.3s ease;
    flex: 1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
  }
  
  .btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 40px rgba(255,61,154,0.4);
    background: linear-gradient(135deg, #ff3d9a 0%, #e91e82 100%);
    color: #fff;
  }
  
  .btn-login:active {
    transform: translateY(-1px);
  }
  
  .btn-kembali {
    background: #fff;
    color: #ff3d9a;
    border: 2px solid #ffb3d1;
    border-radius: 30px;
    padding: 13px 20px;
    font-weight: 600;
    font-size: 0.95rem;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
  }
  
  .btn-kembali:hover {
    background: #fff5f8;
    border-color: #ff3d9a;
    color: #ff3d9a;
    transform: translateY(-2px);
  }
  
  .footer-text {
    text-align: center;
    margin-top: 25px;
    padding-top: 20px;
    border-top: 1px solid rgba(255,158,203,0.2);
    color: #9a7a8a;
    font-size: 0.85rem;
  }
  
  @media (max-width: 576px) {
    .login-body { padding: 25px 20px; }
    .login-header { padding: 30px 20px 15px; }
    .login-header h3 { font-size: 1.3rem; }
    .button-group { flex-direction: column; }
    .btn-login, .btn-kembali { width: 100%; }
  }
</style>
</head>
<body>

<div class="container">
<div class="row justify-content-center">
<div class="col-md-5 col-lg-4">

<div class="login-card">
  <div class="login-header">
    <div class="login-icon">🔐</div>
    <h3>Login Admin</h3>
    <p>Masuk ke dashboard LapMatch</p>
  </div>
  
  <div class="login-body">
    <form method="POST">
      <label>Username</label>
      <input 
        type="text" 
        name="username" 
        class="form-control" 
        placeholder="Masukkan username"
        required>
      
      <br>
      
      <label>Password</label>
      <input 
        type="password" 
        name="password" 
        class="form-control" 
        placeholder="Masukkan password"
        required>
      
      <!-- Button Group: Login & Kembali -->
      <div class="button-group">
        <a href="../index.php" class="btn-kembali">
          <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <button 
          type="submit"
          name="login" 
          class="btn-login">
          <i class="bi bi-box-arrow-in-right"></i> Login
        </button>
      </div>
    </form>
    
  </div>
</div>

</div>
</div>
</div>

</body>
</html>