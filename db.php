<?php

$host = "localhost";
$user = "root"; 
$password = ""; 
$db = "iml_db"; 

$koneksi = new mysqli($host, $user, $password, $db);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

?>
