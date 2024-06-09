<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_main.css">
    <title>Atjaunot paroli</title>
</head>
<body>
    <div class="heading">
        <p>IT-Speks</p>
    </div>
    <div id="update-password" class="default-popup show">
        <div class="row">
            <h2>Atjaunot paroli</h2>
        </div>
        <hr>

        <?php
            require "connect_db.php";

            $_SESSION['hideForm'] = false;
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if(isset($_POST['save-password'])){
                    $token = $_POST['token'];
                    $role = $_GET['role'];
                    $newPassword = $_POST['new_password'];
                    $confirmPassword = $_POST['confirm_password'];

                    if ($newPassword !== $confirmPassword) {
                        echo "Paroles nesakrīt.";
                        exit;
                    }

                    $query = "SELECT user_id, expires FROM it_speks_paroles_atj WHERE token = ?";
                    $stmt = $savienojums->prepare($query);
                    $stmt->bind_param("s", $token);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $reset = $result->fetch_assoc();
                        $userId = $reset['user_id'];
                        $expires = $reset['expires'];

                        if (strtotime($expires) > time()) {
                            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
                            if($role == "admin"){
                                $query = "UPDATE it_speks_darbinieki SET Parole = ? WHERE Darbinieks_ID = ?";
                            }else{
                                $query = "UPDATE it_speks_lietotaji SET Parole = ? WHERE Lietotajs_ID = ?";
                            }
                            $stmt = $savienojums->prepare($query);
                            $stmt->bind_param("si", $hashedPassword, $userId);
                            $stmt->execute();


                            $query = "DELETE FROM it_speks_paroles_atj WHERE token = ?";
                            $stmt = $savienojums->prepare($query);
                            $stmt->bind_param("s", $token);
                            $stmt->execute();

                            $_SESSION['hideForm'] = true;
                            echo "Jūsu parole ir atjaunota.";
                            echo "
                                <a href='../index.php'>UZ SĀKUMLAPU</a>
                            ";
                        } else {
                            $_SESSION['hideForm'] = true;
                            echo "Šīs atiestatīšanas saites derīguma termiņš ir beidzies.";
                        }
                    } else {
                        $_SESSION['hideForm'] = true;
                        echo "Nederīga atiestatīšanas saite.";
                    }
                }
            }


            echo '<div style="display: '.($_SESSION['hideForm'] ? 'none' : 'flex') . ';">';
        ?>
            <form method='post'>
                <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
                <label for="new_password">Jauna parole:</label>
                <input type="password" name="new_password" id="new_password" class="default-input" required>
                <label for="confirm_password">Jaunās paroles apstiprināšana:</label>
                <input type="password" name="confirm_password" id="confirm_password" class="default-input" required>
                <button type="submit" name="save-password" id="save-password" class="default-button">Iesniegt</button>
            </form>
        </div>


    </div>
</body>
</html>


