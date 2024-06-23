<?php
session_start();
require_once 'service/koneksidb.php';
require_once 'controller/Sessionislogin.php';
require_once 'model/Definition.php';
//hapusdata
if (isset($_POST['Delete'])) {
    $kdtreatment       = $_POST['kdtreatment'];
    try {
        $sqldel = "DELETE FROM ttreatment WHERE kdtreatment='$kdtreatment'";
        $qdel = mysqli_query($db, $sqldel);
        if ($qdel) {
            $sukses = "Berhasil Menghapus data";
        } else {
            $error = "Gagal hapus data ";
        }
    } catch (Exception $e) {
        $error = 'Ada data yang digunakan dalamtabel tbooking';
    }
}

//edit data
if (isset($_POST['Update'])) {
    $kdtreatment       = $_POST['kdtreatment'];
    $treatment         =  $_POST['treatment'];

    $sqlup = "  UPDATE ttreatment SET 
                treatment = '$treatment'
                WHERE  kdtreatment= '$kdtreatment'";

    $qup = mysqli_query($db, $sqlup);
    if ($qup) {
        $sukses = "Berhasil Mengupdate data";
    } else {
        $error = "Gagal Update data ";
    }
}

//insertdata
if (isset($_POST['Tambah'])) {
    $treatment         =  $_POST['treatment'];
    if ($treatment) {
        $sql = "INSERT INTO ttreatment(treatment) VALUES('$treatment')";
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
<h1 class="text-center">Treatment</h1>
<br>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Data Table Treatment
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
                    <th>Kdtreatment</th>
                    <th>Treatment</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql2 = "SELECT * FROM ttreatment
                ORDER BY 
                kdtreatment ASC";
                $q2 = mysqli_query($db, $sql2);
                $urut = 1;
                while ($r2 = mysqli_fetch_array($q2)) {
                    $kdtreatment       = $r2['kdtreatment'];
                    $treatment        = $r2['treatment'];
                ?>
                    <tr>
                        <th scope="row"><?= $urut++ ?></th>
                        <td scope="row">tr<?= $kdtreatment ?></td>
                        <td scope="row"><?= $treatment ?></td>
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
                                            Delete : <?= $kdtreatment ?> - <?= $treatment ?>
                                            <!-- Mengambil data primary key untuk ubah -->
                                            <input name="kdtreatment" type="hidden" value="<?= $kdtreatment ?>">
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
                                            <label for="kdtreatment" class="col-sm-2 col-form-label">ID</label>
                                            <div class="col-sm-10">
                                                <input type="text" readonly class="form-control-plaintext" name="kdtreatment" value="<?= $kdtreatment; ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="treatment" class="col-sm-2 col-form-label">Nama Treatment</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="treatment" name="treatment" value="<?= $treatment ?>">
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
                                <label for="treatment" class="col-sm-3 col-form-label">Nama Treatment</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="treatment" name="treatment">
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