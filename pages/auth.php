<?php
session_start();

if (!isset($_SESSION["nip"]) && !isset($_SESSION["username"])) {
  header("Location: pages/login.php");
  exit;
}
