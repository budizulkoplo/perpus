<body onload=window.print()>
   <?php include('../../config/bar128.php');
   ?>
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
      <a href="../../home.php?module=buku" id="back" class="btn btn-default">Kembali Ke Perpustakaan</a>
   </div>

   <table border="0" cellspacing="15" cellpadding="2">

      <?php


      echo "<tr>";
      echo "<td align='center'>";
      echo $_GET['judul'];
      echo bar128(stripslashes($_GET['kode']));
      echo "</td>";
      echo "</tr>";

      ?>
   </table>