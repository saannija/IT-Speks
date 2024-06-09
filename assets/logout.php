<?php
    session_start();
    session_destroy();
    $_SESSION['role'] = NULL;
    header("location:../index.php");
?>