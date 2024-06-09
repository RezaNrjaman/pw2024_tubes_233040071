<?php
$conn = mysqli_connect('localhost', 'root', '', 'pw2024_tubes_233040071');



function query($sql)
{
    $conn = mysqli_connect('localhost', 'root', '', 'pw2024_tubes_233040071');

    $result = mysqli_query($conn, $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    };
    return $rows;
}
// check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}


function registrasi($data)
{
    $conn = mysqli_connect('localhost', 'root', '', 'pw2024_tubes_233040071');

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "INSERT INTO user VALUES (NULL, '$username', '$password' )");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
        alert('username sudah digunakan!');
        </script>";
        return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
        alert('konfirmasi password tidak sesuai!');
        </script>";
        return false;
    }
    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan user baru ke database
    mysqli_query($conn, "INSERT INTO user VALUES(NULL, '$username', '$password')");

    return mysqli_affected_rows($conn);
}
