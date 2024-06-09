<div id="view-user-appl-window" class="default-popup">
    <div class="row">
        <h2>Pieteikums</h2>
        <button class="default-button" onclick="hideWindow('view-user-appl-window')"><i class="fas fa-times"></i></button>
    </div>

    <hr>

    <?php
        require "assets/connect_db.php" ;

        if (isset($_POST['view-appl'])) {
            $_SESSION['current_row_id'] = $_POST['view-appl'];
            $sql_query_appl = "SELECT it_speks_pieteikumi.*, it_speks_vakances.Profesija, it_speks_vakances.Kompanija, it_speks_vakances.Atrasanas_vieta
                FROM it_speks_pieteikumi 
                INNER JOIN it_speks_vakances ON it_speks_pieteikumi.ID_vakance = it_speks_vakances.Vakance_ID
                WHERE Pieteikums_ID = ".$_SESSION['current_row_id'];

            $selectAppl = mysqli_query($savienojums, $sql_query_appl);
            while($data = mysqli_fetch_assoc($selectAppl)){
                $vacancy = $data['Profesija'];
                $company = $data['Kompanija'];
                $location = $data['Atrasanas_vieta'];
                $regDate = date("d.m.Y. H:i:s", strtotime($data['Datums']));
                $comments = $data['Komentari'];
                $comments_ans = $data['Komentari_atb'];
                $status = $data['Statuss'];
            }
            
        }
    
    ?>

    <table id="pieteikums-table">
        <tr>
            <td>Pieteikuma stautss:</td>
            <td class="value"><?php echo $status; ?></td>
        </tr>
        <tr>
            <td>Izvēlētā vakance</td>
            <td class="value"><span><?php echo $vacancy; ?></span></td>
        </tr>
        <tr>
            <td>Kompānija</td>
            <td class="value"><?php echo $company; ?></td>
        </tr>
        <tr>
            <td>Atrašanās vieta</td>
            <td class="value"><?php echo $location; ?></td>
        </tr>
        <tr>
            <td>Jūsu komentāri</td>
            <td class="value"><?php echo $comments; ?></td>
        </tr>
        <tr>
            <td>Pievienotie komentāri</td>
            <td class="value"><?php echo $comments_ans; ?></td>
        </tr>
        <tr>
            <td>Datums</td>
            <td class="value"><?php echo $regDate; ?></td>
        </tr>
    </table>

</div>
<div id="background-overlay"></div>