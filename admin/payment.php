<?php
session_start();
require_once 'controller/Sessionislogin.php';


$kdtransaksi = $_SESSION['kdtransaksi'];
$nama = $_SESSION['namapay'];
$nowa = $_SESSION['nowapay'];
$tglwktpay = $_SESSION['tglwktpay'];
$kdtreatment = $_SESSION['treatmentpay'];
$totalprice = $_SESSION['totalprice'];
$metodepay = $_SESSION['metodepay'];



try {
    // Buat objek DateTime dari string
    $date = new DateTime($tglwktpay);
    // Format yang diinginkan
    $desiredFormat = 'd-m-Y H:i';
    // Format string asli ke dalam format yang diinginkan
    $formattedOriginal = DateTime::createFromFormat($desiredFormat, $tglwktpay);
    // Jika string asli sudah sesuai format, gunakan string asli, jika tidak, gunakan format baru
    if ($formattedOriginal && $formattedOriginal->format($desiredFormat) === $tglwktpay) {
        $ftglwktpay = $tglwktpay;
    } else {
        $ftglwktpay = $date->format($desiredFormat);
    }
} catch (Exception $e) {
    // Menangani kesalahan jika string tidak bisa diubah menjadi objek DateTime
    echo "Error: " . $e->getMessage();
}



?>

<!DOCTYPE html>
<html>

<head>
    <title>Invoice seesukamu</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .header {
            border-bottom: 2px solid black;
        }

        .footer {
            text-align: center;
        }

        .content {
            margin-top: 20px;
        }

        .logo {
            max-width: 100px;
            margin-bottom: 10px;
        }

        .brand {
            margin-left: 30px;
        }

        pre {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 1.3rem;
            border: none;
        }

        @media print {

            body,
            html {
                width: 80mm;
            }

            .nota {
                border: none;
                margin: 0;
                width: 100%;
            }

            .nota .container {
                width: 100%;
                margin: 0;
                padding: 0;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container nota border p-3">
        <div class="header d-flex p-2">
            <div class="logo">
                <img src="images/hero.png" class="logo" alt="Logo Toko">
            </div>
            <div class="brand ms-3">
                <h2>seesukamu</h2>
                <p>Nailart</p>
                <p><?= $ftglwktpay ?></p>
            </div>
        </div>
        <div class="content">
            <pre>
<b>ID</b>                    :  seetx<?= $kdtransaksi ?>

<b>Customer</b>       :  <?= $nama ?>

<b>Service</b>           :  <?= $kdtreatment ?>

<b>Pembayaran</b>  :  <?= $metodepay ?>

<b>Total</b>               :  Rp.<?= $totalprice ?>
            </pre>

        </div>
        <div class="footer">
            <p>Terima kasih atas kunjungan Anda!</p>
        </div>
    </div>
    <div class="text-center mt-3 no-print">

        <button class="btn btn-secondary" onclick="Redirect();">Kembali ke Dashboard</button>
        <button class="btn btn-primary" onclick="printAndRedirect();"><i class="fa fa-print"></i> Print</button>

    </div>
    <script>
        function printAndRedirect() {
            window.print();
            setTimeout(function() {
                window.location.href = 'index.php';
            }, 1000);
        }

        function Redirect() {
            window.location.href = 'index.php';
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>