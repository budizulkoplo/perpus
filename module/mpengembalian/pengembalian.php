<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <?php
        $a = $_GET;
        if (!isset($a["idanggota"])) {
            $idanggota = "";
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
                    <h5>Form Pengembalian</h5>
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
                        <div class="col-md-1 col-xs-12">
                            <div class="form-group">
                                <button type="submit" onclick="resetSessionID()" name="submit" value="new" class="btn btn-primary"><i class="fa fa-search"></i> Baru</button>

                            </div>
                        </div>
                        <?php
                        if ($idanggota <> "") { ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <?php
                                    $anggota = "SELECT * from anggota where barcode='" . $a["idanggota"] . "'";
                                    $exec = mysql_query($anggota);
                                    while ($r = mysql_fetch_assoc($exec)) {
                                        $nama = $r['nama'];
                                        $barcode = $r['barcode'];
                                    }
                                    ?>
                                    <label class="col-xs-2">Peminjam</label>
                                    <div class="col-xs-4">
                                        <h4><?php echo $nama; ?></h4>
                                    </div>

                                </div>
                            </div>
                        <?php } ?>
                        <br>
                        <div class="col-xs-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="6">
                                            <center>Daftar Pinjam</center>
                                        </th>

                                    </tr>
                                    <tr>
                                        <th>Barcode</th>
                                        <th>Judul</th>
                                        <th>Tgl Pinjam</th>
                                        <th>Tgl Kembali</th>
                                        <th>Keterlambatan</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT *, a.status as statuspinjam,
                                    if(CURRENT_DATE<tglkembali,'-',concat(DATEDIFF(CURRENT_DATE, tglkembali),' Hari') ) as keterlambatan
                                    from peminjaman a
                                    join buku b on a.barcodebuku=b.barcode where a.status='Dipinjam' and barcodeanggota='" . $idanggota . "'";
                                    $exec = mysql_query($query);

                                    while ($rs = mysql_fetch_assoc($exec)) {
                                        $statuspinjam = $rs["statuspinjam"];
                                        echo "
                                    <tr>
                                        <td>" . $rs["barcodebuku"] . "</td>
                                        <td>" . $rs["judul"] . "</td>
                                        <td>" . $rs["tglpinjam"] . "</td>
                                        <td>" . $rs["tglkembali"] . "</td>
                                        <td>" . $rs["keterlambatan"] . "</td>";
                                        if ($statuspinjam <> "Dikembalikan") {
                                            echo "
                                        <td align='center'><button onclick=kembali('" . urlencode($rs["barcodebuku"]) . "') class='btn btn-primary'><i class='fa fa-reply'></i> Kembalikan</button></td>";
                                        } else {
                                            echo "<td align='center'><h4>Kembali</h4></td>";
                                        }
                                        echo "</tr>";
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
            url: "module/mpeminjaman/carianggota.php?idanggota=" + input.value,
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
                        location.href = "home.php?module=pengembalian&idanggota=" + input.value;
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
                url: "module/mpeminjaman/inputpinjam.php?barcode=" + barcodebuku.value + "&anggota=" + idanggota.value,
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
                            location.href = "home.php?module=peminjaman&idanggota=" + idanggota.value;
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
        location.href = "home.php?module=pengembalian";
        alert("Session ID anggota berhasil direset!");
    }

    function kembali(idbuku) {
        var input = document.getElementById("id_anggota");
        var r = confirm("Pengembalian buku dengan barcode: '" + idbuku + "' ?")

        if (r === true) {
            // window.location.href = "module/mpeminjaman/inputpinjam.php?hapus=" + idbuku;
            $.ajax({
                url: "module/mpengembalian/inputpengembalian.php?kembali=" + idbuku + "&anggota=" + input.value,
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
                            location.href = "home.php?module=pengembalian&idanggota=" + input.value;
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
        var r = confirm("Selesaikan transaksi peminjaman untuk anggota: '" + idanggota + "' ?")

        if (r === true) {
            window.location.href = "module/mpeminjaman/inputpinjam.php?idanggota=" + idanggota;
        }
    }
</script>