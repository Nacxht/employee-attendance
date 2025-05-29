<?php
require_once("../../db/config.php");
require_once("../auth.php");

if (isset($_GET["delete"])) {
  $nip = $_GET["nip"];

  $delete_query = "DELETE FROM users WHERE NIP = ?";
  $stmt = $db->prepare($delete_query);

  $stmt->bind_param("i", $nip);

  $result = $stmt->execute();

  if ($result) {
    header("Location: daftar.php");
    exit;
  } else {
    echo "<script>alert('Gagal menghapus karyawan!');</script>";
    exit;
  }
}
