<?php
require_once("../db/config.php");
session_start();

if (isset($_SESSION["nip"]) && $_SESSION["username"]) {
  header("Location: ../index.php");
  exit;
}

if (isset($_POST["login"])) {
  $username_input = $_POST["username"];
  $password = $_POST["password"];

  $query = "SELECT NIP, username, password FROM users WHERE username = ?";
  $stmt = $db->prepare($query);
  $stmt->bind_param("s", $username_input);

  $result = $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows === 1) {
    $stmt->bind_result($nip, $username, $hashed_password);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
      $_SESSION["nip"] = $nip;
      $_SESSION["username"] = $username;

      header("Location: ../index.php");
      exit();
    } else {
      $error = [
        "error" => "password",
        "message" => "Password anda salah"
      ];
    }
  } else {
    $error = [
      "error" => "username",
      "message" => "Username tidak ditemukan"
    ];
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

<body class="bg-gradient-to-r from-red-400 to-red-700 min-h-screen flex items-center justify-center">
  <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-md">
    <div class="text-center mb-8">
      <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
        <i class="fas fa-user-shield text-blue-600 text-3xl"></i>
      </div>
      <h1 class="text-3xl font-bold text-gray-800">LOGIN</h1>
      <p class="text-gray-600">Manajemen Karyawan & Absensi</p>
    </div>

    <form action="login.php" method="post" class="space-y-6">
      <div>
        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">
          Username

          <?php if (isset($error)): ?>
            <span class="text-xs text-red-500">
              <?= $error["error"] == "username" ? "*(" . $error["message"] . ")" : "" ?>
            </span>
          <?php endif ?>
        </label>
        <input type="text" name="username" id="username" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan username">
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
          Password

          <?php if (isset($error)): ?>
            <span class="text-xs text-red-500">
              <?= $error["error"] == "password" ? "*(" . $error["message"] . ")" : "" ?>
            </span>
          <?php endif ?>
        </label>

        <input type="password" name="password" id="password" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan password">
      </div>

      <div class="flex items-center justify-between">
        <div class="flex items-center">
          <input id="remember" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
          <label for="remember" class="ml-2 block text-sm text-gray-700">Remember Me</label>
        </div>
        <a href="#" class="text-sm text-blue-600 hover:text-blue-800">Lupa password?</a>
      </div>

      <button type="submit" name="login" value="login" class="w-full bg-red-600 hover:bg-red-800 text-white py-3 px-4 rounded-lg font-medium transition duration-300 flex items-center justify-center">
        <i class="fas fa-sign-in-alt mr-2"></i>
        Masuk
      </button>
    </form>

    <div class="mt-6 text-center">
      <p class="text-sm text-gray-600">Belum punya akun?
        <a href="../pages/register.php" class="text-blue-600 hover:text-blue-800 font-medium">Daftar disini</a>
      </p>
    </div>
  </div>
</body>

</html>