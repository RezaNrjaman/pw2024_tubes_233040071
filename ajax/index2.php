<?php
require '../koneksi.php';
$keyword = $_GET["keyword"];


$queryUniversitas = "SELECT u.*, k.nama AS nama_kategori
          FROM universitas u
          JOIN kategori k ON u.kategori_id = k.id
          WHERE u.nama LIKE '%$keyword%'";

$result = mysqli_query($conn, $queryUniversitas);

?>
<link rel="stylesheet" href="../css/style.css">

<div class="container-fluid py-5 warna3" id="universitas">
    <div class="container" id="container">
        <div class="container mt-5 text-center">
            <h3>UNIVERSITAS</h3>
            <div class="row mt-5">
                <?php
                while ($data = mysqli_fetch_array($result)) {
                ?>
                    <div class="col-sm-6 col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="image-box">
                                <img src="../image/<?php echo $data['foto']; ?>" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"> <?php echo $data['nama']; ?></h5>
                                <p class="card-text text-jumlah">Jumlah Fakultas : <?php echo $data['jumlah']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>