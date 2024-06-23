<?php
session_start();
require_once "service/koneksidb.php";
require_once 'controller/Sessionislogin.php';
require_once 'sidebar.php';
//waktuperbaruichart
date_default_timezone_set('Asia/Jakarta');
$datechart = date("d M Y H:i");
?>
<div class="dashboard">
    <br>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <h3>
                        Booking :
                        <?php
                        $sql = "SELECT COUNT(*) as totalbooking FROM tbooking WHERE konfirmasi = 'belum'";
                        $result = mysqli_query($db, $sql);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc(); // Ambil hasil query
                            $totalbookingmasuk = $row['totalbooking'];

                        ?>
                            <?php echo $totalbookingmasuk ?>
                        <?php
                        } else {
                            echo "TIDAK ADA BOOKING MASUK";
                        }

                        ?>
                    </h3>

                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#jumruk" aria-expanded="false" aria-controls="flush-collapseOne">
                                <div class="small text-white">Lihat Detail <i class="fas fa-angle-right"></i></div>
                            </button>
                        </h2>
                        <div id="jumruk" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <br>
                            <div class="accordion-body">Terdapat <?= $totalbookingmasuk ?> Booking masuk belum diterima</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <h3>
                        Nailart :
                        <?php
                        $sql = "SELECT COUNT(*) as totalbooking FROM tbooking WHERE konfirmasi = 'Terima'";
                        $result = mysqli_query($db, $sql);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc(); // Ambil hasil query
                            $totalbookingterima = $row['totalbooking'];

                        ?>
                            <?php echo $totalbookingterima ?>
                        <?php
                        } else {
                            echo "TIDAK ADA BOOKING TERIMA";
                        }
                        ?>
                    </h3>

                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#jumgur" aria-expanded="false" aria-controls="flush-collapseOne">
                                <div class="small text-white">Lihat Detail <i class="fas fa-angle-right"></i></div>
                            </button>
                        </h2>
                        <div id="jumgur" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <br>
                            <div class="accordion-body">Terdapat <?= $totalbookingterima ?> Nailart belum dikerjakan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <h3>
                        Payment :
                        <?php
                        $sql = "SELECT COUNT(*) as totalbooking FROM tbooking WHERE konfirmasi = 'Selesai'";
                        $result = mysqli_query($db, $sql);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc(); // Ambil hasil query
                            $totalbookingselesai = $row['totalbooking'];

                        ?>
                            <?php echo $totalbookingselesai ?>
                        <?php
                        } else {
                            echo "TIDAK ADA BOOKING Selesai";
                        }

                        ?>
                    </h3>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#jumpedik" aria-expanded="false" aria-controls="flush-collapseOne">
                                <div class="small text-white">Lihat Detail <i class="fas fa-angle-right"></i></div>
                            </button>
                        </h2>
                        <div id="jumpedik" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <br>
                            <div class="accordion-body">Terdapat <?= $totalbookingselesai ?> Nailart belum dibayar</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    <h3>
                        Transaksi :
                        <?php
                        $sql = "SELECT COUNT(*) as totaltransaksi FROM ttransaksi";
                        $result = mysqli_query($db, $sql);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc(); // Ambil hasil query
                            $totaltransaksi = $row['totaltransaksi'];

                        ?>
                            <?php echo $totaltransaksi ?>
                        <?php
                        } else {
                            echo "TIDAK ADA BOOKING MASUK";
                        }

                        ?>
                    </h3>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#jumrom" aria-expanded="false" aria-controls="flush-collapseOne">
                                <div class="small text-white">Lihat Detail <i class="fas fa-angle-right"></i></div>
                            </button>
                        </h2>
                        <div id="jumrom" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <br>
                            <div class="accordion-body">Ada <?= $totaltransaksi ?> Total Transaksi saat ini</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-brush me-1"></i>
                    Nailart seesukamu
                </div>
                <!-- <div class="card-body"><canvas id="myBarChart" width="100%" height="50"></canvas></div> -->
                <img src="images/hero.png" alt="" width="95%">
                <div class="card-footer small text-muted">Diperbarui <?= $datechart ?></div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-pie me-1"></i>
                    Nailart Management
                </div>
                <div class="card-body"><canvas id="myPieChart" width="100%" height="50"></canvas></div>
                <div class="card-footer small text-muted">Diperbarui <?= $datechart ?></div>
            </div>
        </div>

    </div>
</div>


<?php
require_once 'sidebar2.php';
?>