<?php
require '../admin/function.php';
$keyword = $_GET['keyword'];

$query = "SELECT u.*, k.nama AS nama_kategori
          FROM universitas u
          JOIN kategori k ON u.kategori_id = k.id
          WHERE u.nama LIKE '%$keyword%'";
$universitas = query($query);
$jumlahUniversitas = count($universitas);
?>
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
                <td colspan="5" class="text-center">Data tidak ditemukan</td>
            </tr>
            <?php
        } else {
            $jumlah = 1;
            foreach ($universitas as $data) {
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