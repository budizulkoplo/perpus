<?php
$submit = $_GET['submit'];

if (!isset($_GET["idrak"])) {
    $idrak = "";
} else {
    $idrak = $_GET["idrak"];
}

$exec = mysql_query("SELECT * from rakbuku where idrak = '" . $idrak . "'");

if ($submit == 'new') {
    $title = "Tambah Data Rak";

    $arr = mysql_fetch_assoc($exec);
    $TglLahir = "";
    $read = "";
} else {
    $title = "Edit Data Rak dengan ID '" . $_GET["idrak"] . "'";
    $arr = mysql_fetch_assoc($exec);
    $read = "";
}
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Kategori</h2>
        <ol class="breadcrumb">
            <li>
                <a href="home.php">Home</a>
            </li>
            <li class="active">
                <strong>Data Rak</strong>
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
                    <form method="post" action="module/mrak/simpanrak.php">
                        <div class="row">
                            <?php
                            if ($submit <> 'new') { ?>

                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Kode Rak</label>
                                        <input type='hidden' name="txtid" class="form-control" value="<?php echo $arr["idrak"]; ?>" required />
                                        <input name="txtkode" maxlength="3" class="form-control" value="<?php echo $arr["koderak"]; ?>" readonly />
                                    </div>
                                </div>

                            <?php }
                            ?>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label>Nama Rak</label>
                                    <input name="txtnama" class="form-control" value="<?php echo $arr["nama"]; ?>" required />
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <input type='text' name="deskripsi" class="form-control" value="<?php echo $arr["deskripsi"]; ?>" required />
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="btn-group">
                                    <a href="home.php?module=rak" class="btn btn-danger">Kembali</a>
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