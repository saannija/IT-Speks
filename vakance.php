<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style_main.css">
    <script src="assets/script.js" defer></script>
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <title>Vakances</title>
</head>
<body>
    <?php
        require "assets/header.php";
        require "assets/connect_db.php";

        if (isset($_GET['id'])){
            $vacancyId = intval($_GET['id']);

            $vacancy_select_SQL = "SELECT * FROM it_speks_vakances WHERE Izdzests = 0 AND Vakance_ID = {$vacancyId}";
            $select_vacancies = mysqli_query($savienojums, $vacancy_select_SQL);

            if(mysqli_num_rows($select_vacancies) > 0){
                while($vacancy = mysqli_fetch_assoc($select_vacancies)){
                    $prof = $vacancy['Profesija'];
                    $comp = $vacancy['Kompanija'];
                    $place = $vacancy['Darba_vieta'];
                    $loc = $vacancy['Atrasanas_vieta'];
                    $load = $vacancy['Slodze'];
                    $salary = $vacancy['Alga'];
                    $desc = $vacancy['Apraksts'];
                    $req = $vacancy['Prasibas'];
                    $offers = $vacancy['Piedavajam'];
                    $reg_date = date("d.m.Y.", strtotime($vacancy['Datums']));
                }
            }
        }
    ?>

    <header id="vacancy-header"> 
        <h2><?php echo $prof; ?></h2>
    </header>

    <section id="vacancy-section">
        <div class="element" id="description">
            <div class="wrapper">
                <h3>Vakances apraksts</h3>
                <p><?php echo $desc; ?></p>
            </div>

            <div class="wrapper">
                <h3>Prasības</h3>
                <ul>
                    <?php
                        $array = explode("|", $req);
                        $array = array_map('trim', $array);

                        foreach ($array as &$value) {
                            echo "<li>{$value}</li>";
                        }
                    ?>
                </ul>
            </div>

            <div class="wrapper">
                <h3>Mēs piedāvājam</h3>
                <ul>
                    <?php
                        $array = explode("|", $offers);
                        $array = array_map('trim', $array);

                        foreach ($array as &$value) {
                            echo "<li>{$value}</li>";
                        }
                    ?>
                </ul>
            </div>

        </div>

        <div class="element" id="summary">
            <h3>Vakances kopsavilkums</h3>
            <ul>
                <li>Publicēts:<strong> <?php echo $reg_date; ?></strong> </li>
                <li>Alga:<strong> <?php echo $salary; ?>€</strong> </li>
                <li>Atrašanās vieta:<strong> <?php echo $loc; ?></strong> </li>
                <li>Darba veids:<strong> <?php echo $load; ?></strong> </li>
                <li>Darba vieta:<strong> <?php echo $place; ?></strong> </li>
            </ul>
        </div>

        <div class="element">
            <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d17601.485656897643!2d21.01436780494168!3d56.533447208670836!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46faa7ccb271be93%3A0xf9d1bf3406ae7d9d!2sLiep%C4%81jas%20Valsts%20tehnikums!5e0!3m2!1sen!2slv!4v1712747037508!5m2!1sen!2slv" width="600" height="450" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <div class="element" id="application">
            <h3>Piesakieties darbam</h3>
            <form method="POST" id="apply-form" enctype="multipart/form-data">
                <div class="wrapper-input">
                    <input type="text" class="default-input defalut-borders" name="vards" placeholder="Vārds">
                    <input type="text" class="default-input defalut-borders" name="uzvards" placeholder="Uzvārds">
                    <input type="text" class="default-input defalut-borders" name="talrunis" placeholder="Tālrunis">
                    <input type="text" class="default-input defalut-borders" name="epasts" placeholder="E-pasts">
                </div>

                <textarea name="komentars" placeholder="Komentāri" id="" class="default-input defalut-borders"></textarea>
                
                <div class="wrapper">
                    <label for="cv" class="upload">
                        Augšupielādēt CV
                    </label>
                    <input id="cv" name="cv" type="file">
                    <button type="submit" name='apply' class="default-button">Pieteikties</button>
                </div>
                <p id="file-info" style="word-wrap: break-word;">Nav izvēlēts neviens fails</p>
            </form>

            <?php
                
                if (isset($_POST['apply'])) {
                    if(!empty($_POST['vards']) && !empty($_POST['uzvards']) && !empty($_POST['talrunis']) && !empty($_POST['epasts'])){
                        $last_id = NULL;

                        if(isset($_FILES['cv']) && $_FILES['cv']['error'] == 0){
                            $sql = "INSERT INTO it_speks_faili (file_name, file_type, file_size, file_content) VALUES (?, ?, ?, ?)";
                            $stmt = mysqli_prepare($savienojums, $sql);
                            $content = file_get_contents($_FILES['cv']['tmp_name']);

                            if ($_FILES['cv']['type'] == 'application/pdf') {
                                if ($stmt) {
                                    mysqli_stmt_bind_param($stmt, "ssis", 
                                        $_FILES['cv']['name'],
                                        $_FILES['cv']['type'],
                                        $_FILES['cv']['size'],
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

                        $name_ievade = mysqli_real_escape_string($savienojums, $_POST['vards']);
                        $lastname_ievade = mysqli_real_escape_string($savienojums, $_POST['uzvards']);
                        $phone_ievade = mysqli_real_escape_string($savienojums, $_POST['talrunis']);
                        $email_ievade = mysqli_real_escape_string($savienojums, $_POST['epasts']);
                        $comment_ievade = mysqli_real_escape_string($savienojums, $_POST['komentars']);

                        $vacancyId = intval($_GET['id']);

                        $insert_sql = "INSERT INTO it_speks_pieteikumi(Vards, Uzvards, Talrunis, Epasts, CV, Komentari, Statuss, ID_vakance) VALUES('$name_ievade', '$lastname_ievade', '$phone_ievade', '$email_ievade', '$last_id', '$comment_ievade', default, '$vacancyId')";

                        mysqli_query($savienojums, $insert_sql);
                        echo "<div class='notif green'><i class='fa-solid fa-circle-exclamation'></i> Pieteikums ir saņemts!</div>"; 
                        echo "<script>
                                setTimeout(function() {
                                    window.location.reload();
                                }, 2000);
                            </script>";       
                        
                    }else{
                        echo "<div class='notif yellow'><i class='fa-solid fa-circle-exclamation'></i> Visi ievades lauki nav aizpildīti!
                        Mēģiniet vēlreiz! </div>";
                        echo "<script>
                                setTimeout(function() {
                                    window.location.reload();
                                }, 2000);
                            </script>";
                    }
                }
            
            ?>

        </div>

    </section>
    
    <?php
        require "assets/footer.php";
    ?>
</body>
</html>