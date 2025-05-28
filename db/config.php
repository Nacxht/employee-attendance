<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "manajemen_karyawan";

$db = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($db->connect_error) {
    die("Koneksi gagal: " . $db->connect_error);
}
