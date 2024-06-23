<?php
include 'services/koneksi.php';
$error = '';
$sukses = '';


if (isset($_POST['kirimbooking'])) {
    $nama =  $_POST['nama'];
    $nowa = $_POST['nowa'];
    $tgl = $_POST['tgl'];
    $wkt = $_POST['wkt'];
    $treatment = $_POST['treatment'];
    $konfirmasi = 'Belum';
    if ($nama && $nowa && $tgl && $wkt && $treatment && $konfirmasi) {
        $sql = "INSERT INTO tbooking(nama,nowa,tgl,wkt,kdtreatment,konfirmasi) VALUES('$nama','$nowa','$tgl','$wkt','$treatment','$konfirmasi')";
        $result = mysqli_query($koneksi, $sql);
        if ($result) {
            $sukses = 'Terimakasih Booking anda telah berhasil, mohon menunggu konfirmasi  dari kami melalui 
            Nomor WhatsApp yang tertera';
        } else {
            $error = 'Website booking sedang Maintence,Silahkan Booking melalui WhatsApp seesukamu';
        }
    } else {
        $error = 'Lengkapi Semua data';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>seesukamu</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <!-- boootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <!-- AOS animartion -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body id="home">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Seesukamu</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#booking">Booking</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- akhir navbar -->
    <!-- Hero/Jumbotron -->
    <section class="jumbotron text-center bg-danger">
        <br><br><br><br><br>
        <h1 class="display-4"></h1>
        <p class="lead"><br><br></p>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#fff" fill-opacity="1" d="M0,288L48,293.3C96,299,192,309,288,304C384,299,480,277,576,256C672,235,768,213,864,170.7C960,128,1056,64,1152,69.3C1248,75,1344,149,1392,186.7L1440,224L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </section>
    <!-- akhir Hero section /Jumbotron -->
    <!-- about -->
    <section id="about">
        <div class="container">
            <div class="row text-center mb-3">
                <div class="col">
                    <h2>About seesukamu</h2>
                </div>
            </div>
            <div class="row justify-content-center fs-5 text-center">
                <div class="col-md-4 mb-3" data-aos="fade-right" data-aos-duration="1000">
                    Seusai pandemi panjang, Seesukamu berdiri untuk menjawab kekhawatiran saya yang ingin nail art, namun terkendala oleh jarak dan harga yang mahal.
                </div>
                <div class="col-md-4 mb-3" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="100">
                    setelah mengikuti kursus dan mempelajari teknik dalam melakukan treatment nailart, akhirnya pada 2023 seesukamu hadir memberikan layanan nailart homeservice dan cafeservice dengan harga yang relatif terjangkau.
                </div>
            </div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#EAB6B8" fill-opacity="1" d="M0,192L80,192C160,192,320,192,480,160C640,128,800,64,960,42.7C1120,21,1280,43,1360,53.3L1440,64L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>
        </svg>
    </section>
    <!-- akhir about -->

    <!-- project -->
    <section id="services">
        <div class="container">
            <div class="row text-center mb-3">
                <div class="col">
                    <h2>Services</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4 mb-3">
                    <div class="card" data-aos="zoom-in">
                        <img src="assets/img/Projects/see1.jpeg" class="card-img-top img-fluid" alt="Project1" style="height: 200px; object-fit: cover;" />
                        <div class="card-body">
                            <p class="card-text">Ini adalah hasil nailart polos di mana kuku customer yang pendek dapat terlihat lebih cantik dan rapih dengan sentuhan warna yang membuat warna kulitnya lebih hidup.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card" data-aos="zoom-in">
                        <img src="assets/img/Projects/see3.jpeg" class="card-img-top img-fluid" alt="Project1" style="height: 200px; object-fit: cover;" />
                        <div class="card-body">
                            <p class="card-text">Diatas adalah hasil nailart design simple nan elegant yang membuat kuku customer terlihat manis yang membuat warna kulitnya lebih hidup.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card" data-aos="zoom-in">
                        <img src="assets/img/Projects/see2.jpeg" class="card-img-top img-fluid" alt="Project1" style="height: 200px; object-fit: cover;" />
                        <div class="card-body">
                            <p class="card-text">Ini adalah hasil nailart polos di mana kuku customer yang pendek dapat terlihat lebih cantik dan rapih dengan sentuhan warna yang membuat warna kulitnya lebih hidup.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card" data-aos="zoom-in">
                        <img src="assets/img/Projects/see4.jpeg" class="card-img-top img-fluid" alt="Project1" style="height: 200px; object-fit: cover;" />
                        <div class="card-body">
                            <p class="card-text">seesukamu menyediakan layanan panggilan nailart homeservice supaya memudahkan customer dalam melakukan treatment.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card" data-aos="zoom-in">
                        <img src="assets/img/Projects/see5.jpeg" class="card-img-top img-fluid" alt="Project1" style="height: 200px; object-fit: cover;" />
                        <div class="card-body">
                            <p class="card-text">seesukamu menyediakan layanan panggilan nailart cafeservice sehingga customer lebih nyaman dalam melakukan treatment.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#fff" fill-opacity="1" d="M0,64L48,80C96,96,192,128,288,165.3C384,203,480,245,576,256C672,267,768,245,864,202.7C960,160,1056,96,1152,64C1248,32,1344,32,1392,32L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </section>
    <!-- akhir project -->
    <!-- contact -->
    <section id="booking">
        <div class="container" data-aos="fade-up" data-aos-duration="1000">
            <div class="row text-center mb-3">
                <h2>Booking</h2>
                <div class="col"></div>
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
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="#booking" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" id="name" aria-describedby="name" />
                        </div>
                        <div class="mb-3">
                            <label for="nowa" class="form-label">No Whatsapp</label>
                            <input type="text" name="nowa" class="form-control" id="nowa" aria-describedby="nowa" />
                        </div>
                        <div class="mb-3">
                            <label for="tglwktDate" class="form-label">Tanggal</label>
                            <input type="date" name="tgl" class="form-control" id="tglwktDate" aria-describedby="tgl" />
                        </div>
                        <div class="mb-3">
                            <label for="tglwktTime" class="form-label">Waktu</label>
                            <input type="time" name="wkt" class="form-control" id="tglwktTime" aria-describedby="wkt" />
                        </div>
                        <div class="mb-3">
                            <label for="treatment" class="form-label">Treatment</label>
                            <select name="treatment" id="treatment" class="form-control">
                                <option value="">- Pilih Kategori -</option>
                                <?php
                                include 'services/koneksi.php';
                                $sql = "SELECT kdtreatment, treatment FROM ttreatment";
                                $result = mysqli_query($koneksi, $sql);

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
                        <button type="submit" class="btn btn-primary btn-kirim" name="kirimbooking">Kirim</button>
                        <button type="reset" class="btn btn-secondary btn-reset">Reset</button>
                    </form>
                </div>
            </div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#D49BA2" fill-opacity="1" d="M0,32L26.7,42.7C53.3,53,107,75,160,85.3C213.3,96,267,96,320,122.7C373.3,149,427,203,480,213.3C533.3,224,587,192,640,181.3C693.3,171,747,181,800,202.7C853.3,224,907,256,960,234.7C1013.3,213,1067,139,1120,90.7C1173.3,43,1227,21,1280,21.3C1333.3,21,1387,43,1413,53.3L1440,64L1440,320L1413.3,320C1386.7,320,1333,320,1280,320C1226.7,320,1173,320,1120,320C1066.7,320,1013,320,960,320C906.7,320,853,320,800,320C746.7,320,693,320,640,320C586.7,320,533,320,480,320C426.7,320,373,320,320,320C266.7,320,213,320,160,320C106.7,320,53,320,27,320L0,320Z"></path>
        </svg>
    </section>

    <!-- akhir contact -->
    <!-- footer -->
    <footer class="footer text-white text-center pb-3">
        <p>Created With <i class="bi bi-heart-fill text-danger"></i> by <a href="" class="text-white fw-bold">seesukamu</a></p>
    </footer>
    <!-- akhir footer -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- AOS SCRIPT -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
        });
    </script>
    <!-- AOS -->
</body>

</html>