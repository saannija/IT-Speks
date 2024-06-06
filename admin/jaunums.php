<div id="edit-news-window" class="default-popup">
    <div class="row">
        <h2>Jaunums</h2>
        <button class="default-button" onclick="hideWindow('edit-news-window')"><i class="fas fa-times"></i></button>
    </div>

    <hr>

    <?php
        require "../assets/connect_db.php";
        $pic = $headline = $text = $author = NULL;

        if (isset($_POST['edit-news'])) {
            if(!empty($_POST['edit-news'])){
                $_SESSION['current_row_id'] = $_POST['edit-news'];

                $sql_query_news = "SELECT * FROM it_speks_jaunumi WHERE ID = ".$_SESSION['current_row_id'];

                $selectNews = mysqli_query($savienojums, $sql_query_news);
                if(mysqli_num_rows($selectNews) == 1){
                    while($data = mysqli_fetch_assoc($selectNews)){
                        $pic = $data['Attels_ID'];
                        $headline = $data['Virsraksts'];
                        $text = $data['Teksts'];
                        $author = $data['Autors'];
                    }
                }
            }else{
                $_SESSION['current_row_id'] = NULL;
            }
        }
    ?>

    <form id="news-input-form" method="post" enctype="multipart/form-data">
        <div class="content">
            <div class="row">
                <div class="column">
                <div class="image-upload default-borders">
                    <?php echo ($pic == 0) ? "<img src='../images/image-placeholder.jpg' id='preview-image'>" :
                    "<img src='../images/image.php?id={$pic}' id='preview-image'>
                    <input type='hidden' name='imgId' value='$pic'>";
                    ?>
                </div>
                <label for="image-input" class="upload">
                        Augšupielādēt attēlu
                </label>
                <input type="file" id="image-input" name="image-input">
                </div>

            </div>

        </div>

        <div class="content">
            <div>
                <label for="virsraksts">Virsraksts</label>
                <input type="text" id="virsraksts" class="default-input" value="<?php echo $headline; ?>" name="virsraksts" required>
            </div>

            <div>
                <label for="apraksts">Saturs</label>
                <textarea name="apraksts" id="apraksts" class="default-input" required><?php echo $text; ?></textarea>
            </div>

            <div>
                <label for="autors">Autors</label>
                <input type="text" id="autors" class="default-input" value="<?php echo $author; ?>" name="autors" required>
            </div>


            <button type="submit" class="default-button" id="save-button" name="save-news" onclick="clearPopupState()">Saglabāt</button>

        </div>


    </form>

</div>

<div id="background-overlay"></div>

<?php
    if(isset($_POST['save-news'])){
        if(!empty($_POST['virsraksts']) && !empty($_POST['apraksts']) && !empty($_POST['autors'])){
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

            }else if($last_id == 0){
                echo "<div class='notif yellow'><i class='fa-solid fa-circle-exclamation'></i> Augšupielādējiet attēlu!</div>"; 
                echo "<script>
                        setTimeout(function() {
                            window.location.reload();
                        }, 5000);
                    </script>";       
                
                return;
            }

            $headline_ievade = mysqli_real_escape_string($savienojums, $_POST['virsraksts']);
            $text_ievade = mysqli_real_escape_string($savienojums, $_POST['apraksts']);
            $author_ievade = mysqli_real_escape_string($savienojums, $_POST['autors']);

            if($_SESSION['current_row_id'] != NULL){
                $sql_query = "UPDATE it_speks_jaunumi SET Attels_ID = '$last_id', Virsraksts = '$headline_ievade', Teksts = '$text_ievade', Autors = '$author_ievade' WHERE ID =".$_SESSION['current_row_id'];
                    
   
                mysqli_query($savienojums, $sql_query);
                echo "<div class='notif green'><i class='fa-solid fa-circle-exclamation'></i> Ziņa ir rediģēta!</div>"; 
                            echo "<script>
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                </script>";

            }else{
                $sql_query = "INSERT INTO it_speks_jaunumi(Virsraksts, Teksts, Attels_ID, Autors) VALUES ('$headline_ievade', '$text_ievade', '$last_id', '$author_ievade')";

                mysqli_query($savienojums, $sql_query);
                echo "<div class='notif green'><i class='fa-solid fa-circle-exclamation'></i> Ziņa ir izveidota!</div>"; 
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