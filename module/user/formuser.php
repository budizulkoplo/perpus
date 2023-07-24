<?php
$submit = $_GET['submit'];

if (!isset($_GET["username"])) {
    $username = "";
} else {
    $username = $_GET["username"];
}

$exec = mysql_query("SELECT * FROM user WHERE username = '" . $username . "'");

if ($submit == 'new') {
    $title = "Tambah Data User Aplikasi";

    $arr = mysql_fetch_assoc($exec);
    $TglLahir = "";
    $read = "";
} else {
    $title = "Edit Admin Dengan User '" . $_GET["username"] . "'";
    $arr = mysql_fetch_assoc($exec);
    $read = "";
}
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>User Aplikasi</h2>
        <ol class="breadcrumb">
            <li>
                <a href="home.php">Home</a>
            </li>
            <li class="active">
                <strong>Data User</strong>
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo $title; ?></h5>
                </div>
                <div class="ibox-content">
                    <form method="post" action="module/user/simpanuser.php">
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type='hidden' name="txtusernameval" class="form-control" value="<?php echo $arr["username"]; ?>" required />
                                    <input type='hidden' name="txtlevel" class="form-control" value="<?php echo $arr["role"]; ?>" required />
                                    <input <?php echo $read; ?> name="txtusername" class="form-control" value="<?php echo $arr["username"]; ?>" required />
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label>Nama User</label>
                                    <input name="txtnama" class="form-control" value="<?php echo $arr["nama"]; ?>" required />
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="txtpassword" class="form-control" />
                                    <input type="hidden" name="txtpass" class="form-control" value="<?php echo $arr["password"]; ?>" />
                                    <div style="color:red;"><i>*) jika password tidak dirubah biarkan field kosong.</i></div>
                                </div>
                            </div>



                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="btn-group">
                                    <a href="home.php?module=user" class="btn btn-danger">Kembali</a>
                                    <button type="submit" name="submit" value="<?php echo $submit; ?>" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>