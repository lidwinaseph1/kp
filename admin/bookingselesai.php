<?php
session_start();
require_once 'controller/Sessionislogin.php';
require_once 'service/koneksidb.php';
require_once 'model/Definition.php';


//UpdateKonfirmasi
if (isset($_POST['Pay'])) {

    // $price1 = 50000  *  $_POST['price1'];
    // $price2 = 55000  *  $_POST['price2'];
    // $price3 = 90000  *  $_POST['price3'];
    // $price4 = 125000 *  $_POST['price4'];
    // $price5 = 75000  *  $_POST['price5'];
    // $price6 = 5000   *  $_POST['price6'];
    // $price7 = 10000  *  $_POST['price7'];
    // $price8 = 10000  *  $_POST['price8'];
    // $price9 = 7000   *  $_POST['price9'];
    // $price10 = 10000 *  $_POST['price10'];
    // $price11 = 55000 *  $_POST['price11'];
    // $price12 = 65000 *  $_POST['price12'];

    //logika penjumlahan totalharga
    $totalprice = 0;
    $sqltt = "SELECT harga FROM tprice";
    $resulttt = $db->query($sqltt);
    if ($resulttt->num_rows > 0) {
        $i = 1;
        while ($row = $resulttt->fetch_assoc()) {
            $harga = $row['harga'];
            ${"price" . $i} = $harga * $_POST["price$i"]; // Mengambil nilai dari array POST
            $totalprice += ${"price" . $i}; //menjumlahkansemua price
            $i++;
        }
    }

    $kdbook       = $_POST['kdbook'];
    $kodebook       = $_POST['kodebook'];
    $nama         =  $_POST['nama'];
    $nowa         = $_POST['nowa'];
    $tgl          = $_POST['tgl'];
    $wkt          = $_POST['wkt'];
    $kdtreatment    = $_POST['kdtreatment'];
    $metodepay = $_POST['metodepay'];

    //nota
    $_SESSION['kodebookpay'] = $kodebook;
    $_SESSION['namapay'] = $nama;
    $_SESSION['nowapay'] = $nowa;
    $_SESSION['treatmentpay'] = $kdtreatment;
    $_SESSION['totalprice'] = $totalprice;
    $_SESSION['metodepay'] = $metodepay;


    $sqldel = "UPDATE tbooking SET konfirmasi = 'Selesai' WHERE kdbook = '$kdbook'";
    $qdel = mysqli_query($db, $sqldel);
    if ($qdel) {
        //memasukkan data ke ttransaksi
        $sqlpay = "INSERT INTO ttransaksi(kdbook,metodepay,totalpay) VALUES('$kdbook','$metodepay','$totalprice')";
        $qpay = mysqli_query($db, $sqlpay);
        if ($qpay) {
            $sql1 = "SELECT * FROM ttransaksi WHERE kdbook='$kdbook'";
            $result1 =  $db->query($sql1);
            if ($result1->num_rows > 0) {
                $data = $result1->fetch_assoc();
                $_SESSION['kdtransaksi'] = $data['kdtransaksi'];
                $_SESSION['tglwktpay'] = $data['tglwktpay'];
                $sukses = "Berhasil bayar";
                header("Location: payment.php");
                exit;
            }
        } else {
            $error = "Gagal Insert transaksi ";
        }
    } else {
        $error = "Gagal ";
    }
}

