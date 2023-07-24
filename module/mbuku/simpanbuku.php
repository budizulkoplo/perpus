<?php
include "../../config/koneksi.php";

if (isset($_POST["submit"])) {

	$a = $_POST;
	//echo $a["submit"];


	switch ($a["submit"]) {
		case 'new':
			$exec = mysql_query("insert into buku(barcode,judul,pengarang,penerbit,tahunterbit,tahunpengadaan,idkategorikoleksi,sumber,nomerseri, lokasi) 
				SELECT Concat(Right('" . $a["txttahunterbit"] . "',2),' ','" . $a["txtkode"] . "',' ','" . $a["txtsumber"] . "',' 02 ',  LPAD('" . $a["nomerseri"] . "', 4, '0')),
				'" . $a["txtjudul"] . "','" . $a["txtpengarang"] . "','" . $a["txtpenerbit"] . "','" . $a["txttahunterbit"] . "','" . $a["txttahunpengadaan"] . "','" . $a["txtkode"] . "','" . $a["txtsumber"] . "','" . $a["nomerseri"] . "','" . $a["txtrak"] . "'");

			// echo "insert into buku(barcode,judul,pengarang,penerbit,tahunterbit,tahunpengadaan,idkategorikoleksi,sumber,nomerseri) 
			// SELECT Concat(Right('" . $a["txttahunterbit"] . "',2),' ','" . $a["txtkode"] . "',' ','" . $a["txtsumber"] . "',' 02',  LPAD('" . $a["nomerseri"] . "', 4, '0')),
			// '" . $a["txtjudul"] . "','" . $a["txtpengarang"] . "','" . $a["txtpenerbit"] . "','" . $a["txttahunterbit"] . "','" . $a["txttahunpengadaan"] . "','" . $a["txtkode"] . "','" . $a["txtsumber"] . "','" . $a["nomerseri"] . "'";
			header('location : ../../home.php?module=buku');

			break;


		case 'edit':
			$exec = mysql_query("UPDATE buku 
					SET barcode = '" . $a["txtbarcode"] . "', judul = '" . $a["txtjudul"] . "', pengarang = '" . $a["txtpengarang"] . "', penerbit = '" . $a["txtpenerbit"] . "', tahunterbit = '" . $a["txttahunterbit"] . "', tahunpengadaan = '" . $a["txttahunpengadaan"] . "', 
					idkategorikoleksi = '" . $a["txtkode"] . "', sumber = '" . $a["txtsumber"] . "', nomerseri = '" . $a["nomerseri"] . "', lokasi = '" . $a["txtrak"] . "'        
					WHERE idbuku = '" . $a["txtid"] . "'");

			header('location: ../../home.php?module=buku');
			break;
	}
}

if (isset($_GET["idbuku"])) {
	$exec = mysql_query("DELETE FROM buku WHERE idbuku = '" . $_GET["idbuku"] . "'");

	header('location: ../../home.php?module=buku');
}
