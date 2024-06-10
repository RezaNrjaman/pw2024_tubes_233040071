<?php
require "session.php";
require "../koneksi.php";

$id = $_GET['p'];

$query = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM universitas a JOIN kategori b ON a.kategori_id=b.id WHERE a.id='$id'");
$data = mysqli_fetch_array($query);

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori WHERE id!=$data[kategori_id]");

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
    <title>Universitas Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;400&family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet" />
</head>
<style>
    form div {
        margin-bottom: 10px;
    }
</style>

<body>
    <?php require "navbar.php"; ?>
    <div class="container pt-5 mt-5">
        <h2><a href="universitas.php"><i class="fa-solid fa-backward" style="margin-right: 25px; color:black;"></i></a>Detail Universitas</h2>

        <div class="col-12 col-md-6">
            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" value="<?php echo $data['nama']; ?>" class="form-control" autocomplete="off" required>
                </div>
                <div>
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control" required>
                        <option value="<?php echo $data['kategori_id']; ?>"><?php echo $data['nama_kategori']; ?></option>
                        <?php
                        while ($dataKategori = mysqli_fetch_array($queryKategori)) {
                        ?>
                            <option value="<?php echo $dataKategori['id'] ?>"> <?php echo $dataKategori['nama']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="jumlah_fakultas">Jumlah Fakultas</label>
                    <input type="number" id="jumlah_fakultas" name="jumlah_fakultas" value="<?php echo $data['jumlah']; ?>" class=" form-control" autocomplete="off" required>
                </div>
                <div>
                    <label for="currentfoto">Foto Universitas Sekarang</label>
                    <img src="../image/<?php echo $data['foto']; ?>" alt="" width="300px">
                </div>
                <div>
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto" value="<?php echo $data['foto']; ?>" class=" form-control">
                </div>
                <div class="mt-3 justify-content-between">
                    <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
                    <button class="btn btn-danger" type="submit" name="hapus">Hapus</button>
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
                    $queryUpdate = mysqli_query($conn, "UPDATE universitas SET kategori_id='$kategori', nama='$nama', jumlah='$jumlah' WHERE id=$id");

                    if ($nama_file != '') {
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

                                $queryUpdate = mysqli_query($conn, "UPDATE universitas SET foto='$new_name' WHERE id='$id'");

                                if ($queryUpdate) {
                                ?>
                                    <div class="alert alert-primary mt-3" role="alert">
                                        Universitas Berhasil Diupdate
                                    </div>
                                    <meta http-equiv="refresh" content="2; url=universitas.php" />
                    <?php
                                } else {
                                    echo mysqli_error($conn);
                                }
                            }
                        }
                    }
                }
            }

            if (isset($_POST['hapus'])) {
                $queryHapus = mysqli_query($conn, "DELETE FROM universitas WHERE id='$id'");

                if ($queryHapus) {
                    ?>
                    <div class="alert alert-primary mt-3" role="alert">
                        Universitas berhasil dihapus
                    </div>
                    <meta http-equiv="refresh" content="2; url=universitas.php" />

            <?php
                }
            }
            ?>
        </div>
    </div>
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/796f8abcad.js" crossorigin="anonymous"></script>
</body>

</html>