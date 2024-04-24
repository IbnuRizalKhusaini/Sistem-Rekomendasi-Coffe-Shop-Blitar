<?php
require_once '../helper/get_user_role.php';
$role = getUserRole($connection);
?>

<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="index.php">
        <img src="../assets/icon-login.png" alt="logo" width="50">
      </a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.php">>></a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      <li><a class="nav-link" href="../dashboard/index.php"><i class="fas fa-home"></i> <span>Home</span></a></li>
      <li class="menu-header">Main Feature</li>
      <li><a class="nav-link" href="../alternatif/index.php"><i class="fas fa-lock"></i> <span>Alternatif</span></a></li>
      <li><a class="nav-link" href="../kriteria/index.php"><i class="fas fa-lock"></i> <span>Kriteria</span></a></li>
      <?php if ($role !== 1) : ?>
        <li><a class="nav-link" href="../bobot/index.php"><i class="fas fa-pencil"></i> <span>Bobot Kriteria</span></a></li>
        <li><a class="nav-link" href="../penilaian/matriks.php"><i class="fas fa-pencil"></i><span>Input Nilai</span></a></li>
      <?php endif; ?>
      <?php if ($role !== 1) : ?>
        <li class="dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Penilaian</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="../penilaian/normalisasi_bobot.php">Normalisasi Bobot</a></li>
            <li><a class="nav-link" href="../penilaian/matriks_normalisasi.php">Matriks Ternormalisasi</a></li>
            <li><a class="nav-link" href="../penilaian/matriks_ideal.php">Matriks Ideal +/-</a></li>
            <li><a class="nav-link" href="../penilaian/jarak_solusi.php">Jarak Solusi Ideal +/-</a></li>
            <li><a class="nav-link" href="../penilaian/hasil_hitung.php">Hasil Hitung</a></li>
          </ul>
        </li>
      <?php endif; ?>
    </ul>
  </aside>
</div>