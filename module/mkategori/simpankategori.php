<?php
include "../../config/koneksi.php";

if (isset($_POST["submit"])) {

	$a = $_POST;
	//echo $a["submit"];


	switch ($a["submit"]) {
		case 'new':
			$exec = mysql_query("insert into kategori(kode,namakategori,waktupinjam) VALUES('" . $a["txtkode"] . "','" . $a["txtnama"] . "','" . $a["txtwaktupinjam"] . "')");
			// echo "insert into kategori(kode,namakategori,waktupinjam) VALUES('" . $a["txtkode"] . "','" . $a["txtnama"] . "','" . $a["txtwaktupinjam"] . "'";
			header('location : ../../home.php?module=kategori');

			break;

		case 'edit':
			$exec = mysql_query("UPDATE kategori 
					SET kode = '" . $a["txtkode"] . "', namakategori = '" . $a["txtnama"] . "', waktupinjam = '" . $a["txtwaktupinjam"] . "'
					WHERE idkategori = '" . $a["txtid"] . "'");

			header('location: ../../home.php?module=kategori');
			break;
	}
}

if (isset($_GET["idkategori"])) {
	$exec = mysql_query("DELETE FROM kategori WHERE idkategori = '" . $_GET["idkategori"] . "'");

	header('location: ../../home.php?module=kategori');
}
