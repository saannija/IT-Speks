<?php
    session_start();
    if(!isset($_SESSION["lietotajvards"])){
        header("location:../index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style_main.css">
    <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
    <script src="../assets/script.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <title>IT Spēks</title>
</head>
<body>
    <?php require "navigation.php"; ?>
    <header id="admin-header">
        <div id="admin-header-content">
            <button class="toggle-btn default-button" onclick="togglePanel('nav-content')">
                <i class="fas fa-bars"></i>
            </button>
            <a href="../index.php" class="logo">IT Spēks</a>
        </div>

        <div id="admin-header-content-right">
            <div id="modes" class="fa-regular fa-moon"></div>
            <a href="../assets/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> <?php echo $_SESSION['lietotajvards_show']; ?></a>
        </div>
        
    </header>