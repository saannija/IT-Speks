<div id="edit-user-window" class="default-popup">
    <div class="row">
        <h2>Rediģēt</h2>
        <button class="default-button" onclick="hideWindow('edit-user-window')"><i class="fas fa-times"></i></button>
    </div>
    <hr>

    <form id="login-form" method="post">
    <input type="text" id="username" name="username" class="default-input" placeholder="Lietotājvārds" required>
    <input type="email" id="epasts" name="epasts" class="default-input" placeholder="E-pasts" required>
    <input type="text" id="vards" name="vards" class="default-input" placeholder="Parādāmais vārds" required>
    <select name="tiesibas" id="">
        <option value="Administrators">Administrators</option>
        <option value="Moderators">Moderators</option>
    </select>
    <input type="password" id="password" name="password" class="default-input" placeholder="Parole" required>
    <button type="submit" class="default-button" id="save-user" name="save-user">Saglabāt</button>
  </form>
</div>

<div id="background-overlay"></div>

<?php
    require "../assets/connect_db.php" ;

    if(isset($_POST['save-user'])){
        if(!empty($_POST['username']) && !empty($_POST['epasts']) && !empty($_POST['vards']) && !empty($_POST['tiesibas'])  && !empty($_POST['password'])){
            $username_ievade = mysqli_real_escape_string($savienojums, $_POST['username']);
            $epasts_ievade = mysqli_real_escape_string($savienojums, $_POST['epasts']);
            $vards_ievade = mysqli_real_escape_string($savienojums, $_POST['vards']);
            $tiesibas_ievade = mysqli_real_escape_string($savienojums, $_POST['tiesibas']);
            $password_ievade = mysqli_real_escape_string($savienojums, $_POST['password']);

            $sql_query = "SELECT * FROM it_speks_darbinieki WHERE Lietotajvards = '$username'";

            $result = mysqli_query($savienojums, $sql_query);
    
            if(mysqli_num_rows($result) == 1){
                echo "<div class='notif'>Lietotājs ar šo lietotājvārdu jau eksiste!</div>";
            }else{
                $hash = password_hash($password_ievade, PASSWORD_DEFAULT);

                $sql_insert = "INSERT INTO it_speks_darbinieki(Lietotajvards, Epasts, Paradamais_vards, Tiesibas, Parole) VALUES ('$username_ievade', '$epasts_ievade', '$vards_ievade', '$tiesibas_ievade', '$hash')";
                mysqli_query($savienojums, $sql_insert);

                $sql_query = "SELECT * FROM it_speks_darbinieki WHERE Lietotajvards = '$username_ievade'";
                $result = mysqli_query($savienojums, $sql_query);

                echo "<div class='notif'>Lietotājs ir izveidots!</div>";
                header("Refresh: 2");
                
            }
        }else{
            echo "<div class='notif'>Visi ievades lauki nav aizpildīti!
            Mēģiniet vēlreiz! </div>";
            header("Refresh: 2");
        }
    }

    if(isset($_POST['edit'])){
        
    }

?>
