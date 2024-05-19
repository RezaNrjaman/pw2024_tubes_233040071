<?php
$conn = mysqli_connect('localhost', 'root', '', 'pw2024_tubes_233040071');

// check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
