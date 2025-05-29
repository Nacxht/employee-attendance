<?php
require_once("../db/config.php");
session_start();

if (isset($_SESSION["nip"]) && $_SESSION["username"]) {
  header("Location: ../index.php");
  exit;
}

if (isset($_POST["register"])) {
  $nip = $_POST["nip"];
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $konfirmasi_password = $_POST["konfirmasi-password"];
  $nama = $_POST["nama"];
  $umur = $_POST["umur"];
  $jenis_kelamin = $_POST["jenis-kelamin"];
  $departemen = $_POST["departemen"];
  $jabatan = $_POST["jabatan"];
  $kota_asal = $_POST["kota-asal"];

  $username_query = "SELECT username FROM users WHERE username = ?";
  $email_query = "SELECT email FROM users WHERE email = ?";

  $username_stmt = $db->prepare($username_query);
  $email_stmt = $db->prepare($email_query);

  $username_stmt->bind_param("s", $username);
  $email_stmt->bind_param("s", $email);


  $username_stmt->execute();

  if ($username_stmt->num_rows() >= 1) {
    $error = [
      "error" => "username",
      "message" => "Username sudah terdaftar!"
    ];
    exit;
  }

  $username_stmt->store_result();
  $email_stmt->execute();

  if ($email_stmt->num_rows() >= 1) {
    $error = [
      "error" => "email",
      "message" => "Email sudah terdaftar"
    ];
    exit;
  }

  $email_stmt->store_result();

  if ($password !== $konfirmasi_password) {
    $error = [
      "error" => "password",
      "message" => "Password tidak sama"
    ];
    exit;
  }

  $insert_query = "INSERT INTO users
    (nip, username, email, password, nama, umur, jenis_kelamin, departemen, jabatan, kota_asal)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

  $insert_stmt = $db->prepare($insert_query);
  $insert_stmt->bind_param(
    "issssissss",
    $nip,
    $username,
    $email,
    password_hash($_POST["password"], PASSWORD_DEFAULT),
    $nama,
    $umur,
    $jenis_kelamin,
    $departemen,
    $jabatan,
    $kota_asal
  );

  $result = $insert_stmt->execute();

  if ($result) {
    echo "<script>alert('Register berhasil!');</script>";
    header("Location: login.php");

    exit;
  } else {
    echo "<script>alert('Register gagal!');</script>";

    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - ARCINNO</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-r from-red-400 to-red-700 min-h-screen flex items-center justify-center py-[1rem]">
  <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-md">
    <div class="text-center mb-8">
      <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
        <i class="fas fa-user-shield text-blue-600 text-3xl"></i>
      </div>
      <h1 class="text-3xl font-bold text-gray-800">REGISTER ACCOUNT</h1>
      <p class="text-gray-600">Manajemen Karyawan & Absensi</p>
    </div>

    <form action="register.php" method="post" class="space-y-6">
      <div>
        <label for="nip" class="block text-sm font-medium text-gray-700 mb-1">NIP</label>
        <input type="number" name="nip" id="nip" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan NIP">
      </div>

      <div>
        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
        <input type="text" name="username" id="username" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan username">
      </div>

      <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input type="email" name="email" id="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan email">
      </div>

      <div>
        <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
        <input type="text" name="nama" id="nama" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan nama">
      </div>

      <div>
        <label for="umur" class="block text-sm font-medium text-gray-700 mb-1">Umur</label>
        <input type="number" name="umur" id="umur" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan umur">
      </div>

      <div>
        <label for="jenis-kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
        <select name="jenis-kelamin" id="jenis-kelamin" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
          <option value="" selected disabled>Pilih Jenis Kelamin</option>
          <option value="L">Laki-Laki</option>
          <option value="P">Perempuan</option>
        </select>
      </div>

      <div>
        <label for="departemen" class="block text-sm font-medium text-gray-700 mb-1">Departemen</label>
        <input type="text" name="departemen" id="departemen" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan departemen">
      </div>

      <div>
        <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
        <input type="text" name="jabatan" id="jabatan" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan jabatan">
      </div>

      <div>
        <label for="kota-asal" class="block text-sm font-medium text-gray-700 mb-1">Kota Asal</label>
        <input type="text" name="kota-asal" id="kota-asal" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan kota asal">
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input type="password" name="password" id="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan password">
      </div>

      <div>
        <label for="konfirmasi-password" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
        <input type="password" name="konfirmasi-password" id="konfirmasi-password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Konfirmasi password anda">
      </div>

      <div class="flex items-center justify-between">
        <div class="flex items-center">
          <input id="remember" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
          <label for="remember" class="ml-2 block text-sm text-gray-700">Agree to terms & conditions</label>
        </div>
      </div>

      <button type="submit" name="register" value="register" class="w-full bg-red-600 hover:bg-red-800 text-white py-3 px-4 rounded-lg font-medium transition duration-300 flex items-center justify-center">
        <i class="fas fa-sign-in-alt mr-2"></i>
        Buat Akun
      </button>
    </form>

    <div class="mt-6 text-center">
      <p class="text-sm text-gray-600">Belum punya akun?
        <a href="login.php" class="text-blue-600 hover:text-blue-800 font-medium">Daftar disini</a>
      </p>
    </div>
  </div>
</body>

</html>