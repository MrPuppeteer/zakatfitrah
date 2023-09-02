<?php session_start();

if (!isset($_SESSION['user'])) {
  header('location: login.php');
  exit();
}

require('../fpdf.php');
include_once('../koneksi.php');

$result1 = mysqli_query($mysqli, "SELECT * FROM mustahik_warga");
$result2 = mysqli_query($mysqli, "SELECT * FROM mustahik_lainnya");
$kategori = mysqli_query($mysqli, "SELECT * FROM kategori_mustahik");
$hak = array(
  "fakir" => 0, "miskin" => 0, "mampu" => 0,
  "amilin" => 0, "fisabilillah" => 0, "mualaf" => 0, "ibnu sabil" => 0
);

$jumlah_KK_warga = mysqli_num_rows($result1);
$total_beras_warga = 0;

$jumlah_KK_lainnya = mysqli_num_rows($result2);
$total_beras_lainnya = 0;

while ($kat = mysqli_fetch_array($kategori)) {
  $hak[$kat['nama_kategori']] = $kat['jumlah_hak'];
}

while ($res1 = mysqli_fetch_array($result1)) {
  $total_beras_warga += $res1['hak'];
}

while ($res2 = mysqli_fetch_array($result2)) {
  $total_beras_lainnya += $res2['hak'];
}

$pdf = new FPDF();

$pdf->AddPage();
$pdf->SetFont('Times', 'B', 16);
$pdf->Cell(200, 10, 'Laporan Distribusi Zakat Fitrah', 0, 0, 'C');

$pdf->SetFont('Times', 'B', 14);
$pdf->Write(10, "A. Distribusi Ke Mustahik Warga\n");
$pdf->SetFont('Times', '', 12);
$pdf->Write(10, "Kategori Mustahik: fakir, miskin, mampu\n");
$pdf->Write(10, "Hak Beras: fakir = " . $hak['fakir'] . " kg, miskin = " . $hak['miskin'] . " kg, mampu = " . $hak['mampu'] . " kg\n");
$pdf->Write(10, "Jumlah KK: " . $jumlah_KK_warga . " Kepala Keluarga\n");
$pdf->Write(10, "Total Beras: " . $total_beras_warga . " kg\n");

$pdf->SetFont('Times', 'B', 14);
$pdf->Write(10, "B. Distribusi Ke Mustahik Lainnya\n");
$pdf->SetFont('Times', '', 12);
$pdf->Write(10, "Kategori Mustahik: amilin, fisabilillah, mualaf, ibnu sabil\n");
$pdf->Write(10, "Hak Beras: amilin = " . $hak['amilin'] . " kg, fisabilillah = " . $hak['fisabilillah'] . " kg, mualaf = " . $hak['mualaf'] . " kg, ibnu sabil = " . $hak['ibnu sabil'] . " kg\n");
$pdf->Write(10, "Jumlah KK: " . $jumlah_KK_lainnya . " Kepala Keluarga\n");
$pdf->Write(10, "Total Beras: " . $total_beras_lainnya . " kg\n");

$pdf->Output();
