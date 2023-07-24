<?php
$submit = $_GET['submit'];

if (!isset($_GET["idkategori"])) {
    $idkategori = "";
} else {
    $idkategori = $_GET["idkategori"];
}

$exec = mysql_query("SELECT * from kategori where idkategori = '" . $idkategori . "'");

if ($submit == 'new') {
    $title = "Tambah Data Kategori";

    $arr = mysql_fetch_assoc($exec);
    $TglLahir = "";
    $read = "";
} else {
    $title = "Edit Data Kategori dengan ID '" . $_GET["idkategori"] . "'";
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
                <strong>Data Kategori</strong>
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
                    <form method="post" action="module/mkategori/simpankategori.php">
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label>Kode Kategori</label>
                                    <input type='hidden' name="txtid" class="form-control" value="<?php echo $arr["idkategori"]; ?>" required />
                                    <input name="txtkode" maxlength="3" class="form-control" value="<?php echo $arr["kode"]; ?>" required />
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label>Nama Kategori</label>
                                    <input name="txtnama" class="form-control" value="<?php echo $arr["namakategori"]; ?>" required />
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label>Lama Peminjaman</label>
                                    <input type='number' name="txtwaktupinjam" class="form-control" value="<?php echo $arr["waktupinjam"]; ?>" required />
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="btn-group">
                                    <a href="home.php?module=kategori" class="btn btn-danger">Kembali</a>
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