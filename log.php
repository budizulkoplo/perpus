<?php
session_start();
include "config/koneksi.php";

if(isset($_POST['txtUser'])){
	// echo $_POST['txtUser'];

	$query = "SELECT * FROM user where username = '".$_POST['txtUser']."' AND `password` = '".$_POST['txtPass']."'";
	$exec = mysql_query($query);

	$cnt = mysql_num_rows($exec);
	$rs = mysql_fetch_assoc($exec);

	if($cnt>0){
		$data["isError"] = "0";
		$data["Alert"] = "Login berhasil";

		$_SESSION['username'] = $rs["username"];
		$_SESSION['namaadmin'] = $rs["nama"];
		$_SESSION['level'] = $rs["role"];
		$_SESSION['iduser'] = $rs["iduser"];
		
	}
	else
	{
		$data["isError"] = "1";
		$data["Alert"] = "Login gagal, Cek User dan Password anda";
	}

	echo json_encode($data);
}
