<?php
session_start();
require "../koneksi.php";


if (isset($_POST['loginbtn'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);


    $query = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
    $countdata = mysqli_num_rows($query);
    $data = mysqli_fetch_array($query);


    if ($countdata > 0) {
        if (password_verify($password, $data['password'])) {
            $_SESSION['username'] = $data['username'];
            $_SESSION['login'] = true;
            header('Location: universitas.php');
            exit();
        } else {
            $error_message = "Password salah";
        }
    } else {
        $error_message = "Akun tidak tersedia";
    }
}
?>


<!DOCTYPE html>
<html lang="id">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<style>
    .main {
        height: 100vh;
        background-color: #198754;
    }


    .login-box {
        width: 500px;
        height: 300px;
        box-sizing: border-box;
        color: #198754;
        background-color: whitesmoke;
        border-radius: 10px;
    }
</style>


<body>
    <div class="main d-flex flex-column justify-content-center align-items-center">
        <h3 style="color: white;"><a href="../index.php"><i class="fa-solid fa-backward" style="margin-right: 25px; color:white;"></i></a>LOGIN UNTUK ADMIN</h3>
        <div class="login-box p-5 shadow">
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
                    <button class="btn btn-success form-control" type="submit" name="loginbtn" style="margin-top: 10px;">Login</button>
                </div>
            </form>
            <p>Belum punya akun? <a href="registrasi.php">Daftar</a></p>
        </div>
        <div class="mt-3" style="width: 500px;">
            <?php
            if (isset($error_message)) {
                echo "<div class='alert alert-warning' role='alert'>$error_message</div>";
            }
            ?>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/796f8abcad.js" crossorigin="anonymous"></script>
</body>


</html>