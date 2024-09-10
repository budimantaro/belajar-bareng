<?php
$host   ="localhost";
$user   ="root";
$pass   ="";
$db     ="belajar-bareng";


// kita buat koneksi database
$koneksi    = mysqli_connect($host, $user, $pass, $db);
if(!$koneksi){
    die("Gagal koneksi ke database");
}else{
    echo "Koneksi berhasil";
}
