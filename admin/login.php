<?php
session_start();
require "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

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
                <div>
                    <a href="registrasi.php"><button class="btn btn-success form-control" type="submit" name="registrasibtn" style="margin-top: 10px;">Registrasi</button></a>
                </div>

            </form>
        </div>
        <div class="mt-3" style="width: 500px;">
            <?php
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
                        header('location: universitas.php');
                    } else {
            ?>
                        <div class="alert alert-warning" role="alert">
                            Password salah
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <div class="alert alert-warning" role="alert">
                        Akun tidak tersedia
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</body>

</html>