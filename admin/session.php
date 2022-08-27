<?php
session_start();
if (!isset($_SESSION['id']) || (trim($_SESSION['id']) == '')) {
   header('location:../index.php');
   exit();
}

// include('../connection.php');

// $sq = mysqli_query($conn, "select * from admins where adminID='" . $_SESSION['id'] . "' ");
// $srow = mysqli_fetch_array($sq);

// $user = $srow['username'];
?>