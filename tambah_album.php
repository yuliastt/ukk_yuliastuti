<?php
include "koneksi.php";
session_start();

$namaalbum = $_POST['namaalbum'];
$deskripsi = $_POST['deskripsi'];
$tanggaldibuat = date("Y-m-d");
$userid = $_SESSION['userid'];

$sql = mysqli_query($conn, "insert into album values('','$namaalbum','$deskripsi','$tanggaldibuat','$userid')");

if ($sql) {
    echo "<script> 
            alert('Add Album Successfully');
            location.href='album.php';
            </script>";
} else {
    echo "<script> 
            alert('Add Album Failed');
            location.href='album.php';
            </script>";
}
