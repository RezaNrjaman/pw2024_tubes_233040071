<?php
require "session.php";
require "../koneksi.php";

$query = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM universitas a JOIN kategori b ON a.kategori_id=b.id");
$jumlahUniversitas = mysqli_num_rows($query);

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");

function generateRandomString($length = 20)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLenght = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLenght - 1)];
    }
    return $randomString;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;400&family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet" />

</head>

<style>
    .no-decoration {
        text-decoration: none;
    }

    form div {
        margin-bottom: 10px;
    }
</style>

<body>
    <?php require "navbar.php"; ?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="../admin" class="no-decoration" style="color: #26cf3a;">
                        <i class="fa-solid fa-house" style="color: #1A4D2E;"></i>Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Universitas
                </li>
            </ol>
        </nav>

        <div class="my-5 col-12 col-md-6">
            <h3>Tambah Universitas</h3>

            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" class="form-control" autocomplete="off" required>
                </div>
                <div>
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control" required>
                        <option value="">Pilih Satu</option>
                        <?php
                        while ($data = mysqli_fetch_array($queryKategori)) {
                        ?>
                            <option value="<?php echo $data['id'] ?>"> <?php echo $data['nama']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="jumlah_fakultas">Jumlah Fakultas</label>
                    <input type="number" id="jumlah_fakultas" name="jumlah_fakultas" class="form-control" autocomplete="off" required>
                </div>
                <div>
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control" required>
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary" type="submit" name="simpan" href="admin/index.php">Simpan</button>
                </div>
            </form>

            <?php
            if (isset($_POST['simpan'])) {
                $nama = htmlspecialchars($_POST['nama']);
                $kategori = htmlspecialchars($_POST['kategori']);
                $jumlah = htmlspecialchars($_POST['jumlah_fakultas']);

                $target_dir = "../image/";
                $nama_file = basename($_FILES["foto"]["name"]);
                $target_file = $target_dir . $nama_file;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $image_size = $_FILES["foto"]["size"];
                $random_name = generateRandomString(20);
                $new_name = $random_name . "." . $imageFileType;

                if ($nama == '' || $kategori == '' || $jumlah == '') {

            ?>
                    <div class="alert alert-warning mt-3" role="alert">
                        Nama, kategori, jumlah fakultas, dan foto wajib diisi
                    </div>

                    <?php
                } else {
                    if ($nama_file != "") {
                        if ($image_size > 5000000) {
                    ?>
                            <div class="alert alert-warning mt-3" role="alert">
                                File tidak boleh lebih dari 5mb
                            </div>
                            <?php
                        } else {
                            if ($imageFileType != 'jpg' && $imageFileType != "jpeg" && $imageFileType != "png") {
                            ?>
                                <div class="alert alert-warning mt-3" role="alert">
                                    File wajib bertipe jpg, jpeg, atau png
                                </div>
                        <?php
                            } else {
                                move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name);
                            }
                        }
                    }

                    // query insert to pruduct table
                    $queryTambah = mysqli_query($conn, "INSERT INTO universitas (kategori_id, foto, nama, jumlah) VALUES ('$kategori', '$new_name', '$nama', $jumlah)");

                    if ($queryTambah) {
                        ?>
                        <div class="alert alert-primary mt-3" role="alert">
                            Universitas berhasil ditambah
                        </div>
                        <meta http-equiv="refresh" content="2; url=universitas.php />
            <?php
                    } else {
                        echo mysqli_error($conn);
                    }
                }
            }
            ?>


        </div>
        <?php
        if (isset($_POST['simpan_kategori'])) {
            $universitas = htmlspecialchars($_POST['universitas']);

            $queryExist = mysqli_query($conn, "SELECT nama FROM universitas WHERE nama='universitas'");
            $jumlasDataUniversitasBaru = mysqli_num_rows($queryExist);
        }
        ?>



        <div class=" my-5 col-12 col-md-6">
        </div>
        <h2>List Universitas</h2>
        <div class="table-responsive mt-5 mb-5">
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Jumlah Fakultas</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($jumlahUniversitas == 0) {
                    ?>
                        <tr>
                            <td colspan=6 class="text-center">Data kategori tidak tersedia</td>
                        </tr>
                        <?php
                    } else {
                        $jumlah = 1;
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td><?php echo $jumlah; ?></td>
                                <td><?php echo $data['nama']; ?></td>
                                <td><?php echo $data['nama_kategori']; ?></td>
                                <td><?php echo $data['jumlah']; ?></td>
                                <td>
                                    <a href="universitas-detail.php?p=<?php echo $data['id']; ?>" class="btn btn-info"><i class="fas fa-search"></i></a>
                                </td>
                            </tr>
                    <?php
                            $jumlah++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>




    </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/796f8abcad.js" crossorigin="anonymous"></script>
</body>

</html>