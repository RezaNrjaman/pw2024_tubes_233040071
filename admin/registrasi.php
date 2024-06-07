<?php
require 'function.php';

if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
                alert('user baru berhasil ditambahkan!');
                document.location.href = 'login.php'
              </script>";
    } else {
        echo mysqli_error($conn);
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<style>
    .main {
        height: 100vh;
        background-color: #198754;
    }

    .register-box {
        width: 500px;
        height: 300px;
        box-sizing: border-box;
        color: #198754;
        background-color: whitesmoke;
        border-radius: 10px;

    }
</style>
</head>

<body>
    <div class="main d-flex flex-column justify-content-center align-items-center">

        <h3 style="color: white;"><a href="login.php"><i class="fa-solid fa-backward" style="margin-right: 25px; color:white;"></i></a>REGISTRASI ADMIN</h3>
        <div class="register-box py-4 px-5 shadow">
            <form action="" method="post">
                <div>
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username"></input>
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password"></input>
                </div>
                <div>
                    <label for="password2">Konfirmasi Password</label>
                    <input type="password" class="form-control" name="password2" id="password2"></input>
                </div>
                <div>
                    <button type="submit" class="btn btn-success form-control" name="register" style="margin-top: 20px;">Register</button>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
                <script src="https://kit.fontawesome.com/796f8abcad.js" crossorigin="anonymous"></script>
</body>

</html>