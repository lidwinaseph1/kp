<?php
session_start();
require_once 'Sessionislogin.php';

$kodebook = $_SESSION['kodebookcust'];
$nama = $_SESSION['namacust'];
$nowa = $_SESSION['nowacust'];
$tgl = $_SESSION['tglcust'];
$wkt = $_SESSION['wktcust'];
$kdtreatment = $_SESSION['treatmentcust'];
$wktt = substr_replace($wkt, "", 5, 3) . ' WIB';


$phone = '085175136585';
// Menghilangkan nol di depan nomor telepon dan menambahkan kode negara +62
$phone = '+62' . substr($phone, 1);
// Pesan yang akan dikirim
$message = "Hai $nama Booking Nailart di seesukamu Telah Kami Konfirmasi , $kdtreatment pada Tanggal : $tgl  dan jam : $wktt ";
// Membangun URL dengan nomor dan pesan yang sudah dienkripsi
$url = "https://web.whatsapp.com/send?phone=$phone&text=" . rawurlencode($message);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Redirecting to WhatsApp...</title>
    <script>
        window.onload = function() {
            // Buka tautan WhatsApp di tab baru
            window.open("<?php echo $url; ?>", "_blank");
            // Set timeout untuk memberikan waktu sebelum kembali ke index.php
            setTimeout(function() {
                window.location.href = "../index.php";
            }, 1000); // Misalnya, tunggu 1 detik sebelum kembali ke index.php
        };
    </script>

</head>

<body>
    <p>Mengalihkan ke WhatsApp...</p>

</body>

</html>