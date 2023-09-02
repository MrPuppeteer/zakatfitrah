<?php session_start();

if (isset($_SESSION['flash_status'])) {
  $flash_status = $_SESSION['flash_status'];
  $flash_message = $_SESSION['flash_message'];
  unset($_SESSION['flash_status']);
  unset($_SESSION['flash_message']);
}

if (isset($_SESSION['user'])) {
  header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body class="min-h-screen min-w-screen bg-gradient-to-tl from-green-700 via-gray-800 to-gray-900">
  <!-- Flash message -->
  <?php if (isset($flash_status)) { ?>
    <div id="alert" <?php if ($flash_status === 'Error') { ?> class="flex p-4 mb-4 bg-gray-800 text-red-400" <?php } elseif ($flash_status === 'Success') { ?> class="flex p-4 mb-4 bg-gray-800 text-green-400" <?php } ?> role="alert">
      <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
      </svg>
      <span class="sr-only">Info</span>
      <div class="ml-3 text-sm font-medium">
        <?php echo $flash_status; ?>! <?php echo $flash_message; ?>
      </div>
      <button type="button" <?php if ($flash_status === 'Error') { ?> class="ml-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 inline-flex h-8 w-8 bg-gray-800 text-red-400 hover:bg-gray-700" <?php } ?> <?php if ($flash_status === 'Success') { ?> class="ml-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 inline-flex h-8 w-8 bg-gray-800 text-green-400 hover:bg-gray-700" <?php } ?> data-dismiss-target="#alert" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
      </button>
    </div>
  <?php } ?>

  <?php
  include("koneksi.php");

  if (isset($_POST['submit'])) {
    $user = mysqli_real_escape_string($mysqli, $_POST['username']);
    $pass = mysqli_real_escape_string($mysqli, $_POST['password']);

    if ($user == "" || $pass == "") {
      $_SESSION['flash_status'] = "Error";
      $_SESSION['flash_message'] = "Salah satu atau kedua kolom username atau password kosong.";
      header('location: login.php');
      exit();
    } else {
      $result = mysqli_query($mysqli, "SELECT * FROM user WHERE username='$user' AND password=md5('$pass')")
        or die("Could not execute the select query.");

      $row = mysqli_fetch_assoc($result);

      if (is_array($row) && !empty($row)) {
        $_SESSION['user'] = $row['username'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['flash_status'] = "Success";
        $_SESSION['flash_message'] = "Login berhasil!";
      } else {
        $_SESSION['flash_status'] = "Error";
        $_SESSION['flash_message'] = "Username atau password tidak valid.";
        header('location: login.php');
        exit();
      }

      if (isset($_SESSION['user'])) {
        header('Location: index.php');
      }
    }
  } else {
  ?>
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <a href="./index.php" class="flex items-center mb-6 text-2xl font-semibold text-white">
        <img class="w-8 h-8 mr-2" src="logo.png" alt="logo">
        Zakat Fitrah
      </a>
      <div class="w-full rounded-lg shadow border md:mt-0 sm:max-w-md xl:p-0 bg-gray-800 border-gray-700">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
          <h1 class="text-xl font-bold leading-tight tracking-tight md:text-2xl text-white">
            Masuk ke Akun Anda
          </h1>
          <form name="login" class="space-y-4 md:space-y-6" method="POST" action="">
            <div>
              <label for="username" class="block mb-2 text-sm font-medium text-white">Username</label>
              <input type="text" name="username" id="username" class="border sm:text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-green-500 focus:border-green-500" placeholder="Username" required="">
            </div>
            <div>
              <label for="password" class="block mb-2 text-sm font-medium text-white">Password</label>
              <input type="password" name="password" id="password" placeholder="••••••••" class="border sm:text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-green-500 focus:border-green-500" required="">
            </div>
            <!-- <div class="flex items-center justify-between">
            <div class="flex items-start">
              <div class="flex items-center h-5">
                <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border rounded focus:ring-3 bg-gray-700 border-gray-600 focus:ring-green-600 ring-offset-gray-800" required="">
              </div>
              <div class="ml-3 text-sm">
                <label for="remember" class="text-gray-300">Remember me</label>
              </div>
            </div>
            <a href="#" class="text-sm font-medium hover:underline text-green-500">Forgot password?</a>
          </div> -->
            <button name="submit" type="submit" value="submit" class="w-full text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-green-600 hover:bg-green-700 focus:ring-green-800">Masuk</button>
            <p class="text-sm font-light text-gray-400">
              Belum memiliki akun? <a href="./register.php" class="font-medium hover:underline text-green-500">Daftar</a>
            </p>
          </form>
        </div>
      </div>
    </div>
  <?php } ?>

  <script src="./node_modules/flowbite/dist/flowbite.min.js"></script>
</body>

</html>