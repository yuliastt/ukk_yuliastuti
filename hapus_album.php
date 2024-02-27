<?php
include "koneksi.php";
session_start();

$albumid = $_GET['albumid'];

$sql = mysqli_query($conn, "delete from album where albumid='$albumid'");

if ($sql) {
    echo "<script> 
                    alert('Delete Data Successful');
                    location.href='album.php';
                    </script>";
} else {
    echo "<script> 
                    alert('Delete Data Failed');
                    location.href='album.php';
                    </script>";
}
