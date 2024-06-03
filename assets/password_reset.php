<div id="password-reset-window" class="default-popup">
    <div class="row">
        <h2>Atjaunot paroli</h2>
        <button class="default-button" onclick="hideWindow('password-reset-window')"><i class="fas fa-times"></i></button>
    </div>
    <hr>

    <form method='post'>
        <p>Lai mainītu paroli, mums ir jāapstiprina jūsu identitāte.<br>Lūdzu, ierakstiet savu lietotājvārdu</p>
        <div class="wrapper">
            <input type="text" name="user" id="user" class="default-input" placeholder="Lietotājvārds" required>
            <button type="submit" class="default-button" id="reset" name="reset" onclick="hideWindow('password-reset-window')"><i class="fa-solid fa-arrow-right"></i></button>
        </div>

    </form>
</div>
<div id="background-overlay"></div>

<?php
        require "connect_db.php";

        if(isset($_POST['reset'])){
            $username = $_POST['user'];

            $query = "SELECT Darbinieks_ID, Epasts FROM it_speks_darbinieki WHERE Lietotajvards = '{$username}'";
            $result = mysqli_query($savienojums, $query);

            if (mysqli_num_rows($result) > 0) {
                while($user = mysqli_fetch_array($result)){
                    $userId = $user['Darbinieks_ID'];
                    $email = $user['Epasts'];
                }    

                $token = bin2hex(random_bytes(16));
                $expires = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token valid for 1 hour


                $query = "INSERT INTO it_speks_paroles_atj (user_id, token, expires) VALUES (?, ?, ?)";
                $stmt = $savienojums->prepare($query);
                $stmt->bind_param("iss", $userId, $token, $expires);
                $stmt->execute();
                

                $resetLink = "http://kristovskis.lv/3pt1/romazanova/IT-Speks/assets/password_update.php?token=$token";
                $subject = "Paroles atjaunošana";
                $message = "Lai atiestatītu paroli, noklikšķiniet uz tālāk norādītās saites:\n$resetLink";
                $headers = "From: no-reply@IT-Speks.com";

                mail($email, $subject, $message, $headers);
                
                echo "<div class='notif green long'><i class='fa-solid fa-circle-exclamation'></i>Ziņojums ar paroles atiestatīšanas saiti ir nosūtīts uz e-pasta adresi, kas saistīta ar jūsu norādīto lietotājvārdu.<br><br>Lūdzu, pārbaudiet savu e-pasta iesūtni un izpildiet norādījumus, lai atiestatītu paroli.</div>";

                echo "<script>
                setTimeout(function() {
                    window.location.reload();
                }, 5000);
                </script>";
            } else {
                echo "Nav atrasts lietotājs ar šo lietotājvārdu.";
            }
        }
    ?>



