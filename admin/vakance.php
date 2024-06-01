<div id="edit-vacancy-window" class="default-popup">
    <div class="row">
        <h2>Vakance</h2>
        <button class="default-button" onclick="hideWindow('edit-vacancy-window')"><i class="fas fa-times"></i></button>
    </div>

    <hr>

    <?php
        require "../assets/connect_db.php" ;
        $logo = $prof = $comp = $place = $loc = $load = $salary = $desc = $req = $offers = NULL;

        if (isset($_POST['edit-vac'])) {
            if(!empty($_POST['edit-vac'])){
                $_SESSION['current_row_id'] = $_POST['edit-vac'];

                $sql_query_vac = "SELECT * FROM it_speks_vakances WHERE Vakance_ID = ".$_SESSION['current_row_id'];

                $selectVac = mysqli_query($savienojums, $sql_query_vac);
                if(mysqli_num_rows($selectVac) == 1){
                    while($data = mysqli_fetch_assoc($selectVac)){
                        $logo = $data['Logo'];
                        $prof = $data['Profesija'];
                        $comp = $data['Kompanija'];
                        $place = $data['Darba_vieta'];
                        $loc = $data['Atrasanas_vieta'];
                        $load = $data['Slodze'];
                        $salary = $data['Alga'];
                        $desc = $data['Apraksts'];
                        $req = $data['Prasibas'];
                        $offers = $data['Piedavajam'];
                    }
                }
            }else{
                $_SESSION['current_row_id'] = NULL;
            }
        }
    ?>

    <form method="post" id="vacancy-input-form" enctype="multipart/form-data">
        <div class="content">
            <div class="row">
                <div class="column">
                <div class="image-upload default-borders">
                    <?php echo ($logo == 0) ? "<img src='../images/image-placeholder.jpg' id='preview-image'>" :
                    "<img src='../images/image.php?id={$logo}' id='preview-image'>
                    <input type='hidden' name='imgId' value='$logo'>"; ?>
                </div>
                <label for="image-input" class="upload">
                        Augšupielādēt Logo
                </label>
                <input type="file" id="image-input" name="image-input">
                </div>



                <div class="column">
                    <label for="prof">Profesijas nosaukums</label>
                    <input type="text" id="prof" class="default-input" value="<?php echo $prof; ?>" name="prof" required>

                    <label for="komp">Kompānijas nosaukums</label>
                    <input type="text" id="komp" class="default-input" value="<?php echo $comp; ?>" name="comp" required>

                    <label for="avieta">Atrašanās vieta</label>
                    <input type="text" id="avieta" class="default-input" value="<?php echo $loc; ?>" name="loc" required>
                
                    <label for="dvieta">Darba vieta</label>
                    <?php
                        $sql = "SHOW COLUMNS FROM `it_speks_vakances` LIKE 'Darba_vieta'";
                        $enum = mysqli_query($savienojums, $sql);

                        $enumValues = [];
                        if ($enum && $row = mysqli_fetch_assoc($enum)) {
                            preg_match("/^enum\((.*)\)$/", $row['Type'], $matches);
                            $enumValues = str_getcsv($matches[1], ',', "'");
                        }

                    ?>

                    <select name="dvieta" id="dvieta" required>
                        <?php
                            foreach ($enumValues as $value) {
                                $selected = ($value == $place) ? 'selected' : '';
                                echo "<option value='$value' $selected>$value</option>";
                            }
                        ?>
                    </select>

                    <label for="slodze">Slodze</label>
                    <?php
                        $sql = "SHOW COLUMNS FROM `it_speks_vakances` LIKE 'Slodze'";
                        $enum = mysqli_query($savienojums, $sql);

                        $enumValues = [];
                        if ($enum && $row = mysqli_fetch_assoc($enum)) {
                            preg_match("/^enum\((.*)\)$/", $row['Type'], $matches);
                            $enumValues = str_getcsv($matches[1], ',', "'");
                        }

                    ?>

                    <select name="slodze" id="slodze" required>
                        <?php
                            foreach ($enumValues as $value) {
                                $selected = ($value == $load) ? 'selected' : '';
                                echo "<option value='$value' $selected>$value</option>";
                            }
                        ?>
                    </select>
                                
                    <label for="alga">Alga</label>
                    <input type="number" id="alga" class="default-input" value="<?php echo $salary; ?>" name="alga" required>

                </div>

            </div>

        </div>

        <div class="content">
                <label for="apraksts">Vakances apraksts</label>
                <textarea name="apraksts" id="apraksts" class="default-input"><?php echo $desc; ?></textarea>

                <div class="container">
                <div id="list-container">
                        <label for="prasibas">Prasības</label>
                        <ul id='prasibas-item-list'>
                        <?php
                            if($req == NULL){
                                echo "<li><input type='text' id='prasibas' name='prasibas[]' class='default-input'></li>";
                            }else{
                                $array = explode("|", $req);
                                $array = array_map('trim', $array);
        
                                foreach ($array as &$value) {
                                    echo "<script>
                                    list = document.getElementById('prasibas-item-list');
  
                                    newListItem = document.createElement('li');
                                    newInputField = document.createElement('input');
                                
                                    newInputField.className = 'default-input';
                                    newInputField.type = 'text';
                                    newInputField.name = 'prasibas[]';
                                    newInputField.value = '{$value}';
                                
                                    newListItem.appendChild(newInputField);
                                    list.appendChild(newListItem);
                                    </script>";
                                }
                            }
                        ?>
                        </ul>
                        <button class="default-button" onclick="createNewItem('prasibas-item-list', '', 'prasibas[]')" type="button">Pievienot</button>
                </div>

                <div id="list-container">
                        <label for="piedavajam">Mēs piedāvājam</label>
                        <ul id="piedavajam-item-list">
                            <?php
                                if($offers == NULL){
                                    echo "<li><input type='text' id='piedavajam' name='piedavajam[]' class='default-input'></li>";
                                }else{
                                    $array = explode("|", $offers);
                                    $array = array_map('trim', $array);
            
                                    foreach ($array as &$value) {
                                        echo "<script>
                                        list = document.getElementById('piedavajam-item-list');
    
                                        newListItem = document.createElement('li');
                                        newInputField = document.createElement('input');
                                    
                                        newInputField.className = 'default-input';
                                        newInputField.type = 'text';
                                        newInputField.name = 'piedavajam[]';
                                        newInputField.value = '{$value}';
                                    
                                        newListItem.appendChild(newInputField);
                                        list.appendChild(newListItem);
                                        </script>";
                                    }
                                }
                            ?>
                        </ul>
                        <button class="default-button" onclick="createNewItem('piedavajam-item-list', '', 'piedavajam[]')" type="button">Pievienot</button>
                </div>

                <button type="submit" class="default-button" id="save-button" name="save-vac" onclick="clearPopupState()">Saglabāt</button>
                </div>
                
        </div>

    </form>
    

