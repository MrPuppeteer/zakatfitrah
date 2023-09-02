<?php session_start();

if (!isset($_SESSION['user'])) {
  header('location: login.php');
  exit();
}

require('../fpdf.php');
include_once('../koneksi.php');

$result = mysqli_query($mysqli, "SELECT * FROM bayarzakat");

$total_muzakki = mysqli_num_rows($result);
$total_jiwa = 0;
$total_beras = 0;
$total_uang = 0;

while ($res = mysqli_fetch_array($result)) {
  $total_jiwa += $res['jumlah_tanggungan'];
  $total_beras += $res['bayar_beras'];
  $total_uang += $res['bayar_uang'];
}

$pdf = new FPDF();

$pdf->AddPage();
$pdf->SetFont('Times', 'B', 16);
$pdf->Cell(200, 10, 'Laporan Pengumpulan Zakat Fitrah', 0, 0, 'C');

$pdf->SetFont('Times', '', 12);
$pdf->Write(10, "Total Muzakki: " . $total_muzakki . " orang\n");
$pdf->Write(10, "Total Jiwa: " . $total_jiwa . " orang\n");
$pdf->Write(10, "Total Beras: " . $total_beras . " kg\n");
$pdf->Write(10, "Total Uang: Rp. " . $total_uang);

$pdf->Output();
