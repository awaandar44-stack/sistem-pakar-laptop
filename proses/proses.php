<?php
session_start();
include "../config/koneksi.php";

/* Ambil nama dari session */
$nama = isset($_SESSION['nama'])
    ? mysqli_real_escape_string($koneksi, $_SESSION['nama'])
    : "Mahasiswa";

/* Hapus working memory lama milik user */
mysqli_query($koneksi, "DELETE FROM working_memory WHERE nama='$nama'");

/* Simpan semua jawaban ke working_memory */
foreach ($_POST as $kode => $jawaban) {
    $kode = mysqli_real_escape_string($koneksi, $kode);
    $jawaban = mysqli_real_escape_string($koneksi, $jawaban);
    mysqli_query($koneksi, "
        INSERT INTO working_memory (nama, kode_fakta, jawaban)
        VALUES ('$nama', '$kode', '$jawaban')
    ");
}

/* ===========================
   DATA DARI FORM KONSULTASI
=========================== */
if (!isset($_POST['kebutuhan']) || !isset($_POST['budget'])) {
    header("Location: ../konsultasi.php");
    exit;
}

/* ⚠️ INI YANG HILANG SEBELUMNYA */
$kodeKebutuhan = $_POST['kebutuhan'];
$kodeBudget    = $_POST['budget'];

/* ===========================
   KONVERSI KODE KEBUTUHAN
=========================== */
switch($kodeKebutuhan){
    case "G1": $kebutuhan = "Office"; break;
    case "G2": $kebutuhan = "Desain"; break;
    case "G3": $kebutuhan = "Coding"; break;
    case "G4": $kebutuhan = "Gaming"; break;
    default:   $kebutuhan = "Office"; break;
}

/* ===========================
   KONVERSI KODE BUDGET
=========================== */
switch($kodeBudget){
    case "G5": $budget = "<6";   break;
    case "G6": $budget = "6-10"; break;
    case "G7": $budget = ">10";  break;
    default:   $budget = "<6";   break;
}

/* ===========================
   CARI RULE
=========================== */
$rule = mysqli_query($koneksi,"
    SELECT *
    FROM rule
    WHERE budget='$budget'
    AND kebutuhan='$kebutuhan'
");

if(mysqli_num_rows($rule) > 0){

    $r = mysqli_fetch_assoc($rule);
    $idLaptop = $r['id_laptop'];

    $laptop = mysqli_query($koneksi,"
        SELECT *
        FROM laptop
        WHERE id_laptop='$idLaptop'
    ");

    $hasil = mysqli_fetch_assoc($laptop);

    if (!$hasil) {
        echo "<script>
            alert('Data laptop tidak ditemukan.');
            window.location='../konsultasi.php';
        </script>";
        exit;
    }

    /* Simpan ke riwayat */
    mysqli_query($koneksi,"
        INSERT INTO riwayat (nama, budget, kebutuhan, hasil)
        VALUES ('$nama', '$budget', '$kebutuhan', '".$hasil['nama_laptop']."')
    ");

    $_SESSION['hasil'] = $hasil;

    header("Location: ../hasil.php");
    exit;

} else {
    echo "<script>
        alert('Maaf, belum ditemukan rekomendasi laptop yang sesuai.');
        window.location='../konsultasi.php';
    </script>";
}
?>