</div>

<div id="background-overlay"></div>

<?php

    if(isset($_POST['save-vac'])){
        if(!empty($_POST['prof']) && !empty($_POST['comp']) && !empty($_POST['loc']) && !empty($_POST['dvieta']) && !empty($_POST['slodze']) && !empty($_POST['alga']) && !empty($_POST['apraksts'])){
            $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            $last_id = $_POST['imgId'];

            if(isset($_FILES['image-input']) && $_FILES['image-input']['error'] == 0){
                $sql = "INSERT INTO it_speks_faili (file_name, file_type, file_size, file_content) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_prepare($savienojums, $sql);
                $content = file_get_contents($_FILES['image-input']['tmp_name']);

                if (in_array($_FILES['image-input']['type'], $allowedMimeTypes)) {
                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, "ssis", 
                            $_FILES['image-input']['name'],
                            $_FILES['image-input']['type'],
                            $_FILES['image-input']['size'],
                            $content
                        );
            
                        mysqli_stmt_execute($stmt);
                    }

                    $last_id = $savienojums->insert_id;

                } else {
                    echo "<div class='notif yellow'><i class='fa-solid fa-circle-exclamation'></i> Faila tips nav atļauts!</div>"; 
                    echo "<script>
                            setTimeout(function() {
                                window.location.reload();
                            }, 2000);
                        </script>";       
                    
                    return;
                }

            }


            $reqValues = $_POST['prasibas'];
            $nonEmptyReqValues = array_filter($reqValues, function($reqValue) {
                return !empty($reqValue);
            });
            $reqResult = implode('|', $nonEmptyReqValues);


            $offerValues = $_POST['piedavajam'];
            $nonEmptyOfferValues = array_filter($offerValues, function($offerValue) {
                return !empty($offerValue);
            });
            $offerResult = implode('|', $nonEmptyOfferValues);

            $prof_ievade = mysqli_real_escape_string($savienojums, $_POST['prof']);
            $comp_ievade = mysqli_real_escape_string($savienojums, $_POST['comp']);
            $loc_ievade = mysqli_real_escape_string($savienojums, $_POST['loc']);
            $place_ievade = mysqli_real_escape_string($savienojums, $_POST['dvieta']);
            $load_ievade = mysqli_real_escape_string($savienojums, $_POST['slodze']);
            $salary_ievade = mysqli_real_escape_string($savienojums, $_POST['alga']);
            $desc_ievade = mysqli_real_escape_string($savienojums, $_POST['apraksts']);

            if($_SESSION['current_row_id'] != NULL){
                $sql_query = "UPDATE it_speks_vakances SET Logo = '$last_id', Profesija = '$prof_ievade', Kompanija = '$comp_ievade', Darba_vieta = '$place_ievade', Atrasanas_vieta = '$loc_ievade', Slodze = '$load_ievade', Alga = '$salary_ievade', Apraksts = '$desc_ievade', Prasibas = '$reqResult', Piedavajam = '$offerResult' WHERE Vakance_ID =".$_SESSION['current_row_id'];
                    
   
                mysqli_query($savienojums, $sql_query);
                echo "<div class='notif green'><i class='fa-solid fa-circle-exclamation'></i> Vakance ir rediģēta!</div>"; 
                            echo "<script>
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                </script>";

            }else{
                $sql_query = "INSERT INTO it_speks_vakances(Logo, Profesija, Kompanija, Darba_vieta, Atrasanas_vieta, Slodze, Alga, Apraksts, Prasibas, Piedavajam) VALUES ('$last_id', '$prof_ievade', '$comp_ievade', '$place_ievade', '$loc_ievade', '$load_ievade', '$salary_ievade', '$desc_ievade', '$reqResult', '$offerResult')";

                mysqli_query($savienojums, $sql_query);
                echo "<div class='notif green'><i class='fa-solid fa-circle-exclamation'></i> Vakance ir izveidota!</div>"; 
                            echo "<script>
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                </script>";

            }             
            
        }else{
            echo "<div class='notif yellow'><i class='fa-solid fa-circle-exclamation'></i> Visi ievades lauki nav aizpildīti!
            Mēģiniet vēlreiz! </div>";
                        echo "<script>
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                </script>";
        }

        $_SESSION['current_row_id'] = NULL;
    }

?>