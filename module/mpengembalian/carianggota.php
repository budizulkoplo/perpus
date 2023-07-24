<?php
session_start();
include "../../config/koneksi.php";

if (isset($_GET['idanggota'])) {
	// echo $_POST['txtUser'];

	$query = "SELECT * FROM anggota where barcode = '" . $_GET['idanggota'] . "'";
	$exec = mysql_query($query);

	$cnt = mysql_num_rows($exec);
	$rs = mysql_fetch_assoc($exec);

	if ($cnt > 0) {
		$data["isError"] = "0";
		$data["Alert"] = "Data Anggota Ditemukan";
	} else {
		$data["isError"] = "1";
		$data["Alert"] = "Data Anggota tidak ditemukan, mohon periksa kembali";
	}

	echo json_encode($data);
}
