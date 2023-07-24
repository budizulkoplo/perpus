<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <?php
        $a = $_GET;
        if (!isset($a["tanggal1"])) {
            $tanggal1 = date('Y-m-d', strtotime('-1 day'));
        } else {
            $tanggal1 = $a["tanggal1"];
        }
        if (!isset($a["tanggal2"])) {
            $tanggal2 = date('Y-m-d');
        } else {
            $tanggal2 = $a["tanggal2"];
        }

        $ico = "SELECT * from menu where SUBSTRING_INDEX(link, '=', -1)='" . $a["module"] . "'";
        $exec = mysql_query($ico);
        while ($rico = mysql_fetch_assoc($exec)) {
            echo "<h2><i class='$rico[icon]'></i> $rico[namamenu]</h2>";
        }
        ?>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Home</a>
            </li>
            <li class="active">
                <strong><?php echo $a["module"]; ?></strong>
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Riwayat Peminjaman</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">


                        <div class="col-xs-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="7">
                                            <center>Data Peminjaman</center>
                                        </th>

                                    </tr>
                                    <tr>
                                        <th>Tgl Pinjam</th>
                                        <th>Barcode Buku</th>
                                        <th>Judul</th>
                                        <th>Nomor</th>
                                        <th>Peminjam</th>
                                        <th>Harus Kembali</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "select 
                                    tglpinjam, barcodebuku, judul, nomerseri, barcodeanggota, nama as namaanggota, tglkembali as haruskembali,
                                    a.status
                                    from peminjaman a join buku b on a.barcodebuku=b.barcode
                                    join anggota c on a.barcodeanggota=c.barcode where barcodeanggota='" . $_SESSION['username'] . "' ";
                                    $exec = mysql_query($query);

                                    while ($rs = mysql_fetch_assoc($exec)) {
                                        echo "
                                    <tr>
                                        <td>" . $rs["tglpinjam"] . "</td>
                                        <td>" . $rs["barcodebuku"] . "</td>
                                        <td>" . $rs["judul"] . "</td>
                                        <td>" . $rs["nomerseri"] . "</td>
                                        <td>" . $rs["namaanggota"] . "</td>
                                        <td>" . $rs["haruskembali"] . "</td>
                                        <td>" . $rs["status"] . "</td>
                                    </tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
<script>
    function tampildata() {
        var tgl1 = document.getElementById("tanggal1");
        var tgl2 = document.getElementById("tanggal2");
        location.href = "home.php?module=lappeminjaman&tanggal1=" + tgl1.value + "&tanggal2=" + tgl2.value;

    }
</script>