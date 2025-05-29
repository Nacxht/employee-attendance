<?php
require_once("../../db/config.php");
require_once("../auth.php");

if (isset($_POST["submit"])) {
  $tanggal_absensi = $_POST["tanggal-absensi"];
  $jam_masuk = $_POST["jam-masuk"];
  $jam_keluar = $_POST["jam-keluar"];

  $query = "INSERT INTO absensi_karyawan
    (nip_karyawan, tanggal_absensi, jam_masuk, jam_keluar)
    VALUES (?, ?, ?, ?)";

  $stmt = $db->prepare($query);
  $stmt->bind_param(
    "isss",
    $_SESSION["nip"],
    $tanggal_absensi,
    $jam_masuk,
    $jam_keluar
  );

  $result = $stmt->execute();

  if ($result) {
    header("Location: daftar.php");
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Absensi - Manajemen Karyawan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body class=" bg-gray-100 font-sans">
  <!-- Sidebar dashboard bang -->
  <div class="flex h-screen">
    <div class="w-64 bg-red-800 text-white p-4 hidden md:block">
      <div class="flex items-center space-x-2 mb-8">
        <i class="fas fa-user-shield text-2xl"></i>
        <h1 class="text-xl font-bold">ARCINNS</h1>
      </div>
      <nav class="space-y-1">
        <a href="../../index.php" class="flex items-center space-x-2 p-3 rounded-lg hover:bg-red-700">
          <i class="fas fa-home"></i>
          <span>Dashboard</span>
        </a>
        <a href="../karyawan/daftar.php" class="flex items-center space-x-2 p-3 rounded-lg hover:bg-red-700">
          <i class="fas fa-users"></i>
          <span>Karyawan</span>
        </a>
        <a href="daftar.php" class="flex items-center space-x-2 p-3 rounded-lg bg-red-700">
          <i class="fas fa-calendar-check"></i>
          <span>Absensi</span>
        </a>
        <a href="../24-001/pages/login.php" class="flex items-center space-x-2 p-3 rounded-lg hover:bg-red-700 mt-10">
          <i class="fas fa-sign-out-alt"></i>
          <span>Logout</span>
        </a>
      </nav>
    </div>

    <!-- Main Content kek navbar tapi bukan -->
    <div class="flex-1 overflow-auto">
      <header class="bg-white shadow-sm border border-bottom">
        <div class="flex justify-between items-center p-4">
          <h2 class="text-xl font-semibold text-gray-800">Absensi</h2>
          <div class="flex items-center space-x-4">
            <div class="relative">
              <i class="fas fa-bell text-gray-500 text-xl"></i>
              <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
            </div>
            <div class="flex items-center space-x-2">
              <div class="h-8 w-8 bg-blue-100 rounded-full flex items-center justify-center">
                <i class="fas fa-user text-blue-600"></i>
              </div>
              <span class="font-medium">
                <?= $_SESSION["username"] ?>
              </span>
            </div>
          </div>
        </div>
      </header>

      <main class="p-6 grid gap-[1rem]">
        <h1 class="text-3xl font-bold">
          Tambah Absensi
        </h1>

        <hr class="border-b border-gray-300">

        <div class="flex justify-center">
          <form action="tambah.php" method="post" class="grid grid-cols-2 w-fit gap-[0.5rem]">
            <div class="tanggal-absensi col-span-2">
              <label for="tanggal-absensi" class="block capitalize">Tanggal Absensi</label>
              <input type="date" name="tanggal-absensi" id="tanggal-absensi" required class="w-full p-[0.3rem] rounded-md border border-gray-500">
            </div>

            <div class="jam-masuk">
              <label for="jam-masuk" class="block capitalize">Jam Masuk</label>
              <input type="time" name="jam-masuk" id="jam-masuk" required class="w-[20rem] p-[0.3rem] rounded-md border border-gray-500">
            </div>

            <div class="jam-keluar">
              <label for="jam-keluar" class="block capitalize">Jam Keluar</label>
              <input type="time" name="jam-keluar" id="jam-keluar" required class="w-[20rem] p-[0.3rem] rounded-md border border-gray-500">
            </div>

            <div class="button">
              <button type="submit" name="submit" value="submit" class="bg-green-700 px-3 py-1 rounded-md font-bold text-white hover:bg-green-800 transition-all">
                Submit
              </button>
            </div>
          </form>
        </div>
      </main>
    </div>
  </div>
</body>

</html>