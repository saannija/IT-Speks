<div id="create-user-window" class="default-popup">
    <div class="row">
        <h2>Reģistrācija</h2>
        <button class="default-button" onclick="hideWindow('create-user-window'); refreshLogin();"><i class="fas fa-times"></i></button>
    </div>
    <hr>

    <form method="post">
        <input type="text" name="username" class="default-input" placeholder="Lietotājvārds" required>
        <input type="email" name="email" class="default-input" placeholder="E-pasts" required>
        <input type="password" name="password" class="default-input" placeholder="Parole" required>
        <input type="password" name="rep-password" class="default-input" placeholder="Parole atkārtoti" required>

        <p style="margin-top: 1rem;">Neobligāti</p>
        <input type="text" name="name" class="default-input" placeholder="Vārds">
        <input type="text" name="lastname" class="default-input" placeholder="Uzvārds">
        <input type="text" name="phone" class="default-input" placeholder="Tālrunis">

        <button type="submit" class="default-button" id="register-button" name="register" onclick='hideWindow("create-user-window")'>Reģistrēties</button>
    </form>
</div>
<div id="background-overlay"></div>

<?php
    require "connect_db.php";

    if(isset($_POST['register'])){
        if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['rep-password']) && !empty($_POST['email'])){
            $username_ievade = mysqli_real_escape_string($savienojums, $_POST['username']);
            $password_ievade = mysqli_real_escape_string($savienojums, $_POST['password']);
            $password_rep_ievade = mysqli_real_escape_string($savienojums, $_POST['rep-password']);
            $email_ievade = mysqli_real_escape_string($savienojums, $_POST['email']);

            $name_ievade = mysqli_real_escape_string($savienojums, $_POST['name']);
            $lastname_ievade = mysqli_real_escape_string($savienojums, $_POST['lastname']);
            $phone_ievade = mysqli_real_escape_string($savienojums, $_POST['phone']);

            if(strcmp($password_ievade, $password_rep_ievade) != 0){
                echo "<div class='notif red'><i class='fa-solid fa-circle-exclamation'></i> Paroles nav vienādas!
                Mēģiniet vēlreiz! </div>";
                header('Refresh:2');
                return;
            }else{
                $hash = password_hash($password_ievade, PASSWORD_DEFAULT);
            }

            $sql_query = "SELECT * FROM it_speks_lietotaji WHERE Lietotajvards = '$username_ievade'";
            $result = mysqli_query($savienojums, $sql_query);

            if(mysqli_num_rows($result) > 0){
                echo "<div class='notif red'><i class='fa-solid fa-circle-exclamation'></i> Lietotājs ar šo lietotājvārdu jau eksiste! </div>";
                header('Refresh:2');
                return;

            }else{
                $query = "INSERT INTO it_speks_lietotaji(Lietotajvards, Parole, Vards, Uzvards, Talrunis, Epasts) VALUES ('$username_ievade', '$hash', '$name_ievade', '$lastname_ievade', '$phone_ievade', '$email_ievade')";

                if(mysqli_query($savienojums, $query)){
                    echo "<div class='notif green'><i class='fa-solid fa-circle-exclamation'></i> Lietotājs ir izveidots!</div>";
                    echo "<script>
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                    </script>";
                }
            }
            
        }else{
            echo "<div class='notif yellow'><i class='fa-solid fa-circle-exclamation'></i> Visi ievades lauki nav aizpildīti!
            Mēģiniet vēlreiz! </div>";
            header('Refresh:2');
        }
    }
?>