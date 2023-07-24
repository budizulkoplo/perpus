<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <?php
        $a = $_GET;
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
                <strong>Buku</strong>
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Daftar Buku</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-xs-12"><a href="home.php?module=formbuku&submit=new" class="btn btn-primary"><i class="fa fa-save (alias)"></i> Tambah Buku</a></div>
                        <div class="col-xs-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Barcode</th>
                                        <th>Judul</th>
                                        <th>Kategori</th>

                                        <th>Tahun</th>
                                        <th>Nomer Seri</th>
                                        <th>Lokasi</th>
                                        <th>Status</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT *,IF(`status` <> 'Ada', '-', nama) as lokasibuku FROM buku a join kategori b
                                    on a.idkategorikoleksi=b.kode join rakbuku c on a.lokasi=c.koderak";
                                    $exec = mysql_query($query);

                                    while ($rs = mysql_fetch_assoc($exec)) {
                                        echo "
                                    <tr> 
                                        <td>" . $rs["barcode"] . "</td>
                                        <td>" . $rs["judul"] . "</td>
                                        <td>" . $rs["namakategori"] . "</td>
                    
                                        <td>" . $rs["tahunpengadaan"] . "</td>
                                        <td>" . $rs["nomerseri"] . "</td>
                                        <td>" . $rs["lokasibuku"] . "</td>
                                        <td>" . $rs["status"] . "</td>
                                        <td align='center'>
                                            <a href='module/mbuku/barcode.php?kode=" . $rs["barcode"] . "&judul=" . $rs["judul"] . "' class='btn btn-warning'><i class='fa fa-barcode'></i> Barcode<a>
                                            <a href='home.php?module=formbuku&submit=edit&idbuku=" . $rs["idbuku"] . "' class='btn btn-info'><i class='fa fa-pencil-square'></i> Edit<a>
                                            <button onclick=hapus('" . $rs["idbuku"] . "') class='btn btn-danger'><i class='fa fa-trash'></i> Hapus</button>
                                        </td>
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
    function hapus(idbuku) {
        var r = confirm("Hapus Data Buku dengan id: '" + idbuku + "' ?")

        if (r === true) {
            window.location.href = "module/mbuku/simpanbuku.php?idbuku=" + idbuku;
        }
    }

    $(document).ready(function() {
        $(".table").dataTable({
            "autoWidth": false,
            "lengthChange": true,
            "pageLength": 100
        });
    })
</script>