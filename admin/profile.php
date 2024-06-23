<?php
session_start();
require_once 'service/koneksidb.php';
include_once 'controller/Sessionislogin.php';
require_once 'model/Definition.php';
include 'sidebar.php';

$id = $_SESSION['idus'];
$username = $_SESSION["username"];
$password = $_SESSION["password"];
$nama = $_SESSION["namaus"];
$email = $_SESSION["emailus"];
$notlp = $_SESSION["notlpus"];
$jk = $_SESSION["jkus"];



//edit data
if (isset($_POST['Update'])) {
    $id       = $_POST['id'];
    $username     =  $_POST['username'];
    $password         =  $_POST['password'];
    $email       = $_POST['email'];
    $notlp     =  $_POST['notlp'];
    $jk         =  $_POST['jk'];

    $sqlup = "  UPDATE us SET 
                username = '$username',
                password = '$password',
                Nama = '$nama',
                Email = '$email',
                No_Tlp = '$notlp',
                Jk = '$jk'
                WHERE  id= '$id'";

    $qup = mysqli_query($db, $sqlup);
    if ($qup) {
        $sukses = "Berhasil Mengupdate data";
    } else {
        $error = "Gagal Update data ";
    }
}

?>
<br>
<div class="card">
    <h5 class="card-header">Profil Pengguna</h5>
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
        <table>
            <tr>
                <td>
                    <p class="card-text">ID</p>
                </td>
                <td> : <?= $id ?></td>
            </tr>
            <tr>
                <td>
                    <p class="card-text">Username</p>
                </td>
                <td> : <?= $username ?></td>
            </tr>
            <tr>
                <td>
                    <p class="card-text">Nama </p>
                </td>
                <td> : <?= $nama; ?></td>
            </tr>
            <tr>
                <td>
                    <p class="card-text">No Hp</p>
                </td>
                <td> : <?= $notlp; ?></td>
            </tr>
            <tr>
                <td>
                    <p class="card-text">Email</p>
                </td>
                <td> : <?= $email ?></td>
            </tr>
            <tr>
                <td>
                    <p class="card-text">Jenis Kelamin</p>
                </td>
                <td> : <?= $jk ?></td>
            </tr>
        </table>
        <br><br><br><br><br><br>
        <?php
        // $sql2 = "SELECT * FROM us";
        // $q2 = mysqli_query($db, $sql2);
        // $urut = 1;
        // while ($r2 = mysqli_fetch_array($q2)) {
        //     $id       = $r2['id'];
        //     $username        = $r2['username'];
        //     $password        = $r2['password'];
        //     $nama        = $r2['Nama'];
        //     $email        = $r2['Email'];
        //     $notlp        = $r2['No_Tlp'];
        //     $jk        = $r2['Jk'];
        // }
        ?>

        <!-- tambah -->
        <button type="button-end" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit">
            Edit
        </button>


        <!-- Modal -->
        <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Update Akun ID <?= $id ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control-plaintext" hidden id="id" name="id" readonly required value="<?= $id ?>">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" required value="<?= $username ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="text" class="form-control" id="password" name="password" required value="<?= $password ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" required value="<?= $nama ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required value="<?= $email ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="notlp" class="form-label">No Hp</label>
                                        <input type="text" class="form-control" id="notlp" name="notlp" required value="<?= $notlp ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="jk" class="form-label">Jenis Kelamin</label>
                                        <select class="form-select" id="jk" name="jk" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="L" <?= $jk == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                            <option value="P" <?= $jk == 'P' ? 'selected' : '' ?>>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
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



        <?php
        include 'sidebar2.php';
        ?>