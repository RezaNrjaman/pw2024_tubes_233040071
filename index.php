<?php
require_once 'koneksi.php';
$queryUniversitas = mysqli_query($conn, "SELECT id, nama, jumlah, foto FROM universitas");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Universitas Jawa Barat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;400&family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <?php require "navbar.php"; ?>
    <!-- banner -->
    <div class="container-fluid banner d-flex align-items-center" id="banner">
        <div class="container text-center text-white">
            <h1>Universitas Jawa Barat</h1>
            <h3>Mau Cari Universitas Mana?</h3>
            <div class="col-md-8 offset-md-2">
                <form action="universitas.php" method="get">
                    <div class="input-group input-group-lg my-4">
                        <input type="text" class="form-control" placeholder="Nama Universitas" aria-label="Nama Universitas" aria-describedby="basic-addon2" name="keyword">
                        <button type="submit" class="btn" style="background-color: #e8dfca;">Telusuri</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- highligt -->
    <div class="container-fluid py-5 warna3" id="kategori">
        <div class="container text-center">
            <h3>KATEGORI</h3>

            <div class="row mt-5 justify-content-around">
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-negeri d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="negeri.php">Universitas Negeri</a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-swasta d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="swasta.php">Universitas Swasta</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- univ -->
    <div class="container-fluid py-5 warna3" id="universitas">
        <div class="container text-center">
            <h3>UNIVERSITAS</h3>
            <div class="row mt-5">
                <?php
                while ($data = mysqli_fetch_array($queryUniversitas)) {
                ?>
                    <div class="col-sm-6 col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="image-box">
                                <img src="image/<?php echo $data['foto']; ?>" class="card-img-top" alt="...">
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

    <!-- Footer -->
    <footer class="text-white text-center pt-3 pb-4" style="background-color: #1a4d2e">
        <p>Created by <a href="https://www.instagram.com/reza.nrjaman/" class="text-white fw-bold">Reza Nurjaman</a></p>
    </footer>
    <!-- Akhir Footer -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/796f8abcad.js" crossorigin="anonymous"></script>

</body>

</html>