<?php
include "koneksi.php";
session_start();

$albumid = $_POST['albumid'];
$namaalbum = $_POST['namaalbum'];
$deskripsi = $_POST['deskripsi'];

$sql = mysqli_query($conn, "update album set namaalbum='$namaalbum',deskripsi='$deskripsi' where albumid='$albumid'");

if ($sql) {
    echo "<script> 
                alert('Change Data successfully');
                location.href='album.php';
                </script>";
} else {
    echo "<script> 
                alert('Change Data Failed');
                location.href='album.php';
                </script>";
}
