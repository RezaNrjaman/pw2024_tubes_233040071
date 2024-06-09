<?php
require "session.php";
require "../koneksi.php";

$querykategori = mysqli_query($conn, "SELECT * FROM kategori");
$jumlahkategori = mysqli_num_rows($querykategori);

$queryuniversitas = mysqli_query($conn, "SELECT * FROM universitas");
$jumlahuniversitas = mysqli_num_rows($queryuniversitas);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;400&family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet" />

</head>

<style>
    .kotak {
        border: solid;
    }

    .summary-kategori {
        border-radius: 15px;

    }

    .no-decoration {
        text-decoration: none;
    }

    .no-decoration:hover {
        color: brown;
        text-decoration: dashed;
    }
</style>

<body>
    <?php require "navbar.php"; ?>

    <div class="container mt-5">
        <nav aria-label="breadcrumb" class="pt-5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fa-solid fa-house" style="color: #26cf3a;"></i>Home
                </li>
            </ol>
        </nav>
        <h2>Halo <?php echo $_SESSION['username']; ?> </h2>

        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12 mb-3 ">
                    <div class="summary-kategori p-3 bg-success">
                        <div class="row">
                            <div class="col-6">
                                <i class="fa-solid fa-building-columns fa-6x mt-3" style="color: #f0f2f5; margin-left:25px;"></i>
                            </div>
                            <div class="col-6 text-white">
                                <h3 class="fs-2">Universitas</h3>
                                <p class="fs-4"><?php echo $jumlahuniversitas; ?> Universitas</p>
                                <p><a href="universitas.php" class="text-white no-decoration">Lihat Detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/796f8abcad.js" crossorigin="anonymous"></script>
</body>


</html>