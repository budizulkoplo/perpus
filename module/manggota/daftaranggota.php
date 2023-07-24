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
                <strong>Anggota</strong>
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Daftar Anggota</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-xs-12"><a href="home.php?module=formanggota&submit=new" class="btn btn-primary"><i class="fa fa-save (alias)"></i> Tambah Anggota</a></div>
                        <div class="col-xs-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Barcode</th>
                                        <th>NIS</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>No HP</th>
                                        <th>Email</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * from anggota";
                                    $exec = mysql_query($query);

                                    while ($rs = mysql_fetch_assoc($exec)) {
                                        echo "
                                    <tr>
                                    <td>" . $rs["barcode"] . "</td>
                                        <td>" . $rs["nis"] . "</td>
                                        <td>" . $rs["nama"] . "</td>
                                        <td>" . $rs["alamat"] . "</td>
                                        <td>" . $rs["nohp"] . "</td>
                                        <td>" . $rs["email"] . "</td>
                                        <td align='center'>
                                        <a href='module/manggota/cetakkartu.php?kode=" . $rs["barcode"] . "' class='btn btn-warning'><i class='fa fa-barcode'></i> Cetak Kartu<a>
                                        <a href='home.php?module=formanggota&submit=edit&idanggota=" . $rs["idanggota"] . "' class='btn btn-info'><i class='fa fa-pencil-square'></i> Edit<a>
                                            <button onclick=hapus('" . $rs["idanggota"] . "') class='btn btn-danger'><i class='fa fa-trash'></i> Hapus</button>
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
    function hapus(idanggota) {
        var r = confirm("Hapus Data Anggota dengan id: '" + idanggota + "' ?")

        if (r === true) {
            window.location.href = "module/manggota/simpananggota.php?idanggota=" + idanggota;
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