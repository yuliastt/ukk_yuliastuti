<?php
include "koneksi.php";

$username = $_POST['username'];
$password = md5($_POST['password']);
$email = $_POST['email'];
$namalengkap = $_POST['namalengkap'];
$alamat = $_POST['alamat'];

$sql = mysqli_query($conn, "insert into user values('','$username','$password','$email','$namalengkap','$alamat')");

if ($sql) {
    echo "<script> 
        alert('Registration Successful');
        location.href='login.php';
        </script>";
} else {
    echo "<script> 
        alert('Registration Failed');
        location.href='register.php';
        </script>";
}


