<?php session_start();

if (!isset($_SESSION['user'])) {
  header('location: login.php');
  exit();
}

include("../koneksi.php");

$id = $_GET['id'];

$check = mysqli_query($mysqli, "SELECT * FROM mustahik_warga WHERE id_mustahikwarga=$id");
if (mysqli_num_rows($check) === 0) {
  $_SESSION['flash_status'] = 'Error';
  $_SESSION['flash_message'] = 'Data Mustahik Warga tidak ditemukan.';
  header('location: index.php');
  exit();
}

$result = mysqli_query($mysqli, "DELETE FROM mustahik_warga WHERE id_mustahikwarga=$id");

if ($result) {
  $_SESSION['flash_status'] = 'Success';
  $_SESSION['flash_message'] = 'Data Mustahik Warga berhasil dihapus.';
  header('location: index.php');
  exit();
} else {
  $_SESSION['flash_status'] = 'Error';
  $_SESSION['flash_message'] = 'Data Mustahik Warga gagal dihapus.';
  header('location: index.php');
  exit();
}
