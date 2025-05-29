<?php
require_once("../../db/config.php");
require_once("../auth.php");

$query = "SELECT
users.NIP, users.nama, absensi.id, absensi.tanggal_absensi, absensi.jam_masuk, absensi.jam_keluar
FROM absensi_karyawan as absensi
LEFT JOIN users ON absensi.nip_karyawan = users.NIP";

$daftar_absensi = $db->query($query)->fetch_all(MYSQLI_ASSOC);
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
        <a href="../logout.php" class="flex items-center space-x-2 p-3 rounded-lg hover:bg-red-700 mt-10">
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

      <main class="p-6">
        <div class="flex mb-4">
          <a href="tambah.php" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded shadow">
            + Absen Sekarang
          </a>
        </div>

        <!-- Recent Activity masih opsional susahhh -->
        <div class="bg-white rounded-xl shadow overflow-hidden border border-red-400">
          <?php if (!$daftar_absensi): ?>
            <div class="flex justify-center text-3xl font-bold text-gray-300 uppercase w-full h-[5rem] items-center">
              data absensi kosong
            </div>
          <?php else: ?>
            <div class="overflow-x-auto">
              <table class="min-w-full">
                <thead class="bg-blue-100">
                  <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-800 uppercase tracking-wider">NIP</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-800 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-800 uppercase tracking-wider">tanggal</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-800 uppercase tracking-wider">waktu_masuk</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-800 uppercase tracking-wider">waktu_pulang</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-800 uppercase tracking-wider">Aksi</th>
                  </tr>
                </thead>
                <tbody class="text-gray-700 text-sm font-light">
                  <?php foreach ($daftar_absensi as $absensi): ?>
                    <tr class="border-b hover:bg-gray-100">
                      <td class="py-3 px-6 text-center"><?= $absensi["NIP"] ?></td>
                      <td class="py-3 px-6 text-center"><?= $absensi["nama"] ?></td>
                      <td class="py-3 px-6 text-center"><?= $absensi["tanggal_absensi"] ?></td>
                      <td class="py-3 px-6 text-center"><?= $absensi["jam_masuk"] ?></td>
                      <td class="py-3 px-6 text-center"><?= $absensi["jam_keluar"] ?></td>
                      <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center space-x-2">
                          <a href="edit.php?id=<?= $absensi["id"] ?>" class="text-blue-500 hover:underline">
                            Edit
                          </a>

                          <a href="hapus.php?delete=true&id=<?= $absensi["id"] ?>" onclick="return confirmDelete();" class="text-red-500 hover:underline">
                            Hapus
                          </a>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          <?php endif ?>
      </main>
    </div>
  </div>

  <script src="../../assets/js/prompt.js"></script>
</body>

</html>