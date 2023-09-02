<?php session_start();

if (!isset($_SESSION['user'])) {
  header('location: login.php');
  exit();
}

if (isset($_SESSION['flash_status'])) {
  $flash_status = $_SESSION['flash_status'];
  $flash_message = $_SESSION['flash_message'];
  unset($_SESSION['flash_status']);
  unset($_SESSION['flash_message']);
}

include_once("../koneksi.php");

$result = mysqli_query($mysqli, "SELECT * FROM bayarzakat");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pengumpulan Zakat Fitrah</title>
  <link rel="stylesheet" href="../styles.css">
</head>

<body class="min-h-screen min-w-screen bg-gradient-to-tl from-green-700 via-gray-800 to-gray-900">
  <!-- Navbar -->
  <nav class="fixed top-0 z-50 w-full border-b bg-gray-800 border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
      <div class="flex items-center justify-between">
        <div class="flex items-center justify-start">
          <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 text-sm rounded-lg md:hidden focus:outline-none focus:ring-2 text-gray-400 hover:bg-gray-700 focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
          </button>
          <a href="../index.php" class="flex ml-2 md:mr-24">
            <img src="../logo.png" class="h-8" alt="Zakat Logo" />
            <span class="self-center text-xl font-semibold ml-3 sm:text-2xl whitespace-nowrap text-white">Zakat Fitrah</span>
          </a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Sidebar -->
  <aside id="default-sidebar" class="fixed top-14 left-0 z-40 w-64 h-screen transition-transform -translate-x-full md:translate-x-0" aria-label="Sidenav">
    <div class="overflow-y-auto py-5 px-3 h-full border-r bg-gray-800 border-gray-700">
      <ul class="space-y-2">
        <li>
          <a href="../index.php" class="flex items-center p-2 text-base font-normal rounded-lg text-white hover:bg-gray-700 group">
            <svg aria-hidden="true" class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
              <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
            </svg>
            <span class="ml-3">Overview</span>
          </a>
        </li>
        <li>
          <a href="../muzakki/index.php" class="flex items-center p-2 text-base font-normal rounded-lg text-white hover:bg-gray-700 group">
            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white">
              <path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
            </svg>

            <span class="ml-3">Muzakki</span>
          </a>
        </li>
        <li>
          <a href="../kategori-mustahik/index.php" class="flex items-center p-2 text-base font-normal rounded-lg text-white hover:bg-gray-700 group">
            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white">
              <path d="M7 8a3 3 0 100-6 3 3 0 000 6zM14.5 9a2.5 2.5 0 100-5 2.5 2.5 0 000 5zM1.615 16.428a1.224 1.224 0 01-.569-1.175 6.002 6.002 0 0111.908 0c.058.467-.172.92-.57 1.174A9.953 9.953 0 017 18a9.953 9.953 0 01-5.385-1.572zM14.5 16h-.106c.07-.297.088-.611.048-.933a7.47 7.47 0 00-1.588-3.755 4.502 4.502 0 015.874 2.636.818.818 0 01-.36.98A7.465 7.465 0 0114.5 16z" />
            </svg>

            <span class="ml-3">Kategori Mustahik</span>
          </a>
        </li>
        <li>
          <a href="../pengumpulan/index.php" class="flex items-center p-2 text-base font-normal rounded-lg text-white hover:bg-gray-700 group">
            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white">
              <path d="M2 3a1 1 0 00-1 1v1a1 1 0 001 1h16a1 1 0 001-1V4a1 1 0 00-1-1H2z" />
              <path fill-rule="evenodd" d="M2 7.5h16l-.811 7.71a2 2 0 01-1.99 1.79H4.802a2 2 0 01-1.99-1.79L2 7.5zM7 11a1 1 0 011-1h4a1 1 0 110 2H8a1 1 0 01-1-1z" clip-rule="evenodd" />
            </svg>

            <span class="ml-3">Pengumpulan</span>
          </a>
        </li>
        <li>
          <button type="button" class="flex items-center p-2 w-full text-base font-normal rounded-lg transition duration-75 group text-white hover:bg-gray-700" aria-controls="dropdown-distribusi" data-collapse-toggle="dropdown-distribusi">
            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="flex-shrink-0 w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white">
              <path fill-rule="evenodd" d="M14 6a2.5 2.5 0 00-4-3 2.5 2.5 0 00-4 3H3.25C2.56 6 2 6.56 2 7.25v.5C2 8.44 2.56 9 3.25 9h6V6h1.5v3h6C17.44 9 18 8.44 18 7.75v-.5C18 6.56 17.44 6 16.75 6H14zm-1-1.5a1 1 0 01-1 1h-1v-1a1 1 0 112 0zm-6 0a1 1 0 001 1h1v-1a1 1 0 00-2 0z" clip-rule="evenodd" />
              <path d="M9.25 10.5H3v4.75A2.75 2.75 0 005.75 18h3.5v-7.5zM10.75 18v-7.5H17v4.75A2.75 2.75 0 0114.25 18h-3.5z" />
            </svg>
            <span class="flex-1 ml-3 text-left whitespace-nowrap">Distribusi</span>
            <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
          </button>
          <ul id="dropdown-distribusi" class="hidden py-2 space-y-2">
            <li>
              <a href="../distribusi-warga/index.php" class="flex items-center p-2 pl-11 w-full text-base font-normal rounded-lg transition duration-75 group text-white hover:bg-gray-700">Warga</a>
            </li>
            <li>
              <a href="../distribusi-mustahik/index.php" class="flex items-center p-2 pl-11 w-full text-base font-normal rounded-lg transition duration-75 group text-white hover:bg-gray-700">Mustahik</a>
            </li>
          </ul>
        </li>
        <li>
          <button type="button" class="flex items-center p-2 w-full text-base font-normal rounded-lg transition duration-75 group text-white hover:bg-gray-700" aria-controls="dropdown-laporan" data-collapse-toggle="dropdown-laporan">
            <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
            </svg>
            <span class="flex-1 ml-3 text-left whitespace-nowrap">Laporan</span>
            <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
          </button>
          <ul id="dropdown-laporan" class="hidden py-2 space-y-2">
            <li>
              <a href="../laporan-pengumpulan/index.php" target="_blank" rel="noopener noreferrer" class="flex items-center p-2 pl-11 w-full text-base font-normal rounded-lg transition duration-75 group text-white hover:bg-gray-700">Pengumpulan</a>
            </li>
            <li>
              <a href="../laporan-distribusi/index.php" target="_blank" rel="noopener noreferrer" class="flex items-center p-2 pl-11 w-full text-base font-normal rounded-lg transition duration-75 group text-white hover:bg-gray-700">Distribusi</a>
            </li>
          </ul>
        </li>
      </ul>
      <ul class="pt-5 mt-5 space-y-2 border-t border-gray-700">
        <li>
          <a href="../logout.php" class="flex items-center p-2 text-base font-normal rounded-lg transition duration-75 hover:bg-gray-700 text-white group">
            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="flex-shrink-0 w-6 h-6 transition duration-75 text-gray-400 group-hover:text-white">
              <path fill-rule="evenodd" d="M3 4.25A2.25 2.25 0 015.25 2h5.5A2.25 2.25 0 0113 4.25v2a.75.75 0 01-1.5 0v-2a.75.75 0 00-.75-.75h-5.5a.75.75 0 00-.75.75v11.5c0 .414.336.75.75.75h5.5a.75.75 0 00.75-.75v-2a.75.75 0 011.5 0v2A2.25 2.25 0 0110.75 18h-5.5A2.25 2.25 0 013 15.75V4.25z" clip-rule="evenodd" />
              <path fill-rule="evenodd" d="M19 10a.75.75 0 00-.75-.75H8.704l1.048-.943a.75.75 0 10-1.004-1.114l-2.5 2.25a.75.75 0 000 1.114l2.5 2.25a.75.75 0 101.004-1.114l-1.048-.943h9.546A.75.75 0 0019 10z" clip-rule="evenodd" />
            </svg>

            <span class="ml-3">Keluar</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>

  <div class="mt-14 md:ml-64">
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

    <main class="mx-auto p-4">
      <div class="bg-gray-800 relative shadow-md sm:rounded-lg overflow-visible">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
          <div class="w-full md:w-1/2">
            <h1 class="text-xl font-bold leading-tight tracking-tight md:text-2xl text-white mb-4">Pengumpulan Zakat Fitrah</h1>
          </div>
          <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
            <a href="./add.php" class="flex items-center justify-center text-white focus:ring-4 font-medium rounded-lg text-sm px-4 py-2 bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-green-800">
              <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
              </svg>
              Tambahkan data baru
            </a>
          </div>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full text-sm text-left text-gray-400">
            <thead class="text-xs uppercase bg-gray-700 text-gray-400">
              <tr>
                <th scope="col" class="px-4 py-3">Id</th>
                <th scope="col" class="px-4 py-3">Nama Kepala Keluarga</th>
                <th scope="col" class="px-4 py-3">Jumlah Tanggungan</th>
                <th scope="col" class="px-4 py-3">Jenis Bayar</th>
                <th scope="col" class="px-4 py-3">Jumlah Tanggungan yang Dibayar</th>
                <th scope="col" class="px-4 py-3">Bayar Beras</th>
                <th scope="col" class="px-4 py-3">Bayar Uang</th>
                <th scope="col" class="px-4 py-3">
                  <span class="sr-only">Actions</span>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
              $jml_tanggungan = 0;
              $jml_tanggunganyangdibayar = 0;
              $bayar_beras = 0;
              $bayar_uang = 0;
              while ($res = mysqli_fetch_array($result)) {
                $jml_tanggungan += $res['jumlah_tanggungan'];
                $jml_tanggunganyangdibayar += $res['jumlah_tanggunganyangdibayar'];
                $bayar_beras += $res['bayar_beras'];
                $bayar_uang += $res['bayar_uang'];
              ?>
                <tr class="border-b border-gray-700">
                  <td class="px-4 py-3"><?php echo $res['id_zakat'] ?></td>
                  <th scope="row" class="px-4 py-3 font-medium whitespace-nowrap text-white">
                    <?php echo $res['nama_KK'] ?>
                  </th>
                  <td class="px-4 py-3"><?php echo $res['jumlah_tanggungan'] ?></td>
                  <td class="px-4 py-3"><?php if ($res['jenis_bayar'] === "beras") echo "Beras";
                                        else echo "Uang"; ?></td>
                  <td class="px-4 py-3"><?php echo $res['jumlah_tanggunganyangdibayar'] ?></td>
                  <td class="px-4 py-3"><?php if ($res['jenis_bayar'] === "uang") echo "-";
                                        else echo $res['bayar_beras'] . " kg"; ?></td>
                  <td class="px-4 py-3"><?php if ($res['jenis_bayar'] === "beras") echo "-";
                                        else echo "Rp. " . $res['bayar_uang'] ?></td>
                  <td class="px-4 py-3 flex items-center justify-end">
                    <button id="<?php echo $res['id_zakat'] ?>-dropdown-button" data-dropdown-toggle="<?php echo $res['id_zakat'] ?>-dropdown" class="inline-flex items-center p-0.5 text-sm font-medium text-center rounded-lg focus:outline-none text-gray-400 hover:text-gray-100" type="button">
                      <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                      </svg>
                    </button>
                    <div id="<?php echo $res['id_zakat'] ?>-dropdown" class="hidden z-10 w-44 rounded divide-y shadow bg-gray-700 divide-gray-600">
                      <ul class="py-1 text-sm text-gray-200" aria-labelledby="<?php echo $res['id_zakat'] ?>-dropdown-button">
                        <li>
                          <a href="./view.php?id=<?php echo $res['id_zakat'] ?>" class="block py-2 px-4 hover:bg-gray-600 hover:text-white">Tampilkan</a>
                        </li>
                        <li>
                          <a href="./edit.php?id=<?php echo $res['id_zakat'] ?>" class="block py-2 px-4 hover:bg-gray-600 hover:text-white">Edit</a>
                        </li>
                      </ul>
                      <div class="py-1">
                        <a href="./delete.php?id=<?php echo $res['id_zakat'] ?>" class="block py-2 px-4 text-sm hover:bg-gray-600 text-gray-200 hover:text-white">Hapus</a>
                      </div>
                    </div>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
            <tfoot>
              <tr class="border-b border-gray-700">
                <td class="px-4 py-3">Total</td>
                <td class="px-4 py-3 font-medium whitespace-nowrap text-white"><?php echo mysqli_num_rows($result); ?> KK</td>
                <td class="px-4 py-3"><?php echo $jml_tanggungan ?></td>
                <td class="px-4 py-3">-</td>
                <td class="px-4 py-3"><?php echo $jml_tanggunganyangdibayar ?></td>
                <td class="px-4 py-3"><?php echo $bayar_beras ?> kg</td>
                <td class="px-4 py-3">Rp. <?php echo $bayar_uang ?></td>
                <td class="px-4 py-3"></td>
              </tr>
            </tfoot>
          </table>
        </div>
        <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
          <span class="text-sm font-normal text-gray-400">
            Menampilkan
            <span class="font-semibold text-white"><?php echo mysqli_num_rows($result) ?></span> data
          </span>
        </nav>
      </div>
    </main>
  </div>


  <script src="../node_modules/flowbite/dist/flowbite.min.js"></script>
</body>

</html>