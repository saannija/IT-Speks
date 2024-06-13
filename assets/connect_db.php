<?php
    ini_set('display_errors', 0);
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
        $username = mysqli_real_escape_string($savienojums, $_POST["username"]);
        $password = mysqli_real_escape_string($savienojums, $_POST["password"]);
        $sql_teikums = "SELECT * FROM it_speks_darbinieki WHERE Lietotajvards = '$username'";
        $result = mysqli_query($savienojums, $sql_teikums);

        if(mysqli_num_rows($result) == 1){
            while($user = mysqli_fetch_array($result)){
                if(password_verify($password, $user['Parole'])){
                    session_start();
                    $_SESSION["lietotajvards"] = $user['Lietotajvards'];
                    $_SESSION["lietotajvards_show"] = $user['Paradamais_vards'];
                    $_SESSION["darb_role"] = $user['Tiesibas'];
                    header("location:./admin/index.php");
                    exit;
                }else{
                    echo "<div class='notif red'>Nepareizs lietotājvārds vai parole!</div>";
                    echo "<script>
                            setTimeout(function() {
                                window.location.reload();
                            }, 2000);
                        </script>";
                }
            }
        }else{
            echo "<div class='notif red'>Nepareizs lietotājvārds vai parole!</div>";
            echo "<script>
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                </script>";
        }
    }

    if(isset($_POST["login-button-user"])){
        $username = mysqli_real_escape_string($savienojums, $_POST["username"]);
        $password = mysqli_real_escape_string($savienojums, $_POST["password"]);
        $sql_teikums = "SELECT * FROM it_speks_lietotaji WHERE Lietotajvards = '$username'";
        $result = mysqli_query($savienojums, $sql_teikums);

        if(mysqli_num_rows($result) == 1){
            while($user = mysqli_fetch_array($result)){
                if(password_verify($password, $user['Parole'])){
                    $_SESSION["lietotajs"] = $user['Lietotajvards'];
                    $login_date_sql = "UPDATE it_speks_lietotaji SET Tiessaiste = CURRENT_TIMESTAMP() WHERE Lietotajvards = '$username'";
                    mysqli_query($savienojums, $login_date_sql);
                }else{
                    echo "<div class='notif red'>Nepareizs lietotājvārds vai parole!</div>";
                    echo "<script>
                            setTimeout(function() {
                                window.location.reload();
                            }, 2000);
                        </script>";
                }
            }
        }else{
            echo "<div class='notif red'>Nepareizs lietotājvārds vai parole!</div>";
            echo "<script>
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                </script>";
        }
    }

?>