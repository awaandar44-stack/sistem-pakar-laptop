<?php

include "../config/koneksi.php";

$id = $_GET['id'];

mysqli_query($koneksi,"DELETE FROM rule WHERE id_rule='$id'");

header("Location:rule.php");

?>