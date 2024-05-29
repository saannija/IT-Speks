<div id="edit-user-window" class="default-popup">
    <div class="row">
        <h2>Lietotājs</h2>
        <button class="default-button" onclick="hideWindow('edit-user-window')"><i class="fas fa-times"></i></button>
    </div>
    <hr>

    <?php
        require "../assets/connect_db.php" ;
        $userId = $username = $email = $name = $role = $password = NULL;


        if (isset($_POST['edit-user'])) {
            $userId = $_POST['edit-user'];

            $sql_query_user = "SELECT * FROM it_speks_darbinieki WHERE Darbinieks_ID = '$userId'";

            $selectUser = mysqli_query($savienojums, $sql_query_user);
            while($data = mysqli_fetch_assoc($selectUser)){
                $username = $data['Lietotajvards'];
                $email = $data['Epasts'];
                $name = $data['Paradamais_vards'];
                $role = $data['Tiesibas'];
            }
        }
     
    ?>

    <form id="user-editing-form" method="post">
        <input type="hidden" name="id" value="<?php echo $userId; ?>">
        <input type="text" id="username" name="username" class="default-input" placeholder="Lietotājvārds" value="<?php echo $username; ?>" required>
        <input type="email" id="epasts" name="epasts" class="default-input" placeholder="E-pasts" value="<?php echo $email; ?>" required>
        <input type="text" id="vards" name="vards" class="default-input" placeholder="Parādāmais vārds" value="<?php echo $name; ?>" required>
        <select name="tiesibas" id="tiesibas">
            <?php
                if($role == NULL){
                    echo "<option value='' disabled selected>Tiesibas</option>
                    <option value='Administrators'>Administrators</option>
                    <option value='Moderators'>Moderators</option>";
                }else{
                    echo "<option value='" . $role . "' selected>" . $role . "</option>";
                    echo ($role == 'Moderators') ? "<option value='Administrators'>Administrators</option>" : "<option value='Moderators'>Moderators</option>";
                }
            ?>

        </select>
        <?php echo ($userId == NULL) ? "" : "<br><p>Ievadiet, ja vēlaties mainīt paroli, vai atstājiet tukšu, lai saglabātu pašreizējo</p>"; ?>
        <input type="password" id="password" name="password" class="default-input" placeholder="Parole">
        <button type="submit" class="default-button" id="save-user" name="save-user" onclick="clearPopupState()">Saglabāt</button>
    </form>
</div>

<div id="background-overlay"></div>

<?php

    if(isset($_POST['save-user'])){
        if(!empty($_POST['username']) && !empty($_POST['epasts']) && !empty($_POST['vards']) && !empty($_POST['tiesibas'])){
            $username_ievade = mysqli_real_escape_string($savienojums, $_POST['username']);
            $epasts_ievade = mysqli_real_escape_string($savienojums, $_POST['epasts']);
            $vards_ievade = mysqli_real_escape_string($savienojums, $_POST['vards']);
            $tiesibas_ievade = mysqli_real_escape_string($savienojums, $_POST['tiesibas']);
            $password_ievade = mysqli_real_escape_string($savienojums, $_POST['password']);

            $hash = password_hash($password_ievade, PASSWORD_DEFAULT);

            if(!empty($_POST['id'])){
                $sql_query = "SELECT * FROM it_speks_darbinieki WHERE Lietotajvards = '$username_ievade' AND Darbinieks_ID != ".$_POST['id'];
                $result = mysqli_query($savienojums, $sql_query);

                if(mysqli_num_rows($result) == 1){
                    echo "<div class='notif red'><i class='fa-solid fa-circle-exclamation'></i> Lietotājs ar šo lietotājvārdu jau eksiste!</div>";
                    header('Refresh:2');
                }else{
                    if(!empty($password_ievade)){
                        $sql_query = "UPDATE it_speks_darbinieki SET Lietotajvards = '$username_ievade', Epasts = '$epasts_ievade', Paradamais_vards = '$vards_ievade', Tiesibas = '$tiesibas_ievade', Parole = '$hash' WHERE Darbinieks_ID =".$_POST['id'];
                    }else{
                        $sql_query = "UPDATE it_speks_darbinieki SET Lietotajvards = '$username_ievade', Epasts = '$epasts_ievade', Paradamais_vards = '$vards_ievade', Tiesibas = '$tiesibas_ievade' WHERE Darbinieks_ID =".$_POST['id'];
                    }
   
                    mysqli_query($savienojums, $sql_query);
                    echo "<div class='notif green'><i class='fa-solid fa-circle-exclamation'></i> Lietotājs ir rediģēts!</div>"; 
                    header('Refresh:2');
                }
            }else{
                if(empty($password_ievade)){
                    echo "<div class='notif yellow'><i class='fa-solid fa-circle-exclamation'></i> Visi ievades lauki nav aizpildīti!
                    Mēģiniet vēlreiz! </div>";
                    header('Refresh:2');
                }else{
                    $sql_query = "SELECT * FROM it_speks_darbinieki WHERE Lietotajvards = '$username_ievade'";
                    $result = mysqli_query($savienojums, $sql_query);
    
                    if(mysqli_num_rows($result) == 1){
                        echo "<div class='notif red'><i class='fa-solid fa-circle-exclamation'></i> Lietotājs ar šo lietotājvārdu jau eksiste!</div>";
                        header('Refresh:2');
                    }else{
                        $sql_query = "INSERT INTO it_speks_darbinieki(Lietotajvards, Epasts, Paradamais_vards, Tiesibas, Parole) VALUES ('$username_ievade', '$epasts_ievade', '$vards_ievade', '$tiesibas_ievade', '$hash')";
    
                        mysqli_query($savienojums, $sql_query);
                        echo "<div class='notif green'><i class='fa-solid fa-circle-exclamation'></i> Lietotājs ir izveidots!</div>"; 
                        header('Refresh:2');
                    }
                }

            }             
            
        }else{
            echo "<div class='notif yellow'><i class='fa-solid fa-circle-exclamation'></i> Visi ievades lauki nav aizpildīti!
            Mēģiniet vēlreiz! </div>";
            header('Refresh:2');
        }
    }

?>
