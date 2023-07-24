<?php
include "../../config/koneksi.php";

if (isset($_POST["submit"])) {

	$a = $_POST;
	//echo $a["submit"];
	if (empty($a["txtpassword"])) {
		$password = $a["txtpass"];
	} else {

		$password = $a["txtpassword"];
	}

	switch ($a["submit"]) {
		case 'new':
			$exec = mysql_query("INSERT INTO user (username, password, nama, role) 
					VALUES ('" . $a["txtusername"] . "','" . $a["txtpass"] . "','" . $a["txtnama"] . "','admin')");

			header('location : ../../home.php?module=user');

			break;

		case 'edit':
			$exec = mysql_query("UPDATE user 
					SET username = '" . $a["txtusername"] . "', password = '" . $password . "', nama = '" . $a["txtnama"] . "' WHERE username = '" . $a["txtusernameval"] . "'");
			header('location: ../../home.php?module=user');
			break;
	}
}

if (isset($_GET["username"])) {
	$exec = mysql_query("DELETE FROM user WHERE username = '" . $_GET["username"] . "'");
	echo "DELETE FROM user WHERE username = '" . $_GET["username"] . "'";
	header('location: ../../home.php?module=user');
}
