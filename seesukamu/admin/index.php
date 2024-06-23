<?php
session_start();

if (isset($_SESSION["is_login"])) {
    header("location: dashboard.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-image: radial-gradient(#F1FADA, #eab6b8);
            /* background-image: url(images/hero.png); */
            position: relative;
            /* Menambahkan posisi relatif ke body */
            min-height: 100vh;
        }

        img {
            border: none;
            border-radius: 0 0 5px 0;
        }

        .alert {
            border-radius: 50px;
            opacity: 0;
            animation: slideDown 0.3s ease-out forwards, fadeIn 0.5s ease-out forwards;
            position: absolute;
            z-index: 99;
            /* Menggunakan posisi absolut */
            left: 50%;
            /* Menengahkan alert horizontal */
            top: -100px;
            /* Mengatur posisi awal di atas layar */
            /* Menetapkan jarak dari atas */
            transform: translateX(-50%);
            /* Menyesuaikan posisi horizontal */
        }

        @keyframes slideDown {
            to {
                top: 20px;
                /* Menetapkan posisi akhir */
            }
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <?php

    if (isset($_SESSION["error"])) {
        echo '<div class="alert alert-danger text-center w-50 mx-auto text-dark" role="alert">';
        echo '<i class="bi bi-exclamation-triangle-fill"></i> ';
        echo 'Username atau Password salah. Silahkan coba lagi.';
        echo '</div>';
        unset($_SESSION["error"]);
    }
    if (isset($_SESSION["loginstate"])) {
        echo '<div class="alert alert-danger text-center w-50 mx-auto text-dark" role="alert">';
        echo '<i class="bi bi-exclamation-triangle-fill"></i> ';
        echo 'Maaf anda harus Login terlebih dahulu.';
        echo '</div>';
        unset($_SESSION["loginstate"]);
    }
    ?>

    <section class="login d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="card mb-3" style="max-width: 600px;">
            <div class="card-header text-white text-center" style="background-color:#d49ba2;">
                <h5 class="card-title mb-0">Nailart Seesukamu</h5>
            </div>
            <div class="row g-0">
                <div class="col-sm-7">
                    <div class="card-body shadow rounded-start bg-light p-4 img-thumbnail">
                        <h5 class="card-title text-center mb-3">Login</h5>
                        <form id="loginform" action="controller/login.php" method="post" autocomplete="off">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-circle"></i></span>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="username" aria-label="Username" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon2"><i class="bi bi-lock-fill"></i></span>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="password" aria-label="Password" aria-describedby="basic-addon2" required>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" name="login" class="btn text-white" style="background-color:#d49ba2;">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-5">
                    <img src="images/hero.png" class="img-fluid h-100 shadow " alt="..." style="object-fit: cover;">
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>