<div id="edit-appl-window" class="default-popup">
    <div class="row">
        <h2>Pieteikums</h2>
        <button class="default-button" onclick="hideWindow('edit-appl-window')"><i class="fas fa-times"></i></button>
    </div>

    <hr>

    <?php
        require "../assets/connect_db.php" ;

        if (isset($_POST['edit-appl'])) {
            $_SESSION['current_row_id'] = $_POST['edit-appl'];
            $sql_query_appl = "SELECT it_speks_pieteikumi.*, it_speks_vakances.Profesija
                FROM it_speks_pieteikumi 
                INNER JOIN it_speks_vakances ON it_speks_pieteikumi.ID_vakance = it_speks_vakances.Vakance_ID
                WHERE Pieteikums_ID = ".$_SESSION['current_row_id'];

            $selectAppl = mysqli_query($savienojums, $sql_query_appl);
            if(mysqli_num_rows($selectAppl) == 1){
                while($data = mysqli_fetch_assoc($selectAppl)){
                    $fullName = $data['Vards']." ".$data['Uzvards'];
                    $phone = $data['Talrunis'];
                    $email = $data['Epasts'];
                    $vacancy = $data['Profesija'];
                    $cv = $data['CV'];
                    $regDate = date("d.m.Y. H:i:s", strtotime($data['Datums']));
                    $comments = $data['Komentari'];
                    $comments_ans = $data['Komentari_atb'];
                    $status = $data['Statuss'];

                    $_SESSION['application_data'] = $vacancy."|".$email;
                }
            }
        }
    
    ?>

    <table id="pieteikums-table">
        <tr>
            <td>Izvēlētā vakance</td>
            <td class="value"><span><?php echo $vacancy; ?></span></td>
        </tr>
        <tr>
            <td>Vārds, uzvārds</td>
            <td class="value"><?php echo $fullName; ?></td>
        </tr>
        <tr>
            <td>Tālrunis</td>
            <td class="value"><?php echo $phone; ?></td>
        </tr>
        <tr>
            <td>E-pasta adrese</td>
            <td class="value"><?php echo $email; ?></td>
        </tr>
        <tr>
            <td>CV</td>
            <td>
                <?php
                    echo ($cv == 0) ?
                    "<i class='fas fa-times'></i>" :
                    "<a href='pdf.php?id=$cv' target='_blank'><span>Apskatīt</span></a>";
                    ?>
            </td>
        </tr>
        <tr>
            <td>Reģistrēšanās datums</td>
            <td class="value"><?php echo $regDate; ?></td>
        </tr>
        <tr>
            <td>Komentāri</td>
            <td class="value"><?php echo $comments; ?></td>
        </tr>
        <form method="post">
        <tr>
            <td>Pieteikuma stautss:</td>
            <td class="value">
                <?php
                    $sql = "SHOW COLUMNS FROM `it_speks_pieteikumi` LIKE 'Statuss'";
                    $enum = mysqli_query($savienojums, $sql);

                    $enumValues = [];
                    if ($enum && $row = mysqli_fetch_assoc($enum)) {
                        preg_match("/^enum\((.*)\)$/", $row['Type'], $matches);
                        $enumValues = str_getcsv($matches[1], ',', "'");
                    }

                ?>
                <select name="status" class="defaultBorders" required>
                    <?php
                        foreach ($enumValues as $value) {
                            $selected = ($value == $status) ? 'selected' : '';
                            echo "<option value='$value' $selected>$value</option>";
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Jūsu komentārs</td>
            <td><textarea name="comment" class="default-input"><?php echo $comments_ans; ?></textarea></td>

        </tr>
        <tr>
            <td></td>
            <td><button type="submit" class="default-button" name="save-appl-status" onclick="clearPopupState()">Saglabāt</button></td>
        </tr>
        </form>
    </table>

</div>

<div id="background-overlay"></div>

<?php
    if(isset($_POST['save-appl-status'])){
        if(!empty($_POST['status'])){
            $status_ievade = mysqli_real_escape_string($savienojums, $_POST['status']);
            $comments_ievade = mysqli_real_escape_string($savienojums, $_POST['comment']);

            $sql_query_compare = "SELECT Statuss, Komentari_atb, sutit_epastus FROM it_speks_pieteikumi WHERE Pieteikums_ID = ".$_SESSION['current_row_id'];
            $compare = mysqli_query($savienojums, $sql_query_compare);

            while($data = mysqli_fetch_assoc($compare)){
                $status_set = $data['Statuss'];
                $send_mail = $data['sutit_epastus'];
            }

            $status_changed = strcmp($status_set, $status_ievade);

            $sql_query = "UPDATE it_speks_pieteikumi SET Statuss = '$status_ievade', Komentari_atb = '$comments_ievade' WHERE Pieteikums_ID =".$_SESSION['current_row_id'];
            mysqli_query($savienojums, $sql_query);

            $_SESSION['application_data'] .= "|".$status_ievade."|".$status_changed."|".$comments_ievade."|".$send_mail;

            require "../assets/status_mail.php";

            echo "<div class='notif green'><i class='fa-solid fa-circle-exclamation'></i> Statuss ir nomainīts!</div>"; 
            echo "<script>
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                </script>";

        }else{
            echo "<div class='notif yellow'><i class='fa-solid fa-circle-exclamation'></i> Visi ievades lauki nav aizpildīti!
            Mēģiniet vēlreiz! </div>";
            echo "<script>
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                </script>";
        }

        $_SESSION['current_row_id'] = NULL;
    }
?>