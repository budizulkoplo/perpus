<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <?php
        $a = $_GET;
        if (!isset($a["idanggota"])) {
            $idanggota = $_SESSION['username'];
        } else {
            $idanggota = $a["idanggota"];
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
                    <h5>Form order</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <form onsubmit="setSessionID(event)">
                            <label class="col-xs-2">ID Anggota</label>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="id_anggota" name="id_anggota" value="<?php echo $idanggota ?>" required>
                                </div>
                            </div>
                        </form>

                        <?php
                        if ($idanggota <> "") { ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <?php
                                    $anggota = "SELECT * from anggota where barcode='" . $idanggota . "'";
                                    $exec = mysql_query($anggota);
                                    while ($r = mysql_fetch_assoc($exec)) {
                                        $nama = $r['nama'];
                                        $barcode = $r['barcode'];
                                    }
                                    ?>
                                    <label class="col-xs-2">Peminjam</label>
                                    <div class="col-xs-2"><?php echo $nama; ?></div>
                                    <label class="col-xs-2">Barcode</label>
                                    <div class="col-xs-2"><?php echo $barcode; ?></div>
                                </div>
                            </div>

                            <label class="col-xs-2">Barcode Buku</label>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="barcodebuku" name="barcodebuku" onkeydown="inputbuku(event)" autofocus required>
                                </div>
                            </div>

                        <?php } ?>


                        <div class="col-xs-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="4">
                                            <center>Daftar Pinjam</center>
                                        </th>

                                    </tr>
                                    <tr>
                                        <th>Barcode</th>
                                        <th>Judul</th>
                                        <th>Nomor Seri</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT a.barcodebuku, b.judul, b.nomerseri, c.barcode, c.nama FROM persiapanpinjam a join buku b
                                    on a.barcodebuku=b.barcode join anggota c on a.barcodeanggota=c.barcode where c.barcode='" . $idanggota . "'";
                                    $exec = mysql_query($query);

                                    while ($rs = mysql_fetch_assoc($exec)) {
                                        echo "
                                    <tr>
                                        <td>" . $rs["barcodebuku"] . "</td>
                                        <td>" . $rs["judul"] . "</td>
                                        <td>" . $rs["nomerseri"] . "</td>
                                        <td align='center'><button onclick=hapus('" . urlencode($rs["barcodebuku"]) . "') class='btn btn-danger'><i class='fa fa-trash'></i> Hapus</button></td>
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
    function setSessionID(event) {
        event.preventDefault(); // Mencegah pengiriman form
        var input = document.getElementById("id_anggota");
        var barcodebuku = document.getElementById("barcodebuku");
        $.ajax({
            url: "module/order/carianggota.php?idanggota=" + input.value,
            type: "post",
            data: $(this).serialize(),
            success: function(msg) {
                data = $.parseJSON(msg);
                console.log(data);
                // toastr.success("dadadas");
                if (data["isError"] == 1) {
                    toastr.error(data["Alert"]);
                } else {
                    toastr.success(data["Alert"]);
                    setInterval(function() {
                        location.href = "home.php?module=order&idanggota=" + input.value;
                        barcodebuku.focus();
                    }, 500);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                toastr.error(errorThrown);
            }
        });

        return false;
    }

    function inputbuku(event) {
        var idanggota = document.getElementById("id_anggota");
        var barcodebuku = document.getElementById("barcodebuku");
        if (event.keyCode === 13) {
            $.ajax({
                url: "module/order/inputpinjam.php?barcode=" + barcodebuku.value + "&anggota=" + idanggota.value,
                type: "post",
                data: $(this).serialize(),
                success: function(msg) {
                    data = $.parseJSON(msg);
                    console.log(data);
                    // toastr.success("dadadas");
                    if (data["isError"] == 1) {
                        barcodebuku.innerHTML = '';
                        toastr.error(data["Alert"]);

                    } else {
                        toastr.success(data["Alert"]);
                        setInterval(function() {
                            location.href = "home.php?module=order&idanggota=" + idanggota.value;
                            barcodebuku.focus();
                        }, 500);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    toastr.error(errorThrown);
                }
            });

            return false;
        }
    }

    function resetSessionID() {
        location.href = "home.php?module=order";
        alert("Session ID anggota berhasil direset!");
    }

    function hapus(idbuku) {
        var input = document.getElementById("id_anggota");
        var r = confirm("Hapus peminjaman dengan barcode: '" + idbuku + "' ?")

        if (r === true) {
            // window.location.href = "module/order/inputpinjam.php?hapus=" + idbuku;
            $.ajax({
                url: "module/order/inputpinjam.php?hapus=" + idbuku + "&anggota=" + input.value,
                type: "post",
                data: $(this).serialize(),
                success: function(msg) {
                    data = $.parseJSON(msg);
                    console.log(data);
                    // toastr.success("dadadas");
                    if (data["isError"] == 1) {
                        toastr.error(data["Alert"]);
                    } else {
                        toastr.success(data["Alert"]);
                        setInterval(function() {
                            location.href = "home.php?module=order&idanggota=" + input.value;
                            barcodebuku.focus();
                        }, 500);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    toastr.error(errorThrown);
                }
            });

            return false;
        }
    }

    function simpantransaksi(idanggota) {
        var r = confirm("Selesaikan transaksi order untuk anggota: '" + idanggota + "' ?")

        if (r === true) {
            window.location.href = "module/order/inputpinjam.php?idanggota=" + idanggota;
        }
    }
</script>