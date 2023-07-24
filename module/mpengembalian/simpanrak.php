<?php
include "../../config/koneksi.php";

if (isset($_POST["submit"])) {

	$a = $_POST;
	//echo $a["submit"];


	switch ($a["submit"]) {
		case 'new':
			$exec = mysql_query("insert into rakbuku(koderak,nama,deskripsi) SELECT Concat('RB',LPAD(idrak+1, 3, '0')), '" . $a["txtnama"] . "','" . $a["deskripsi"] . "' FROM rakbuku order by idrak desc limit 1");
			// echo "insert into rakbuku(koderak,nama,deskripsi) SELECT Concat('RB',LPAD(idrak+1, 3, '0')), '" . $a["txtnama"] . "','" . $a["deskripsi"] . "' FROM rakbuku order by idrak desc limit 1";
			header('location : ../../home.php?module=rak');

			break;

		case 'edit':
			$exec = mysql_query("UPDATE rakbuku 
					SET koderak = '" . $a["txtkode"] . "', nama = '" . $a["txtnama"] . "', deskripsi = '" . $a["deskripsi"] . "'
					WHERE idrak = '" . $a["txtid"] . "'");

			header('location: ../../home.php?module=rak');
			break;
	}
}

if (isset($_GET["idrak"])) {
	$exec = mysql_query("DELETE FROM rakbuku WHERE idrak = '" . $_GET["idrak"] . "'");

	header('location: ../../home.php?module=rak');
}
