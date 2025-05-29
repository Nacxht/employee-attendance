<?php
require_once("../../db/config.php");
require_once("../auth.php");

if (isset($_POST["submit"])) {
  $nip = $_POST["nip"];
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
  $nama_karyawan = $_POST["nama"];
  $umur = $_POST["umur"];
  $jenis_kelamin = $_POST["jenis-kelamin"];
  $departemen = $_POST["departemen"];
  $jabatan = $_POST["jabatan"];
  $kota_asal = $_POST["kota-asal"];

  $query = "INSERT INTO users
    (NIP, username, email, password, nama, umur, jenis_kelamin, departemen, jabatan, kota_asal)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

  $stmt = $db->prepare($query);
  $stmt->bind_param(
    "issssissss",
    $nip,
    $username,
    $email,
    $password,
    $nama_karyawan,
    $umur,
    $jenis_kelamin,
    $departemen,
    $jabatan,
    $kota_asal
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
  <title>Karyawan - Manajemen Karyawan</title>
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
        <a href="daftar.php" class="flex items-center space-x-2 p-3 rounded-lg bg-red-700">
          <i class="fas fa-users"></i>
          <span>Karyawan</span>
        </a>
        <a href="../absensi/daftar.php" class="flex items-center space-x-2 p-3 rounded-lg hover:bg-red-700">
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
          <h2 class="text-xl font-semibold text-gray-800">Karyawan</h2>
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
          Tambah Karyawan
        </h1>

        <hr class="border-b border-gray-300">

        <div class="flex justify-center">
          <form action="tambah.php" method="post" class="grid grid-cols-2 w-fit gap-[0.5rem]">
            <div class="nip">
              <label for="nip" class="block capitalize">NIP</label>
              <input type="number" name="nip" id="nip" class="w-[20rem] p-[0.3rem] rounded-md border border-gray-500" required>
            </div>

            <div class="username">
              <label for="username" class="block capitalize">Username</label>
              <input type="text" name="username" id="username" class="w-[20rem] p-[0.3rem] rounded-md border border-gray-500" required>
            </div>

            <div class="email">
              <label for="email" class="block capitalize">Email</label>
              <input type="email" name="email" id="email" class="w-[20rem] p-[0.3rem] rounded-md border border-gray-500" required>
            </div>

            <div class="password">
              <label for="password" class="block capitalize">Password</label>
              <input type="password" name="password" id="password" class="w-[20rem] p-[0.3rem] rounded-md border border-gray-500" required>
            </div>

            <div class="nama">
              <label for="nama" class="block capitalize">Nama Karyawan</label>
              <input type="text" name="nama" id="nama" class="w-[20rem] p-[0.3rem] rounded-md border border-gray-500" required>
            </div>

            <div class="umur">
              <label for="umur" class="block capitalize">Umur</label>
              <input type="number" name="umur" id="umur" class="w-[20rem] p-[0.3rem] rounded-md border border-gray-500" required>
            </div>

            <div class="jenis-kelamin">
              <label for="jenis-kelamin" class="block capitalize">Jenis Kelamin</label>
              <select name="jenis-kelamin" id="jenis-kelamin" class="w-[20rem] p-[0.3rem] rounded-md border border-gray-500" required>
                <option value="" selected disabled>pilih jenis kelamin</option>
                <option value="L">Laki-Laki</option>
                <option value="P">Perempuan</option>
              </select>
            </div>

            <div class="departemen">
              <label for="departemen" class="block capitalize">Departemen</label>
              <input type="text" name="departemen" id="departemen" class="w-[20rem] p-[0.3rem] rounded-md border border-gray-500" required>
            </div>

            <div class="jabatan">
              <label for="jabatan" class="block capitalize">Jabatan</label>
              <input type="text" name="jabatan" id="jabatan" class="w-[20rem] p-[0.3rem] rounded-md border border-gray-500" required>
            </div>

            <div class="kota-asal">
              <label for="kota-asal" class="block capitalize">Kota Asal</label>
              <input type="text" name="kota-asal" id="kota-asal" class="w-[20rem] p-[0.3rem] rounded-md border border-gray-500" required>
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