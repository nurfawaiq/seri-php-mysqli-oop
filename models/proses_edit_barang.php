<?php
require_once('../config/+koneksi.php');
require_once('../models/database.php');
include "../models/m_barang.php";
$connection = new Database($host, $user, $pass, $database);
$brg = new Barang($connection);

$id_brg = $_POST['id_brg'];
$nm_brg = $connection->conn->real_escape_string($_POST['nm_brg']);
$hrg_brg = $connection->conn->real_escape_string($_POST['hrg_brg']);
$stok_brg = $connection->conn->real_escape_string($_POST['stok_brg']);

$pict = $_FILES['gbr_brg']['name'];
$extensi = explode(".", $_FILES['gbr_brg']['name']);
$gbr_brg = "brg-".round(microtime(true)).".".end($extensi);
$sumber = $_FILES['gbr_brg']['tmp_name'];

if($pict == '') {
	$brg->edit("UPDATE tb_barang SET nama_brg = '$nm_brg', harga_brg = '$hrg_brg', stok_brg = '$stok_brg' WHERE id_brg = '$id_brg'");
	echo "<script>window.location='?page=barang';</script>";
} else {
	$gbr_awal = $brg->tampil($id_brg)->fetch_object()->gbr_brg;
	unlink("../assets/img/barang/".$gbr_awal);

	$upload = move_uploaded_file($sumber, "../assets/img/barang/".$gbr_brg);
	if($upload) {
		$brg->edit("UPDATE tb_barang SET nama_brg = '$nm_brg', harga_brg = '$hrg_brg', stok_brg = '$stok_brg', gbr_brg = '$gbr_brg' WHERE id_brg = '$id_brg'");
		echo "<script>window.location='?page=barang';</script>";
	} else {
		echo "<script>alert('Upload gambar gagal!')</script>";
	}
}
?>