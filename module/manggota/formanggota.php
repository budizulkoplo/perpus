<?php
$submit = $_GET['submit'];

if (!isset($_GET["idanggota"])) {
    $idanggota = "";
} else {
    $idanggota = $_GET["idanggota"];
}

$exec = mysql_query("SELECT * FROM anggota where idanggota = '" . $idanggota . "'");

if ($submit == 'new') {
    $title = "Tambah Data Anggota";

    $arr = mysql_fetch_assoc($exec);
    $tgllahir = "";
    $read = "";
} else {
    $title = "Edit Data Anggota dengan ID '" . $_GET["idanggota"] . "'";
    $arr = mysql_fetch_assoc($exec);
    $arr2 = explode("-", $arr["tgllahir"]);
    $tgllahir = $arr2[0] . "-" . $arr2[1] . "-" . $arr2[2];
    $read = "";
}
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Anggota</h2>
        <ol class="breadcrumb">
            <li>
                <a href="home.php">Home</a>
            </li>
            <li class="active">
                <strong>Data Anggota</strong>
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
                    <form method="post" action="module/manggota/simpananggota.php">
                        <div class="row">
                            <?php
                            if ($submit <> 'new') { ?>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Barcode</label>
                                        <input type='hidden' name="txtid" class="form-control" value="<?php echo $arr["idanggota"]; ?>" required />
                                        <input name="txtbarcode" class="form-control" value="<?php echo $arr["barcode"]; ?>" readonly />
                                    </div>
                                </div>
                            <?php }
                            ?>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label>NIS</label>
                                    <input name="txtnis" class="form-control" value="<?php echo $arr["nis"]; ?>" required />
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input name="txtnama" class="form-control" value="<?php echo $arr["nama"]; ?>" required />
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input name="txttempatlahir" class="form-control" value="<?php echo $arr["tempat"]; ?>" required />
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input name="txttanggallahir" value="<?php echo $tgllahir; ?>" class="datepicker form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label>Detail Alamat</label>
                                    <textarea name="txtalamat" class="form-control" required><?php echo $arr["alamat"]; ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label>No HP</label>
                                    <input name="txtnohp" class="form-control" value="<?php echo $arr["nohp"]; ?>" required />
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="txtemail" class="form-control" value="<?php echo $arr["email"]; ?>" required />
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="btn-group">
                                    <a href="home.php?module=anggota" class="btn btn-danger">Kembali</a>
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
<script>
    $(document).ready(function() {
        $(".datepicker").datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
        });
    })
</script>