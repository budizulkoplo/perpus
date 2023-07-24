<body onload=window.print()>
    <script>
        function cetak() {
            window.print();
        }
    </script>
    <style>
        @media print {
            #print {
                display: none;
            }

            body {
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
                font-size: 9px;
            }


        }
    </style>
    <div id="print">
        <button type="button" class="btn btn-default" onclick="cetak()">Print</button>
        <a href="../../home.php?module=anggota" id="back" class="btn btn-default">Kembali Ke Perpustakaan</a><br><br>
    </div>
    <?php
    session_start();
    include('../../config/koneksi.php');
    include('../../config/fungsi_indotgl.php');
    include('../../config/bar128kartuanggota.php');

    $kode = $_GET['kode'];

    $exec = mysql_query("SELECT * FROM anggota where barcode='" . $kode . "'");
    $arr = mysql_fetch_assoc($exec);


    $html = "
    
<!DOCTYPE html>
<html>
<head>
  <title>Kartu Anggota Perpustakaan</title>
  <style>
    .card {
      width: 300px;
      height: 200px;
      border: 1px solid black;
      padding: 10px;
    }
    .card-title {
      font-size: 10pt;
      text-align: center;
      margin-bottom: 10px;
    }
    .card-photo {
    border: 1px solid black;
      float: left;
      width: 40;
      height: 60px;
      margin-right: 10px;
    }
    .card-info {
      float: left;
    }
    .card-info-item {
      margin-bottom: 5px;
      margin-left: 30px;
      font-size: 9pt;
    }
  </style>
</head>
<body>
  <div class='card'>
    <h2 class='card-title'>KARTU ANGGOTA PERPUSTAKAAN<br>SMP Kesatrian 2 Semarang</h2>
    
    <div class='card-photo'>
      foto
    </div>
    <div class='card-info'>
      <div class='card-info-item'><strong>Nama:</strong> " . $arr['nama'] . "</div>
      <div class='card-info-item'><strong>ID Anggota:</strong> " . $arr['barcode'] . "</div>
      <div class='card-info-item'><strong>No HP:</strong> " . $arr['nohp'] . "</div>
      <div class='card-info-item'><strong>Alamat:</strong> " . $arr['alamat'] . "</div>
      <div class='card-info-item'>" . bar128(stripslashes($arr['barcode'])) . "</div>
      
    </div>
   
    <div style='clear: both;'></div>
  </div>
</body>
</html>
";

    echo $html;
    ?>