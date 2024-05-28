<?php
    ini_set('display_errors', 1);
    $serveris = "localhost";
    $lietotajs = "grobina1_romazanova";
    $parole = "8Xzai1FC!";
    $datubaze = "grobina1_romazanova";

    $savienojums = mysqli_connect($serveris, $lietotajs, $parole, $datubaze);

    if(!$savienojums){
        // echo "Savienojums ar DB nav izveidots!";
    }else{
        // echo "Savienojums ar DB veiksmigs!";
    }

    if(isset($_POST["login-button"])){
        session_start();
        $username = mysqli_real_escape_string($savienojums, $_POST["lietotajs"]);
        $password = mysqli_real_escape_string($savienojums, $_POST["parole"]);
        $sql_teikums = "SELECT * FROM it_speks_darbinieki WHERE Lietotajvards = '$username'";
        $result = mysqli_query($savienojums, $sql_teikums);

        if(mysqli_num_rows($result) == 1){
            while($user = mysqli_fetch_array($result)){
                if(password_verify($password, $user['Parole'])){
                    $_SESSION["lietotajvards"] = $user['Lietotajvards'];
                    header("location:./admin/index.php");
                    exit;
                }else{
                    echo "Nepareizs lietotājvārds vai parole!";
                }
            }
        }else{
            echo "Nepareizs lietotājvārds vai parole!";
        }
    }
?>