<?php
    session_start();
    if(!isset($_SESSION["lietotajs"])){
        header("location:index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style_main.css">
    <script src="assets/script.js" defer></script>
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <title>Pieteikumi</title>
</head>
<body>
    <main>
    <?php
        require "assets/header.php";
        require "pieteikums.php";

        require "assets/connect_db.php";

        $username = $_SESSION['lietotajs'];
        $select_user = "SELECT * FROM it_speks_lietotaji WHERE Lietotajvards = '$username'";
        $user = mysqli_query($savienojums, $select_user);
        while($data = mysqli_fetch_array($user)){
            $userId = $data['Lietotajs_ID'];
            $name = $data['Vards'];
            $lastname = $data['Uzvards'];
            ($data['Talrunis'] == 0 ? $phone = NULL : $phone = $data['Talrunis']);
            $email = $data['Epasts'];
        }
    ?>

    <section id="admin-section">
        <div class="table-heading">
            Lietotāja informācija
            <button class="default-button" onclick="enableEditing()" id="enableEditing" type="button"><i class="fa-solid fa-pen-to-square"></i></button>
        </div>
        <form method="post" id="user-appl-form">
            <div class="wrapper">
                <label for="name">Vārds</label>
                <input type="text" name="name" value="<?php echo $name; ?>" readonly class="default-input">

                <label for="lastname">Uzvārds</label>
                <input type="text" name="lastname" value="<?php echo $lastname; ?>" readonly class="default-input">

                <label for="phone">Tālrunis</label>
                <input type="text" name="phone" value="<?php echo $phone; ?>" readonly class="default-input">

                <label for="email">E-pasts</label>
                <input type="email" name="email" value="<?php echo $email; ?>" readonly class="default-input">
                <button class="default-button" id="save-user-info" name="save-user-info" type="submit" style="display: none;">Saglabāt</button>
            </div>
        </form>

        <div class="table-heading">Pieteikumu vēsture</div>
            <table id="user-appl-table">
                <th>Vakance</th>
                <th>Kompanija</th>
                <th>Datums</th>
                <th>Pievienotie komentāri</th>
                <th>Statuss</th>
                <th></th>

                <?php
                    $appl_SQL = "SELECT it_speks_pieteikumi.*, it_speks_vakances.Profesija, it_speks_vakances.Kompanija
                        FROM it_speks_pieteikumi 
                        INNER JOIN it_speks_vakances ON it_speks_pieteikumi.ID_vakance = it_speks_vakances.Vakance_ID
                        WHERE it_speks_pieteikumi.Izdzests = 0 AND it_speks_pieteikumi.ID_Lietotajs = '$userId' ORDER BY Datums DESC";
                    $select_appl = mysqli_query($savienojums, $appl_SQL);

                    while($appl = mysqli_fetch_array($select_appl)){
                        $Komentars_atb = (empty($appl['Komentari_atb'])) ?
                             "<i class='fas fa-times'></i>" : "<i class='fas fa-check'></i>";

                        echo "
                            <tr>
                                <td>{$appl['Profesija']}</td>
                                <td>{$appl['Kompanija']}</td>
                                <td>".date("d.m.Y. H:i:s", strtotime($appl['Datums']))."</td>
                                <td>{$Komentars_atb}</td>
                                <td>{$appl['Statuss']}</td>
                                <td>
                                    <form method='post'>
                                        <button type='submit' name='view-appl' value='{$appl['Pieteikums_ID']}' onclick='showWindow(\"view-user-appl-window\")' class='default-button'>Apskatīt</button>
                                    </form>
                                </td>
                            </tr>
                        ";
                    }
                ?>
            </table>
        </div>
    </section>
    </main>
    <?php
        require "assets/footer.php";
        
        if(isset($_POST['save-user-info'])){
            $name_ievade = mysqli_real_escape_string($savienojums, $_POST['name']);
            $lastname_ievade = mysqli_real_escape_string($savienojums, $_POST['lastname']);
            $phone_ievade = mysqli_real_escape_string($savienojums, $_POST['phone']);
            $email_ievade = mysqli_real_escape_string($savienojums, $_POST['email']);

            $sql_query = "UPDATE it_speks_lietotaji SET Vards = '$name_ievade', Uzvards = '$lastname_ievade', Talrunis = '$phone_ievade', Epasts = '$email_ievade'";
            mysqli_query($savienojums, $sql_query);
            echo "<script>
                    setTimeout(function() {
                        window.location.reload();
                    }, 0);
                </script>";
        }
    ?>
</body>
</html>