//insertdata
if (isset($_POST['Tambah'])) {
    $nama =  $_POST['nama'];
    $nowa = $_POST['nowa'];
    $tgl = $_POST['tgl'];
    $wkt = $_POST['wkt'];
    $kdtreatment = $_POST['kdtreatment'];
    $konfirmasi = 'Selesai';
    if ($nama && $nowa && $tgl && $wkt && $kdtreatment && $konfirmasi) {
        $sql = "INSERT INTO tbooking(nama,nowa,tgl,wkt,kdtreatment,konfirmasi) VALUES('$nama','$nowa','$tgl','$wkt','$kdtreatment','$konfirmasi')";
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
require_once 'sidebar.php';

//hapusdata
if (isset($_POST['Delete'])) {
    $kdbook       = $_POST['kdbook'];
    $sqldel = "DELETE FROM tbooking WHERE kdbook='$kdbook'";
    $qdel = mysqli_query($db, $sqldel);
    if ($qdel) {
        $sukses = "Berhasil Menghapus data Booking";
    } else {
        $error = "Gagal hapus data Booking";
    }
}

//edit data
if (isset($_POST['Update'])) {
    $kdbook       = $_POST['kdbook'];
    $nama         =  $_POST['nama'];
    $nowa         = $_POST['nowa'];
    $tgl          = $_POST['tgl'];
    $wkt          = $_POST['wkt'];
    $kdtreatment    = $_POST['kdtreatment'];

    $sqlup = "  UPDATE tbooking SET 
                nama = '$nama',
                nowa = '$nowa',
                tgl = '$tgl',
                wkt = '$wkt' ,
                kdtreatment = '$kdtreatment' 
                WHERE kdbook = '$kdbook'";
    $qup = mysqli_query($db, $sqlup);
    if ($qup) {
        $sukses = "Berhasil Menghapus data Booking";
    } else {
        $error = "Gagal hapus data Booking";
    }
}




?>

<br>
<h1 class="text-center">Pending Payment Nailart</h1>
<br>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Data Table Payment Nailart
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
                    <th>KdBook</th>
                    <th>Nama</th>
                    <th>No WhatsApp</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Jenis Treatment</th>
                    <th>Konfirmasi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql2 = "SELECT 
                *,
                DATE_FORMAT(tbooking.tgl, '%d-%m-%Y') AS ftgl
                FROM 
                tbooking
                INNER JOIN 
                ttreatment ON tbooking.kdtreatment = ttreatment.kdtreatment
                WHERE 
                tbooking.konfirmasi = 'Payment'
                ORDER BY 
                tbooking.kdbook ASC";
                $q2 = mysqli_query($db, $sql2);
                $urut = 1;

                while ($r2 = mysqli_fetch_array($q2)) {
                    $kdbook       = $r2['kdbook'];
                    $nama        = $r2['nama'];
                    $nowa       = $r2['nowa'];
                    $tgl       = $r2['ftgl'];
                    $wkt       = $r2['wkt'];
                    $kdtreatment = $r2['treatment'];
                    $konfirmasi = $r2['konfirmasi'];
                    $kodebook = 'see' . $kdbook;
                    $kodetreat = $r2['kdtreatment'];
                ?>
                    <tr>
                        <th scope="row"><?= $urut++ ?></th>
                        <td scope="row"><?= $kodebook ?></td>
                        <td scope="row"><?= $nama ?></td>
                        <td scope="row"><?= $nowa ?></td>
                        <td scope="row"><?= $tgl ?></td>
                        <td scope="row"><?= $wkt ?></td>
                        <td scope="row"><?= $kdtreatment ?></td>
                        <td scope="row"><?= $konfirmasi ?></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <button type="button" class="btn btn-info me-2" data-bs-toggle="modal" data-bs-target="#editbook<?= $urut ?>"><i class="fas fa-edit"></i></button>
                                <button type="button" class="btn btn-danger me-2" data-bs-toggle="modal" data-bs-target="#deletebook<?= $urut ?>"><i class="fas fa-trash"></i></button>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#konfirmasi<?= $urut ?>"><i class="fas fa-money-bill-wave"></i></button>
                            </div>
                        </td>
                    </tr>
                    <!-- Delete -->
                    <div class="modal" id="deletebook<?= $urut ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Apakah anda ingin menghapus Payment ini?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="post" action="">
                                    <div class="modal-body">
                                        <h5 class="text-start text-danger"> ID : <?= $kodebook ?><br><br>
                                            <!-- biarkan code berantakan seperti ini -->
                                            <span class="text-danger text-start">
                                                <pre> Nama       : <?= $nama ?>  
 WhatsApp   : <?= $nowa ?> 
 Tanggal    : <?= $tgl ?> 
 Waktu      : <?= $wkt ?>

 Treatment  : <?= $kdtreatment ?>
</pre>
                                            </span>
                                            <!-- biarkan code berantakan seperti ini sampai sini -->
                                            <!-- Mengambil data primary key untuk ubah -->
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
                                    <h5 class="modal-title" id="exampleModalLabel">Lakukan Pembayaran ?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="post" action="">
                                    <div class="modal-body">
                                        <h5 class="text-start text-success">ID : <?= $kodebook ?><br><br>
                                            <!-- biarkan code berantakan seperti ini -->
                                            <span class="text-black text-start">
                                                <pre> Nama       : <?= $nama ?>  
 WhatsApp   : <?= $nowa ?> 
 Tanggal    : <?= $tgl ?> 
 Waktu      : <?= $wkt ?>

 Treatment  : <?= $kdtreatment ?>
</pre>
                                            </span>
                                            <!-- biarkan code berantakan seperti ini sampai sini -->

                                            <!-- Mengambil data primary key untuk ubah -->
                                            <input name="kdbook" type="hidden" value="<?= $kdbook ?>">
                                            <input name="nama" type="hidden" value="<?= $nama ?>">
                                            <input name="nowa" type="hidden" value="<?= $nowa ?>">
                                            <input name="tgl" type="hidden" value="<?= $tgl ?>">
                                            <input name="wkt" type="hidden" value="<?= $wkt ?>">
                                            <input name="kdtreatment" type="hidden" value="<?= $kdtreatment ?>">
                                            <input name="kodebook" type="hidden" value="<?= $kodebook ?>">
                                            <hr>
                                            <h5 class="text-center">Jasa Nails</h5>
                                            <hr>

                                        </h5>
                                        <?php

                                        // Mengambil data dari database
                                        $sql = "SELECT * FROM tprice";
                                        $result = $db->query($sql);

                                        if ($result->num_rows > 0) {
                                            $i = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<div class="form-group row">';
                                                echo '<label for="input' . $i . '" class="col-sm-3 col-form-label mb-2">' . $row["namaprice"] . '</label>';
                                                echo ':<div class="col-sm-2">';
                                                echo '<input type="number" class="form-control mb-2" id="input' . $i . '" name="price' . $i . '" required>';
                                                echo '</div>';
                                                echo '</div>';
                                                $i++;
                                            }
                                        }
                                        ?>
                                        <hr>
                                        <div class=" mb-3 row">
                                            <div class="form-group row">
                                                <label for="treatment" class="col-sm-3 col-form-label text-black">Metode Pembayaran</label>
                                                :<div class="col-sm-8">
                                                    <select class="form-control" name="metodepay" required>
                                                        <option value="" disabled selected>- Klik untuk pilih Metode pembayaran - </option>
                                                        <option value="Tunai">Tunai</option>
                                                        <option value="Debit">Debit</option>
                                                        <option value="QRIS">QRIS</option>
                                                        <option value="Transfer">Transfer</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary text-bg-success" name="Pay"><i class="fas fa-money-bill-wave"></i> Pay</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Konfirmasi -->
                    <!-- edit -->
                    <div class="modal fade" id="editbook<?= $urut ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Payment</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="post" action="">
                                    <div class="modal-body">
                                        <div class="mb-3 row">
                                            <label for="kdbook" class="col-sm-2 col-form-label">ID</label>
                                            <div class="col-sm-10">
                                                <input type="text" hidden id="kdbook" name="kdbook" value="<?= $kdbook; ?>">
                                                <input type="text" readonly class="form-control-plaintext" value="<?= $kodebook; ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="nama" name="nama" value="<?= $nama ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="nowa" class="col-sm-2 col-form-label">No WhatsApp</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="nowa" name="nowa" value="<?= $nowa ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="tgl" class="col-sm-2 col-form-label">Tanggal</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" id="tgl" name="tgl" value="<?= $r2['tgl'] ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="wkt" class="col-sm-2 col-form-label">Waktu</label>
                                            <div class="col-sm-10">
                                                <input type="time" class="form-control" id="wkt" name="wkt" value="<?= $wkt ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="form-group row">
                                                <label for="treatment" class="col-sm-2 col-form-label">Treatment</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" name="kdtreatment">
                                                        <option value="">- Klik untuk pilih - </option>
                                                        <?php
                                                        $sql = "SELECT kdtreatment, treatment FROM ttreatment";
                                                        $result = mysqli_query($db, $sql);
                                                        if (mysqli_num_rows($result) > 0) {
                                                            while ($row = mysqli_fetch_array($result)) {
                                                                $selected = ($row['kdtreatment'] == $kodetreat) ? 'selected' : '';
                                                                echo "<option value='" . $row['kdtreatment'] . "' $selected>" . $row['treatment'] . "</option>";
                                                            }
                                                        } else {
                                                            echo "<option value=''>No treatment available</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="Update">Insert Data</button>
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
        <button type="button-end" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahbooking">
            Tambah
        </button>
        <!-- Tambah -->
        <div class="modal fade" id="tambahbooking" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Payment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="">
                        <div class="modal-body">
                            <div class="mb-3 row">
                                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama" name="nama">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nowa" class="col-sm-2 col-form-label">No WhatsApp</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nowa" name="nowa">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="tgl" class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="tgl" name="tgl" ">
                                </div>
                            </div>
                            <div class=" mb-3 row">
                                    <label for="wkt" class="col-sm-2 col-form-label">Waktu</label>
                                    <div class="col-sm-10">
                                        <input type="time" class="form-control" id="wkt" name="wkt" ">
                                </div>
                            </div>
                            <div class=" mb-3 row">
                                        <div class="form-group row">
                                            <label for="treatment" class="col-sm-2 col-form-label">Treatment</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="kdtreatment">
                                                    <option value="">- Klik untuk pilih - </option>
                                                    <?php
                                                    $sql = "SELECT kdtreatment, treatment FROM ttreatment";
                                                    $result = mysqli_query($db, $sql);

                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_array($result)) {
                                                            echo "<option value='" . $row['kdtreatment'] . "'>" . $row['treatment'] . "</option>";
                                                        }
                                                    } else {
                                                        echo "<option value=''>No treatment available</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="Tambah">Simpan Perubahan</button>
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