<?php
session_start();
include('../../config/koneksi.php');
include('../../config/fungsi_indotgl.php');


$tanggal1 = $_GET['tanggal1'];
$tanggal2 = $_GET['tanggal2'];


$html = "
<table width='100%' border='1'>
                                <thead>
                                    <tr>
                                        <th colspan='9'>
                                            <center>Data Pengembalian</center>
                                        </th>

                                    </tr>
                                    <tr>
                                        <th>No</th>
                                        <th>Tgl Pengembalian</th>
                                        <th>Barcode Buku</th>
                                        <th>Judul</th>
                                        <th>Nomor</th>
                                        <th>Peminjam</th>
                                        <th>Harus Kembali</th>
                                        <th>Keterlambatan</th>
                                        <th>Petugas</th>
                                    </tr>
                                </thead>
                               </tr>";
$no = 1;
$sql = mysql_query("select a.tglkembali, a.barcodebuku, judul,nomerseri, a.barcodeanggota, nama, haruskembali, 
keterlambatan, a.petugas
from pengembalian a join buku b on a.barcodebuku=b.barcode
join anggota c on a.barcodeanggota=c.barcode 
join peminjaman d on a.idpinjam=d.idpinjam where a.tglkembali>='" . $tanggal1 . "' and a.tglkembali<='" . $tanggal2 . "'");
while ($rs = mysql_fetch_assoc($sql)) {

    $html .= "<tr class='tbl-rpt'>
                            <td class='tbl-rpt'>" . $no . "</td>
                            <td class='tbl-rpt'>" . $rs["tglkembali"] . "</td>
                            <td class='tbl-rpt'><center>" . $rs["barcodebuku"] . "</center></td>
                            <td class='tbl-rpt'><center>" . $rs["judul"] . "</center></td>
                            <td class='tbl-rpt'>" . $rs["nomerseri"] . "</td>
                            <td class='tbl-rpt'>" . $rs["nama"] . "</td>
                            <td class='tbl-rpt'>" . $rs["haruskembali"] . "</td>
                            <td class='tbl-rpt'>" . $rs["keterlambatan"] . "</td>
                            <td class='tbl-rpt'>" . $rs["petugas"] . "</td>";
    $no++;
}
$html .= "</tr>
 </tbody>
</table>
";

// echo $html;
//==============================================================
//==============================================================
//==============================================================

include("../../mpdf/mpdf.php");

$mpdf = new mPDF('c');
$mpdf->setFooter('halaman {PAGENO}');
$mpdf->SetDisplayMode('fullpage');

// LOAD a stylesheet
$stylesheet = file_get_contents('../../mpdf/mpdf.css');
$mpdf->WriteHTML($stylesheet, 1);    // The parameter 1 tells that this is css/style only and no body/html/text

$mpdf->WriteHTML($html);

$mpdf->Output();

exit;

//==============================================================
//==============================================================
//==============================================================
