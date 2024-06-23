<?php
include("../service/koneksidb.php");
session_start();


if (isset($_SESSION["is_login"])) {
    header("location: ../dashboard.php");
}

if (isset($_POST["login"])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql1 = "SELECT * FROM us WHERE username='$username' AND password='$password' ";
    $result1 =  $db->query($sql1);

    if ($result1->num_rows > 0) {
        $data = $result1->fetch_assoc();
        $_SESSION['idus'] = $data['id'];
        $_SESSION["username"] = $data["username"];
        $_SESSION["password"] = $data["password"];
        $_SESSION["namaus"] = $data["Nama"];
        $_SESSION["emailus"] = $data["Email"];
        $_SESSION["notlpus"] = $data["No_Tlp"];
        $_SESSION["jkus"] = $data["Jk"];
        $_SESSION["is_login"] = true;
        header("location: ../dashboard.php");
        exit;
    } else {
        $_SESSION["error"] = true; //errorlogin
        header("location: ../index.php");
        exit;
    }
}
