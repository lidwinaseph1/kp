<?php
session_start();
require_once 'service/koneksidb.php';
require_once 'controller/Sessionislogin.php';
require_once 'model/Definition.php';




//hapusdata
if (isset($_POST['Delete'])) {
    $kdprice       = $_POST['kdprice'];
    try {
        $sqldel = "DELETE FROM tprice WHERE kdprice='$kdprice'";
        $qdel = mysqli_query($db, $sqldel);
        if ($qdel) {
            $sukses = "Berhasil Menghapus data";
        } else {
            $error = "Gagal hapus data ";
        }
    } catch (Exception $e) {
        $error = 'Ada data yang digunakan dalam tabel Lain';
    }
}

//edit data
if (isset($_POST['Update'])) {
    $kdprice       = $_POST['kdprice'];
    $namaprice         =  $_POST['namaprice'];
    $harga         =  $_POST['harga'];


    $sqlup = "  UPDATE tprice SET 
                namaprice = '$namaprice',
                harga = '$harga'
                WHERE  kdprice= '$kdprice'";

    $qup = mysqli_query($db, $sqlup);
    if ($qup) {
        $sukses = "Berhasil Mengupdate data";
    } else {
        $error = "Gagal Update data ";
    }
}

//insertdata
if (isset($_POST['Tambah'])) {
    $namaprice         =  $_POST['namaprice'];
    $harga         =  $_POST['harga'];
    if ($namaprice && $harga) {
        $sql = "INSERT INTO tprice(namaprice,harga) VALUES('$namaprice','$harga')";
        $result = mysqli_query($db, $sql);
        if ($result) {
            $sukses = 'Berhasil Memasukkan Data Baru';
        } else {
            $error = 'Gagal Memasukkan Data baru';
        }
    } else {
        $error = 'Lengkapi Semua data';
    }
}


//include sidebar
require_once 'sidebar.php';



?>

<br>
<h1 class="text-center">Price List</h1>
<br>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Data Table Price
    </div>
    <div class="card-body">
        <?php //peringatan error
        if ($error) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $error ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        ?>
        <?php //peringatan error
        if ($sukses) {
        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $sukses ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        ?>
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Jasa</th>
                    <th>Harga</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql2 = "SELECT * FROM tprice
                ORDER BY 
                kdprice ASC";
                $q2 = mysqli_query($db, $sql2);
                $urut = 1;
                while ($r2 = mysqli_fetch_array($q2)) {
                    $kdprice       = $r2['kdprice'];
                    $namaprice        = $r2['namaprice'];
                    $harga        = $r2['harga'];
                ?>
                    <tr>
                        <th scope="row"><?= $urut++ ?></th>
                        <td scope="row"><?= $namaprice ?></td>
                        <td scope="row"><?= $harga ?></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <button type="button" class="btn btn-info me-2" data-bs-toggle="modal" data-bs-target="#edit<?= $urut ?>"><i class="fas fa-edit"></i></button>
                                <button type="button" class="btn btn-danger me-2" data-bs-toggle="modal" data-bs-target="#delete<?= $urut ?>"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>

                    <!-- Delete -->
                    <div class="modal" id="delete<?= $urut ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Apakah anda ingin menghapus Data ini?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="post" action="">
                                    <div class="modal-body">
                                        <h5 class="text-start text-danger">
                                            Delete : <?= $namaprice ?> - Rp.<?= $harga ?>
                                            <!-- Mengambil data primary key untuk ubah -->
                                            <input name="kdprice" type="hidden" value="<?= $kdprice ?>">
                                        </h5>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary text-bg-danger" name="Delete"><i class="fas fa-trash"></i> Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Delete -->

                    <!-- edit -->
                    <div class="modal fade" id="edit<?= $urut ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="post" action="">
                                    <div class="modal-body">
                                        <div class="mb-3 row">
                                            <label for="kdprice" class="col-sm-2 col-form-label">ID</label>
                                            <div class="col-sm-10">
                                                <input type="text" readonly class="form-control-plaintext" name="kdprice" value="<?= $kdprice; ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="namaprice" class="col-sm-2 col-form-label">Nama Jasa</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="namaprice" name="namaprice" value="<?= $namaprice ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="harga" name="harga" value="<?= $harga ?>">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="Update">Simpan Perubahan</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- akhir edit-->
                <?php
                }
                ?>
            </tbody>
        </table>
        <!-- buattontambah -->
        <button type="button-end" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">
            Tambah
        </button>
        <!-- Tambah -->
        <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="">
                        <div class="modal-body">
                            <div class="mb-3 row">
                                <label for="namaprice" class="col-sm-3 col-form-label">Nama Jasa</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="namaprice" name="namaprice">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="harga" class="col-sm-3 col-form-label">Harga</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="harga" name="harga">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="Tambah">Insert Data</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php

require_once 'sidebar2.php';
?>