<?php

include "../config/koneksi.php";

$id=$_GET['id'];

mysqli_query($koneksi,"DELETE FROM laptop WHERE id_laptop='$id'");

header("Location:laptop.php");

?>