<?php
include "../../config/koneksi.php";

if (isset($_POST["submit"])) {

	$a = $_POST;
	//echo $a["submit"];


	switch ($a["submit"]) {
		case 'new':
			$exec = mysql_query("insert into anggota(barcode,nis,nama,tempat,tgllahir,alamat,nohp,email) 
			SELECT Concat(year(CURDATE()),LPAD(ifnull((select idanggota from anggota order by idanggota desc limit 1),0)+1, 4, '0')),
				'" . $a["txtnis"] . "','" . $a["txtnama"] . "','" . $a["txttempatlahir"] . "','" . $a["txttanggallahir"] . "','" . $a["txtalamat"] . "','" . $a["txtnohp"] . "','" . $a["txtemail"] . "'");
			$exec = mysql_query("insert into user(username,password,role,nama) 
			select barcode, barcode,'anggota',nama from anggota order by idanggota desc limit 1");

			header('location : ../../home.php?module=anggota');

			break;


		case 'edit':
			$exec = mysql_query("UPDATE anggota 
					SET barcode = '" . $a["txtbarcode"] . "', nis = '" . $a["txtnis"] . "', nama = '" . $a["txtnama"] . "', tempat = '" . $a["txttempatlahir"] . "', tgllahir = '" . $a["txttanggallahir"] . "', alamat = '" . $a["txtalamat"] . "', 
					nohp = '" . $a["txtnohp"] . "', email = '" . $a["txtemail"] . "'        
					WHERE idanggota = '" . $a["txtid"] . "'");

			header('location: ../../home.php?module=anggota');
			break;
	}
}

if (isset($_GET["idanggota"])) {
	$exec = mysql_query("DELETE FROM anggota WHERE idanggota = '" . $_GET["idanggota"] . "'");

	header('location: ../../home.php?module=anggota');
}
