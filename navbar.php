<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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
                <a href="admin/index.php"><button class="btn btn-success" type="submit">Login</button></a>
                <form class="d-flex" style="padding-left: 700px;" role="search" method="post" action="">
                    <input class="form-control me-2" type="text" name="keyword" placeholder="Search" aria-label="Search" autocomplete="off" id="keyword">
                    <button class="btn btn-outline-dark text-white me-3" type="submit" name="cari" id="tombol-cari">Search</button>
                </form>
            </ul>

        </div>
    </div>
</nav>