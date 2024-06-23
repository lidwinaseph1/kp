<?php
session_start();
require_once 'service/koneksidb.php';
require_once 'controller/Sessionislogin.php';
require_once 'model/Definition.php';

//hapusdata
if (isset($_POST['Delete'])) {
    $kdtransaksi = $_POST['kdtransaksi'];
    $kdbook = $_POST['kdbook'];
    try {
        $sqldel = "DELETE FROM ttransaksi WHERE kdtransaksi='$kdtransaksi'";
        $qdel = mysqli_query($db, $sqldel);
        if ($qdel) {
            $sqldelb = "DELETE FROM tbooking WHERE kdbook='$kdbook'";
            $qdelb = mysqli_query($db, $sqldelb);
            if ($qdelb) {
                $sukses = 'Berhasil Hapus data';
            }
        } else {
            $error = "Gagal hapus data ";
        }
    } catch (Exception $e) {
        $error = 'Ada data yang digunakan dalam tabel Lain';
    }
}

//edit data
if (isset($_POST['Update'])) {
    $kdtransaksi       = $_POST['kdtransaksi'];
    $metodepay         =  $_POST['metodepay'];
    $totalpay         =  $_POST['totalpay'];


    $sqlup = "  UPDATE ttransaksi SET 
                metodepay = '$metodepay',
                totalpay = '$totalpay'
                WHERE  kdtransaksi= '$kdtransaksi'";

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

if (isset($_POST['Print'])) {

    $kdtransaksi       = $_POST['kdtransaksi'];
    $nama              =  $_POST['nama'];
    $nowa              = $_POST['nowa'];
    $tglwktpay         = $_POST['tglwktpay'];
    $kdtreatment       = $_POST['kdtreatment'];
    $metodepay         = $_POST['metodepay'];
    $totalprice        = $_POST['totalprice'];
    //nota
    $_SESSION['kdtransaksi'] = $kdtransaksi;
    $_SESSION['namapay'] = $nama;
    $_SESSION['nowapay'] = $nowa;
    $_SESSION['tglwktpay'] = $tglwktpay;
    $_SESSION['treatmentpay'] = $kdtreatment;
    $_SESSION['metodepay'] = $metodepay;
    $_SESSION['totalprice'] = $totalprice;

    header("Location: payment.php");
}


//include sidebar
require_once 'sidebar.php';



?>

<br>
<h1 class="text-center">Daftar Transaksi</h1>
<br>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Data Table Transaksi
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
                    <th>KD Transaksi</th>
                    <th>Nama</th>
                    <th>No Wa</th>
                    <th>Tanggal Nailart</th>
                    <th>Jenis Treatment</th>
                    <th>Metode Pembayaran</th>
                    <th>Total Harga</th>
                    <th>Tanggal & Waktu Transaksi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql2 = "SELECT 
                *,
                DATE_FORMAT(tbooking.tgl, '%d-%m-%Y') AS ftglb,
                DATE_FORMAT(ttransaksi.tglwktpay, '%d-%m-%Y %H:%i') AS ftglt
                FROM 
                ttransaksi
                INNER JOIN 
                tbooking ON ttransaksi.kdbook = tbooking.kdbook
                INNER JOIN 
                ttreatment ON tbooking.kdtreatment = ttreatment.kdtreatment
                WHERE 
                tbooking.konfirmasi = 'Selesai'
                ORDER BY 
                ttransaksi.kdtransaksi ASC";
                $q2 = mysqli_query($db, $sql2);
                $urut = 1;
                while ($r2 = mysqli_fetch_array($q2)) {
                    $kdtransaksi       = $r2['kdtransaksi'];
                    $kdbook        = $r2['kdbook'];
                    $nama        = $r2['nama'];
                    $nowa        = $r2['nowa'];
                    $tglb        = $r2['ftglb'];
                    $treatment        = $r2['treatment'];
                    $metodepay        = $r2['metodepay'];
                    $totalpay        = $r2['totalpay'];
                    $tglpay        = $r2['ftglt'];
                    $kodetransaksi = 'seetx' . $kdtransaksi;
                ?>
                    <tr>
                        <th scope="row"><?= $urut++ ?></th>
                        <td scope="row"><?= $kdtransaksi ?></td>
                        <td scope="row"><?= $nama ?></td>
                        <td scope="row"><?= $nowa ?></td>
                        <td scope="row"><?= $tglb ?></td>
                        <td scope="row"><?= $treatment ?></td>
                        <td scope="row"><?= $metodepay ?></td>
                        <td scope="row">Rp.<?= $totalpay ?></td>
                        <td scope="row"><?= $tglpay ?></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <button type="button" class="btn btn-info me-2" data-bs-toggle="modal" data-bs-target="#edit<?= $urut ?>"><i class="fas fa-edit"></i></button>
                                <button type="button" class="btn btn-danger me-2" data-bs-toggle="modal" data-bs-target="#delete<?= $urut ?>"><i class="fas fa-trash"></i></button>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#konfirmasi<?= $urut ?>"><i class="fas fa-print"></i></button>
                            </div>
                        </td>
                    </tr>


                    <!-- Delete -->
                    <div class="modal" id="delete<?= $urut ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Apakah anda ingin menghapus Transaksi ini?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="post" action="">
                                    <div class="modal-body">
                                        <h5 class="text-start text-danger"> ID : <?= $kodetransaksi ?><br><br>
                                            <!-- biarkan code berantakan seperti ini -->
                                            <span class="text-danger text-start">
                                                <pre> Nama       : <?= $nama ?>  
 WhatsApp   : <?= $nowa ?> 
 Treatment  : <?= $treatment ?>

 Tanggal    : <?= $tglpay ?> 
 Metode     : <?= $metodepay ?>

</pre>
                                            </span>
                                            <!-- biarkan code berantakan seperti ini sampai sini -->
                                            <!-- Mengambil data primary key untuk ubah -->
                                            <input name="kdtransaksi" type="hidden" value="<?= $kdtransaksi ?>">
                                            <input name="kdbook" type="hidden" value="<?= $kdbook ?>">
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
                    <!-- Konfirmasi -->
                    <div class="modal fade" id="konfirmasi<?= $urut ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Print Data ini?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="post" action="">
                                    <div class="modal-body">

                                        <h5 class="text-start text-success">ID : <?= $kodetransaksi ?><br><br>
                                            <!-- biarkan code berantakan seperti ini -->
                                            <span class="text-black text-start">
                                                <pre> Nama              : <?= $nama ?>  
 WhatsApp          : <?= $nowa ?> 
 Treatment         : <?= $treatment ?>

 Tanggal Transaksi : <?= $tglpay ?>

 Total Harga       : Rp.<?= $totalpay ?>
</pre>
                                            </span>
                                            <!-- biarkan code berantakan seperti ini sampai sini -->

                                            <!-- Mengambil data primary key untuk ubah -->
                                            <input name="kodetransaksi" type="hidden" value="<?= $kodetransaksi ?>">
                                            <input name="nama" type="hidden" value="<?= $nama ?>">
                                            <input name="nowa" type="hidden" value="<?= $nowa ?>">
                                            <input name="kdtreatment" type="hidden" value="<?= $treatment ?>">
                                            <input name="tglwktpay" type="hidden" value="<?= $tglpay ?>">
                                            <input name="totalprice" type="hidden" value="<?= $totalpay ?>">
                                            <input name="metodepay" type="hidden" value="<?= $metodepay ?>">
                                        </h5>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary text-bg-success" name="Print"><i class="fas fa-print"></i> Print Invoice</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Konfirmasi -->

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
                                            <label for="kdtransaksi" class="col-sm-3 col-form-label">ID Transaksi</label>
                                            <div class="col-sm-9">
                                                <input type="text" readonly class="form-control-plaintext" name="kdtransaksi" value="<?= $kodetransaksi; ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="" class="col-sm-3 col-form-label">Tanggal Transaksi</label>
                                            <div class="col-sm-9">
                                                <input type="text" readonly class="form-control-plaintext" value="<?= $tglpay ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                                            <div class="col-sm-9">
                                                <input type="text" readonly class="form-control-plaintext" id="namap" value="<?= $nama ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="totalpay" class="col-sm-3 col-form-label">Total Harga</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="totalpay" name="totalpay" value="<?= $totalpay ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">

                                            <label for="treatment" class="col-sm-3 col-form-label text-black">Metode Pembayaran</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="metodepay">
                                                    <option value="">- Klik untuk pilih Metode pembayaran - </option>
                                                    <option value="Tunai" <?= $metodepay == 'Tunai' ? 'selected' : '' ?>>Tunai</option>
                                                    <option value="Debit" <?= $metodepay == 'Debit' ? 'selected' : '' ?>>Debit</option>
                                                    <option value="QRIS" <?= $metodepay == 'QRIS' ? 'selected' : '' ?>>QRIS</option>
                                                    <option value="Transfer" <?= $metodepay == 'Transfer' ? 'selected' : '' ?>>Transfer</option>
                                                </select>
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

        <button class="btn btn-secondary" onclick="Redirect();">Refresh</button>
        <script>
            function Redirect() {
                window.location.href = 'daftartransaksi.php';
            }
        </script>
    </div>
</div>
</div>

<?php

require_once 'sidebar2.php';
?>