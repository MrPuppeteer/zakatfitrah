<?php
session_start();
session_destroy();
session_start();
$_SESSION['flash_status'] = "Success";
$_SESSION['flash_message'] = "Logout berhasil!";
header("location: login.php");
