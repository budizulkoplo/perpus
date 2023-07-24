<?php
session_start();

if (isset($_SESSION['username'])) {
?>
    <!DOCTYPE html>
    <html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>.:: E-Perpus | SMP Kesatrian 2 Semarang ::.</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">
        <link href="css/plugins/datatables/datatables.bootstrap.css" rel="stylesheet">
        <link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">

        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>

        <div id="wrapper">

            <nav class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="nav-header">
                            <div class="dropdown profile-element"> <span>
                                    <img alt="image" width="60" src="img/user.png" />
                                </span>
                                <a data-toggle="dropdown" class="dropdown-toggle">
                                    <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $_SESSION['namaadmin'] ?></strong>
                                        </span> <span class="text-muted text-xs block">level: <strong><?php echo $_SESSION['level']; ?></strong> <b></b></span> </span> </a>
                                </span></span> </a>

                            </div>
                            <div class="logo-element">
                                E-Perpus
                            </div>
                        </li>
                        <li>
                            <a href="index.php"><i class="fa fa-home"></i> <span class="nav-label">Dashboards</span></a>
                        </li>

                        <?php
                        include "config/koneksi.php";
                        $sql = mysql_query("SELECT * FROM menu where submenu='0' and aktif='Y' and `level` like '%$_SESSION[level]%' ORDER BY idmenu ASC");
                        if (mysql_num_rows($sql) != 0) {

                            while ($row = mysql_fetch_array($sql)) {
                                $parentid = $row["parentid"];
                                $sql2 = mysql_query("SELECT * FROM menu where submenu='1' and aktif='Y' and `level` like '%$_SESSION[level]%' and parentid='$parentid'");

                                echo "<li><a href='$row[link]'><i class='$row[icon]'></i> <span class='nav-label'>$row[namamenu]</span> $row[add]</a>";
                                while ($row2 = mysql_fetch_array($sql2)) {
                                    echo "<ul class='nav nav-second-level'>";

                                    echo "
                <li><a href='$row2[link]'><i class='$row2[icon]'></i> $row2[namamenu]</a></li>";

                                    echo "</ul>";
                                }
                                echo "</li>";
                            }
                        }
                        ?>
                </div>
            </nav>

            <div id="page-wrapper" class="gray-bg">
                <div class="row border-bottom">
                    <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
                        <div class="navbar-header">
                            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>

                        </div>
                        <ul class="nav navbar-top-links navbar-right">
                            <li>
                                <a href="logout.php">
                                    <i class="fa fa-sign-out"></i> Log out
                                </a>
                            </li>
                        </ul>

                    </nav>
                </div>
                <!-- Mainly scripts -->
                <script src="js/jquery-2.1.1.js"></script>
                <script src="js/bootstrap.min.js"></script>
                <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
                <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
                <script src="js/plugins/datatables/jquery.datatables.js"></script>
                <script src="js/plugins/datatables/datatables.bootstrap.js"></script>
                <script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>

                <!-- Custom and plugin javascript -->
                <script src="js/inspinia.js"></script>
                <script src="js/plugins/pace/pace.min.js"></script>

                <?php
                if (isset($_GET['module'])) {
                    switch ($_GET['module']) {
                        case 'anggota':
                            include "module/manggota/daftaranggota.php";
                            break;
                        case 'formanggota':
                            include "module/manggota/formanggota.php";
                            break;
                        case 'kategori':
                            include "module/mkategori/daftarkategori.php";
                            break;
                        case 'formkategori':
                            include "module/mkategori/formkategori.php";
                            break;
                        case 'rak':
                            include "module/mrak/daftarrak.php";
                            break;
                        case 'formrak':
                            include "module/mrak/formrak.php";
                            break;
                        case 'buku':
                            include "module/mbuku/daftarbuku.php";
                            break;
                        case 'formbuku':
                            include "module/mbuku/formbuku.php";
                            break;
                        case 'peminjaman':
                            include "module/mpeminjaman/peminjaman.php";
                            break;
                        case 'pengembalian':
                            include "module/mpengembalian/pengembalian.php";
                            break;
                        case 'user':
                            include "module/user/daftaruser.php";
                            break;
                        case 'formuser':
                            include "module/user/formuser.php";
                            break;
                        case 'lappeminjaman':
                            include "module/lappeminjaman/lappeminjaman.php";
                            break;
                        case 'lappengembalian':
                            include "module/lappengembalian/lappengembalian.php";
                            break;
                        case 'history':
                            include "module/history/history.php";
                            break;
                        case 'order':
                            include "module/order/peminjaman.php";
                            break;
                    }
                } else {
                    include "welcome.php";
                }
                ?>
                <div class="footer">
                    <div>
                        <strong>Copyright</strong> SMP Kesatrian 2 Semarang &copy; 2023
                    </div>
                </div>

            </div>
        </div>



    </body>

    </html>
    <link href="css/select2.min.css" rel="stylesheet" />
    <script src="js/plugins/toastr/toastr.min.js"></script>
    <script src="js/select2.min.js"></script>

<?php
} else {
    header('location : login.php');
}
?>