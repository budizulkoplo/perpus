<?php
session_start();
include "../../config/koneksi.php";

if (isset($_GET['barcode'])) {
	// echo $_POST['txtUser'];
	$a = $_GET;


	// echo "insert into persiapanpinjam(barcodeanggota,barcodebuku) ('" . $a["anggota"] . "','" . $a["barcode"] . "')";
	// $query = "SELECT * FROM persiapanpinjam where barcodeanggota = '" . $_GET['anggota'] . "'";

	$query = "SELECT * FROM buku where status='Ada' and barcode = '" . $_GET['barcode'] . "'";
	$query2 = "SELECT * FROM persiapanpinjam where barcodebuku = '" . $_GET['barcode'] . "' and barcodeanggota='" . $a["anggota"] . "'";
	$exec = mysql_query($query);
	$exec2 = mysql_query($query2);

	$cnt = mysql_num_rows($exec);
	$cnt2 = mysql_num_rows($exec2);
	$rs = mysql_fetch_assoc($exec);

	if ($cnt > 0) {
		if ($cnt2 > 0) {
			$data["isError"] = "1";
			$data["Alert"] = "Buku sudah diinput di peminjaman";
		} else {
			$exec = mysql_query("update buku set status='Dipesan' where barcode='" . $a["barcode"] . "'");
			$exec = mysql_query("insert into persiapanpinjam(barcodeanggota,barcodebuku) value ('" . $a["anggota"] . "','" . $a["barcode"] . "')");
			$data["isError"] = "0";
			$data["Alert"] = "Input peminjaman buku berhasil";
		}
	} else {
		$data["isError"] = "1";
		$data["Alert"] = "Buku tidak tersedia, mohon perika kembali";
	}

	echo json_encode($data);
}

if (isset($_GET['hapus'])) {
	$a = $_GET;
	$exec = mysql_query("delete from persiapanpinjam where barcodebuku='" . $a["hapus"] . "' and barcodeanggota='" . $a["anggota"] . "'");
	$exec = mysql_query("update buku set status='Ada' where barcode='" . $a["hapus"] . "'");
	$data["isError"] = "0";
	$data["Alert"] = "data peminjaman sudah dihapus";
	echo json_encode($data);
}

if (isset($_GET['idanggota'])) {
	$a = $_GET;
	// echo $a["idanggota"];
	$exec = mysql_query("insert into peminjaman (barcodeanggota, barcodebuku,tglpinjam,tglkembali,petugas,status) 
	select barcodeanggota, barcodebuku, CURRENT_DATE() as tglpinjam, 
	(select DATE_ADD(CURRENT_DATE(), INTERVAL (select waktupinjam from kategori where kode=(select idkategorikoleksi from buku where buku.barcode=a.barcodebuku)) Day) as tglkembali),
	'" . $_SESSION["username"] . "','Dipinjam'
	from persiapanpinjam a
	where a.barcodeanggota='" . $a["idanggota"] . "'");
	$exec = mysql_query("update buku set status='Dipinjam' where barcode in(select barcodebuku from persiapanpinjam where  barcodeanggota='" . $a["idanggota"] . "')");
	$exec = mysql_query("delete from persiapanpinjam where  barcodeanggota='" . $a["idanggota"] . "'");

	header('location: ../../home.php?module=peminjaman');
}
