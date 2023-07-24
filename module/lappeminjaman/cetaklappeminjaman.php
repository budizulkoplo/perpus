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
                                        <th colspan='8'>
                                            <center>Data Peminjaman</center>
                                        </th>

                                    </tr>
                                    <tr>
                                        <th>No</th>
                                        <th>Tgl Pinjam</th>
                                        <th>Barcode Buku</th>
                                        <th>Judul</th>
                                        <th>Nomor</th>
                                        <th>Peminjam</th>
                                        <th>Harus Kembali</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                               </tr>";
$no = 1;
$sql = mysql_query("select 
                    tglpinjam, barcodebuku, judul, nomerseri, barcodeanggota, nama as namaanggota, tglkembali as haruskembali,
                    a.status
                    from peminjaman a join buku b on a.barcodebuku=b.barcode
                    join anggota c on a.barcodeanggota=c.barcode where tglpinjam>='" . $tanggal1 . "' and tglpinjam<='" . $tanggal2 . "'");
while ($rs = mysql_fetch_assoc($sql)) {

    $html .= "<tr class='tbl-rpt'>
                            <td class='tbl-rpt'>" . $no . "</td>
                            <td class='tbl-rpt'>" . $rs["tglpinjam"] . "</td>
                            <td class='tbl-rpt'><center>" . $rs["barcodebuku"] . "</center></td>
                            <td class='tbl-rpt'><center>" . $rs["judul"] . "</center></td>
                            <td class='tbl-rpt'>" . $rs["nomerseri"] . "</td>
                            <td class='tbl-rpt'>" . $rs["namaanggota"] . "</td>
                            <td class='tbl-rpt'>" . $rs["haruskembali"] . "</td>
                            <td class='tbl-rpt'>" . $rs["status"] . "</td>";
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
