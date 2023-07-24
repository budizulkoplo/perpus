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
                <strong>Rak Buku</strong>
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Daftar Rak</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-xs-12"><a href="home.php?module=formrak&submit=new" class="btn btn-primary"><i class="fa fa-save (alias)"></i> Tambah Rak</a></div>
                        <div class="col-xs-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Kode Rak</th>
                                        <th>Nama Rak</th>
                                        <th>Deskripsi</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * from rakbuku";
                                    $exec = mysql_query($query);

                                    while ($rs = mysql_fetch_assoc($exec)) {
                                        echo "
                                    <tr>
                                        <td>" . $rs["koderak"] . "</td>
                                        <td>" . $rs["nama"] . "</td>
                                        <td>" . $rs["deskripsi"] . "</td>
                                        <td align='center'>
                                            <a href='home.php?module=formrak&submit=edit&idrak=" . $rs["idrak"] . "' class='btn btn-info'><i class='fa fa-pencil-square'></i> Edit<a>
                                            <button onclick=hapus('" . $rs["idrak"] . "') class='btn btn-danger'><i class='fa fa-trash'></i> Hapus</button>
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
    function hapus(idrak) {
        var r = confirm("Hapus Data rak dengan id: '" + idrak + "' ?")

        if (r === true) {
            window.location.href = "module/mrak/simpanrak.php?idrak=" + idrak;
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