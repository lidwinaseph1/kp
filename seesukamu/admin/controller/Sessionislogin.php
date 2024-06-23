<?php
if (!$_SESSION['is_login']) {
    $_SESSION['loginstate'] = true;
    header("location: index.php");
    exit;
}
