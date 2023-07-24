<style>
    /* Menyembunyikan bulan dan tanggal pada datepicker */
    .datepicker table tr td span.month,
    .datepicker table tr td span.day {
        display: none;
    }
</style>

<?php
$submit = $_GET['submit'];

if (!isset($_GET["idbuku"])) {
    $idbuku = "";
} else {
    $idbuku = $_GET["idbuku"];
}

$exec = mysql_query("SELECT * FROM buku a join kategori b
on a.idkategorikoleksi=b.idkategori
join sumberpengadaan c on a.sumber=c.idsumber where idbuku = '" . $idbuku . "'");

if ($submit == 'new') {
    $title = "Tambah Data Buku";

    $arr = mysql_fetch_assoc($exec);
    $TglLahir = "";
    $read = "";
} else {
    $title = "Edit Data Buku dengan ID '" . $_GET["idbuku"] . "'";
    $arr = mysql_fetch_assoc($exec);

    $read = "";
}
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Buku</h2>
        <ol class="breadcrumb">
            <li>
                <a href="home.php">Home</a>
            </li>
            <li class="active">
                <strong>Data Buku</strong>
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
                    <form method="post" action="module/mbuku/simpanbuku.php">
                        <div class="row">
                            <?php
                            if ($submit <> 'new') { ?>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Barcode</label>
                                        <input type='hidden' name="txtid" class="form-control" value="<?php echo $arr["idbuku"]; ?>" required />
                                        <input name="txtbarcode" class="form-control" value="<?php echo $arr["barcode"]; ?>" readonly />
                                    </div>
                                </div>
                            <?php }
                            ?>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select name="txtkode" class="form-control">
                                        <?php
                                        $exec = mysql_query("SELECT * FROM kategori");
                                        while ($rs = mysql_fetch_assoc($exec)) {

                                            if ($rs["idkategori"] == $arr["idkategori"]) {
                                                $sel = "selected";
                                            } else {
                                                $sel = "";
                                            }

                                            echo "<option value='" . $rs["kode"] . "' " . $sel . ">" . $rs["namakategori"] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label>Judul</label>
                                    <input name="txtjudul" class="form-control" value="<?php echo $arr["judul"]; ?>" required />
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label>Pengarang</label>
                                    <input name="txtpengarang" class="form-control" value="<?php echo $arr["pengarang"]; ?>" required />
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label>Penerbit</label>
                                    <input name="txtpenerbit" class="form-control" value="<?php echo $arr["penerbit"]; ?>" required />
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label>Tahun Terbit</label>
                                    <input name="txttahunterbit" value="<?php echo $arr["tahunterbit"]; ?>" class="datepicker form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label>Tahun Pengadaan</label>
                                    <input name="txttahunpengadaan" value="<?php echo $arr["tahunpengadaan"]; ?>" class="datepicker form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label>Sumber</label>
                                    <select name="txtsumber" class="form-control">
                                        <?php
                                        $exec = mysql_query("SELECT * FROM sumberpengadaan");
                                        while ($rs = mysql_fetch_assoc($exec)) {

                                            if ($rs["idsumber"] == $arr["sumber"]) {
                                                $sel = "selected";
                                            } else {
                                                $sel = "";
                                            }

                                            echo "<option value='" . $rs["idsumber"] . "' " . $sel . ">" . $rs["keterangan"] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label>Nomer Seri</label>
                                    <input name="nomerseri" class="form-control" value="<?php echo $arr["nomerseri"]; ?>" required />
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label>Lokasi</label>
                                    <select name="txtrak" class="form-control">
                                        <?php
                                        $exec = mysql_query("SELECT * FROM rakbuku");
                                        while ($rs = mysql_fetch_assoc($exec)) {

                                            if ($rs["koderak"] == $arr["lokasi"]) {
                                                $sel = "selected";
                                            } else {
                                                $sel = "";
                                            }

                                            echo "<option value='" . $rs["koderak"] . "' " . $sel . ">" . $rs["nama"] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="btn-group">
                                    <a href="home.php?module=buku" class="btn btn-danger">Kembali</a>
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
            format: 'yyyy',
            minViewMode: 'years', // Menyembunyikan bulan dan tanggal
        });
    });
</script>