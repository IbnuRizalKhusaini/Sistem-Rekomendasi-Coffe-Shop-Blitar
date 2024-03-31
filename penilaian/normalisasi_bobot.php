<?php
require_once '../layout/_top.php';
require_once '../helper/connection.php';


$criteria = mysqli_query($connection, "SELECT * FROM criterias");

$weight_sum = 0; // Initialize sum variable

// Calculate the total weight sum
while ($data = mysqli_fetch_array($criteria)) {
    $weight_sum += $data['weight'];
}

// Reset criteria query pointer
mysqli_data_seek($criteria, 0);

?>

<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>Normalisasi Bobot Kriteria</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped w-100" id="table-1">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Kriteria</th>
                                    <th>Bobot</th>
                                    <th>Kategori</th>
                                    <th>Normalisasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($data = mysqli_fetch_array($criteria)) :
                                    // Calculate normalized weight
                                    $normalized_weight = $data['weight'] / $weight_sum;
                                ?>
                                    <tr class="text-center">
                                        <td><?= $no ?></td>
                                        <td><?= $data['name'] ?></td>
                                        <td><?= $data['weight'] ?></td>
                                        <td class="text-uppercase"><?= $data['categories'] ?></td>
                                        <td><?= number_format($normalized_weight, 3) ?></td>
                                    </tr>
                                <?php
                                    $no++;
                                endwhile;
                                ?>
                            </tbody>
                        </table>
                        <p>Total Bobot : <?= $weight_sum ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
require_once '../layout/_bottom.php';
?>
<!-- Page Specific JS File -->
<?php
if (isset($_SESSION['info'])) :
    if ($_SESSION['info']['status'] == 'success') {
?>
        <script>
            iziToast.success({
                title: 'Sukses',
                message: `<?= $_SESSION['info']['message'] ?>`,
                position: 'topCenter',
                timeout: 5000
            });
        </script>
    <?php
    } else {
    ?>
        <script>
            iziToast.error({
                title: 'Gagal',
                message: `<?= $_SESSION['info']['message'] ?>`,
                timeout: 5000,
                position: 'topCenter'
            });
        </script>
<?php
    }

    unset($_SESSION['info']);
    $_SESSION['info'] = null;
endif;
?>
