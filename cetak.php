<?php
require "admin/session.php";
require "koneksi.php";

$universitas = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM universitas a JOIN kategori b ON a.kategori_id=b.id");

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Universitas</title>
</head>
<body>
    <h1>List Universitas</h1>
    <table border="1" cellpadding="10" cellspacing"0" class="table">
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Foto</th>
                <th>Kategori</th>
                <th>Jumlah Fakultas</th>
            </tr>';

$i = 1;
foreach ($universitas as $univ) {
    $html .= '<tr>
                            <td>' . $i++ . '</td>
                            <td>' . $univ["nama"] . '</td>
                            <td><img src="image/' . $univ["foto"] . '" width="150px"></td>
                            <td>' . $univ["nama_kategori"] . '</td>
                            <td>' . $univ["jumlah"] . '</td>
                        </tr>';
}



$html .= '</table>
</body>
</html>';

$mpdf->WriteHTML($html);
$mpdf->Output('list-universitas.pdf', 'I');
