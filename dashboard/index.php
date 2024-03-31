<?php
require_once '../layout/_top.php';
require_once '../helper/connection.php';

$alternatives = mysqli_query($connection, "SELECT COUNT(*) FROM alternatives");
$criterias = mysqli_query($connection, "SELECT COUNT(*) FROM criterias");

$total_alternatives = mysqli_fetch_array($alternatives)[0];
$total_criterias = mysqli_fetch_array($criterias)[0];
?>

<section class="section">
  <div class="section-header">
    <h1>Dashboard</h1>
  </div>
  <div>
    <center><h3>Selamat Datang di Sistem Rekomendasi Coffee Shop (SIRECOSHOP)</h3></center>
  </div><br>
  <div class="column">
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="far fa-solid fa-shop"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Alternatif</h4>
            </div>
            <div class="card-body">
              <?= $total_alternatives ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-danger">
            <i class="far fa-user"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Kriteria</h4>
            </div>
            <div class="card-body">
              <?= $total_criterias ?>
            </div>
          </div>
        </div>
      </div>
      <div class="card card-statistic-1">
        <div class="col-12">
          <div class="panel-body">
            <p class="text-justify">Sistem Rekomendasi adalah sistem yang dirancang untuk memprediksi suatu item yang sesuai dengan minat user, yang mana item tersebut akan direkomendasikan pada user. Sistem rekomendasi ini dibuat dengan tujuan mempermudah user untuk menyeleksi kafe atau coffee shop dengan perhitungan yang dibuat sedemikian rupa menggunakan kombinasi metode SMART dan TOPSIS. Semoga dengan adanya sistem rekomendasi ini akan mempermudah anda untuk memilih coffee shop yang terbaik sesuai dengan preferensi kalian masing-masing.</p>
            <p>Langkah penggunaan sistem rekomendasi coffee shop :</p>
            <ul class="text-justify">
              <li>Bobot kriteria adalah skor yang diberikan pada tiap kriteria keputusan, sehingga dapat menggambarkan tinggi atau rendahnya kepentingan terhadap kriteria tersebut dalam langkah pengambilan keputusan.</li>
              <li>Pada Halaman input nilai pada Tab "Penilaian", anda akan diminta untuk memasukkan nilai setiap kriteria pada setiap Kafe sesuai dengan keinginan anda. Nilai ini merupakan angka dari rentang 1-5 untuk menilai setiap kriteria seberapa penting kriteria tersebut pada kafe yang terpilih.</li>
              <li>Jika sudah melewati langkah diatas, anda akan melihat hasil rekomendasi yang telah melewati perhitungan menggunakan kombinasi metode SMART dan TOPSIS. Hasil Rekomendasi serta perhitungannya bisa anda lihat secara detail di menu "Hasil Perhitungan". Setiap coffee shop memiliki detail informasi, jika anda ingin melihat informasi lebih lanjut mengenai coffee shop tersebut, anda bisa langsung klik "Lihat Detail" pada kolom paling kanan.</li>
            </ul>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</section>

<?php
require_once '../layout/_bottom.php';
?>