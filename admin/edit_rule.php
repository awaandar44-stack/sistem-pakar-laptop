<?php
session_start();

include "../config/koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($koneksi,"SELECT * FROM rule WHERE id_rule='$id'");
$r = mysqli_fetch_array($data);

if(isset($_POST['update'])){

    $budget = $_POST['budget'];
    $kebutuhan = $_POST['kebutuhan'];
    $id_laptop = $_POST['id_laptop'];

    mysqli_query($koneksi,"UPDATE rule SET

    budget='$budget',

    kebutuhan='$kebutuhan',

    id_laptop='$id_laptop'

    WHERE id_rule='$id'");

    header("Location:rule.php");
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Rule</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-4">

<h2>Edit Rule</h2>

<form method="POST">

<label>Budget</label>

<select name="budget" class="form-select mb-3">

<option value="<6" <?=($r['budget']=="<6")?"selected":""?>> < Rp 6.000.000</option>

<option value="6-10" <?=($r['budget']=="6-10")?"selected":""?>>Rp 6.000.000 - Rp 10.000.000</option>

<option value=">10" <?=($r['budget']==">10")?"selected":""?>> > Rp 10.000.000</option>

</select>

<label>Kebutuhan</label>

<select name="kebutuhan" class="form-select mb-3">

<option <?=($r['kebutuhan']=="Office")?"selected":""?>>Office</option>

<option <?=($r['kebutuhan']=="Coding")?"selected":""?>>Coding</option>

<option <?=($r['kebutuhan']=="Desain")?"selected":""?>>Desain</option>

<option <?=($r['kebutuhan']=="Gaming")?"selected":""?>>Gaming</option>

</select>

<label>Laptop</label>

<select name="id_laptop" class="form-select mb-3">

<?php

$laptop = mysqli_query($koneksi,"SELECT * FROM laptop");

while($l=mysqli_fetch_array($laptop)){

?>

<option value="<?= $l['id_laptop']; ?>"

<?=($r['id_laptop']==$l['id_laptop'])?"selected":"";?>>

<?= $l['nama_laptop']; ?>

</option>

<?php } ?>

</select>

<button name="update" class="btn btn-success">

Update

</button>

<a href="rule.php" class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</body>

</html>