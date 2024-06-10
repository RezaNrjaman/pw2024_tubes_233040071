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
    <nav class="navbar navbar-expand-lg navbar-dark warna1 fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item ms-4 me-4">
                        <a class="nav-link" href="#banner">Home</a>
                    </li>
                    <li class="nav-item ms-4 me-4">
                        <a class="nav-link" href="#kategori">Kategori</a>
                    </li>
                    <li class="nav-item ms-4 me-4">
                        <a class="nav-link" href="#universitas">Universitas</a>
                    </li>
                    <a href="admin/login.php"><button class="btn btn-success" type="submit">Login</button></a>
                    <form class="d-flex" style="padding-left: 700px;" role="search" method="post" action="">
                        <input class="form-control me-2" type="text" name="keyword" placeholder="Search" aria-label="Search" autocomplete="off" id="keyword">
                        <button class="btn btn-outline-dark text-white me-3" type="submit" name="cari" id="tombol-cari">Search</button>
                    </form>
                </ul>

            </div>
        </div>
    </nav>
    <!-- banner -->
    <div class="container-fluid banner d-flex align-items-center" id="banner" style="background-size: cover; min-height: 100vh;">
        <div class="container text-center text-white">
            <h1>Universitas Jawa Barat</h1>
            <h3>Mau Cari Universitas Mana?</h3>
        </div>
    </div>

    <!-- highligt -->
    <div class="container-fluid py-5 warna3" id="kategori">
        <div class="container mt-5 text-center">
            <h2>KATEGORI</h2>
            <div class="row mt-5 mb-5 justify-content-around">
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
        <div class="container" id="container">
            <div class="container mt-5 text-center">
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
    </div>



    <!-- Footer -->
    <footer class="text-white text-center pt-3 pb-4" style="background-color: #1a4d2e">
        <p>Created by <a href="https://www.instagram.com/reza.nrjaman/" class="text-white fw-bold" target="_blank">Reza Nurjaman</a></p>
    </footer>
    <!-- Akhir Footer -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/796f8abcad.js" crossorigin="anonymous"></script>


    <script>
        var keyword = document.getElementById("keyword");
        var tombolCari = document.getElementById("tombol-cari");
        var container = document.getElementById("container");

        keyword.addEventListener("keyup", function() {
            var xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    container.innerHTML = xhr.responseText;
                }
            };

            xhr.open("GET", "ajax/index2.php?keyword=" + keyword.value, true);
            xhr.send();
        });
    </script>

</body>

</html>