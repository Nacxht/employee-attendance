<?php
require_once("../../db/config.php");
require_once("../auth.php");

if (isset($_GET["delete"])) {
  $id = $_GET["id"];

  $delete_query = 'DELETE FROM absensi_karyawan WHERE id = ?';
  $stmt = $db->prepare($delete_query);

  $stmt->bind_param("i", $id);
  $result = $stmt->execute();

  if ($result) {
    header("Location: daftar.php");
    exit;
  } else {
    echo "<script>alert('Gagal menghapus absensi!');</script>";
    exit;
  }
}
