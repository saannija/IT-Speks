<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
        require "assets/statistics.php";

        $keyword = $location = $comp = $place = $sort = $sortOption = NULL;

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(isset($_POST['search-btn'])){
                $keyword = empty($_POST['atslegvardsIndex']) ? NULL : htmlspecialchars($_POST['atslegvardsIndex']);
                $location = empty($_POST['vieta']) ? NULL : $_POST['vieta'];
            }
        

            if(isset($_POST['search-button'])){
                $keyword = empty($_POST['atslegvards']) ? NULL : $_POST['atslegvards'];
                $location = empty($_POST['vieta']) ? NULL : $_POST['vieta'];
                $comp = empty($_POST['kompanija']) ? NULL : $_POST['kompanija'];
                $place = empty($_POST['darba-vieta']) ? NULL : $_POST['darba-vieta'];

                if(empty($_POST['kartot'])){
                    $sort = NULL;
                    $sortOption = NULL;
                }else{
                    switch ($_POST['kartot']) {
                        case 'date':
                            $sortOption = 'date';
                            $sort = "ORDER BY Datums DESC";
                            break;
                        case 'asc':
                            $sortOption = 'asc';
                            $sort = "ORDER BY Profesija";
                            break;
                        case 'desc':
                            $sortOption = 'desc';
                            $sort = "ORDER BY Profesija DESC";
                            break;
                    }
                }
            }

            if (isset($_POST['clear-form'])) {
                $keyword = $location = $comp = $place = $sort = $sortOption = NULL;
            }
        }
    ?>
    <section id="headerSimple-vacancies">
        <h1>Izvēlies no vairāk kā <span class="count">
            <?php echo $vacancyCount; ?>
        </span> piedāvājumiem!</h1>
    </section>
    <main>
    <div class="search-wrapper">
        <button onclick="togglePanel('searchbar-container')" class="default-button" id="toggle-panel-minimized"><i class="fa-solid fa-magnifying-glass"></i></button>
        
        <button class="toggle-btn default-button" id="toggle-panel" onclick="togglePanel('searchbar-container')">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>

        <div id="searchbar-container" class="">
            <form method="POST" id="serchbar-form">
                <div class="wrapper">
                    <input type="text" class="default-input default-borders" name="atslegvards" value="<?php echo $keyword; ?>" placeholder="Meklēt">
                    <button type="submit" id="search-button" class="default-button" name="search-button"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>

                <select name="vieta">
                    <?php
                        if($location == NULL){
                            echo "<option value='' disabled selected>Vieta</option>";
                        }else{
                            echo "<option value='" . $location . "' selected>" . $location . "</option>";
                        }                  

                        $locationSQL = "SELECT DISTINCT Atrasanas_vieta FROM it_speks_vakances WHERE Izdzests = 0";
                        $selectLocation = mysqli_query($savienojums, $locationSQL);

                        if(mysqli_num_rows($selectLocation) > 0){
                            while($locationdb = mysqli_fetch_assoc($selectLocation)){
                                if($location == $locationdb['Atrasanas_vieta']){
                                    continue;
                                }else{
                                    echo "<option value='" . $locationdb['Atrasanas_vieta'] . "'>" . $locationdb['Atrasanas_vieta'] . "</option>";
                                }
                            }
                        }else{
                            echo "<option>Nav nevienas vakances!</option>";
                        }
                    ?>
                </select>
                <select name="kompanija">
                    <option value="" disabled <?php echo ($comp == NULL) ? 'selected' : ''; ?>>Kompānija</option>
                    <?php
                        $companySQL = "SELECT DISTINCT Kompanija FROM it_speks_vakances WHERE Izdzests = 0";
                        $selectCompany = mysqli_query($savienojums, $companySQL);

                        if(mysqli_num_rows($selectCompany) > 0){
                            while($company = mysqli_fetch_assoc($selectCompany)){
                                echo "<option value='" . $company['Kompanija'] . "'" . (($comp === $company['Kompanija']) ? 'selected' : '') . ">" . $company['Kompanija'] . "</option>";
                            }
                        }else{
                            echo "<option>Nav nevienas kompanijas!</option>";
                        }
                    ?>
                </select>

                <div class="buttons-wrapper">
                    <div class="wrapper">
                        <label>
                            <input type="radio" name="darba-vieta" value="attalinati" class="default-input-radio" <?php echo ($place === 'attalinati') ? 'checked' : ''; ?>>
                            <span class="radio-button"> Attālināti </span>
                        </label>
                        <label>
                            <input type="radio" name="darba-vieta" value="klatiene" class="default-input-radio" <?php echo ($place === 'klatiene') ? 'checked' : ''; ?>> 
                            <span class="radio-button"> Klātiene </span>
                        </label>
                    </div>
    
                    <div class="wrapper">
                        <label>
                            <input type="radio" name="kartot" value="date" class="default-input-radio" <?php echo ($sortOption === 'date') ? 'checked' : ''; ?>>
                            <span class="radio-button"> <i class="fa-regular fa-calendar-days"></i> </span>
                        </label>
                        <label>
                            <input type="radio" name="kartot" value="asc" class="default-input-radio" <?php echo ($sortOption === 'asc') ? 'checked' : ''; ?>> 
                            <span class="radio-button"> <i class="fa-solid fa-arrow-up-a-z"></i></span>
                        </label>
                        <label>
                            <input type="radio" name="kartot" value="desc" class="default-input-radio" <?php echo ($sortOption === 'desc') ? 'checked' : ''; ?>> 
                            <span class="radio-button"> <i class="fa-solid fa-arrow-up-z-a"></i> </span>
                        </label>
                    </div>

                    <div class="wrapper">
                        <button type="submit" name="clear-form" class="default-button">Notīrīt <i class="fa-solid fa-delete-left"></i></button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <section id="vacancy-container">
        <?php
            require "assets/connect_db.php";

            $vacanciesSQL = "SELECT * FROM it_speks_vakances WHERE Izdzests = 0 AND Profesija LIKE '%{$keyword}%' AND Atrasanas_vieta LIKE '%{$location}%' AND Kompanija LIKE '%{$comp}%' AND Darba_vieta LIKE '%{$place}%' " . $sort;
            $selectVacancies = mysqli_query($savienojums, $vacanciesSQL);

            $length = 250;
            $desc = NULL;
            $logo= NULL;

            if(mysqli_num_rows($selectVacancies) > 0){
                while($vacancy = mysqli_fetch_assoc($selectVacancies)){
                    if(strlen($vacancy['Apraksts']) <= $length){
                        $desc= $vacancy['Apraksts'];
                    }else{
                        $desc = substr($vacancy['Apraksts'], 0, $length) . "...";
                    }

                    if($vacancy['Logo'] == 0){
                        $logo = "<i class='fa-regular fa-building'></i>";
                    }else{
                        $logo = "<img src='images/image.php?id={$vacancy['Logo']}' class='default-borders'>";
                    }

                    $date = date_create($vacancy['Datums']);
                    $dateDisplay = date_format($date, "d.m.Y.");

                    echo "
                    <a href='vakance.php?id={$vacancy['Vakance_ID']}' target='_blank'>
                        <div class='element'>
                            <div class='logo-container'>
                                {$logo}
                            </div>
            
                            <div class='container'>
                                <div class='title'>
                                    <h2>{$vacancy['Profesija']}</h2>
                                    <p>{$dateDisplay}</p>
                                </div>
            
                                <div class='info-container'>
                                    <p><i class='fa-solid fa-building'></i> <strong>{$vacancy['Kompanija']}</strong></p>
                                    <p><i class='fa-solid fa-location-dot'></i> <strong>{$vacancy['Atrasanas_vieta']}</strong></p>
                                </div>
            
                                <p class='description'>
                                    {$desc}
                                </p>
                            </div>             
                        </div>
                    </a>
                    ";
                    

                }
            }else{
                echo "<div class='text-notif'>Jūsu pieprasījumam nav atrasta neviena vakance</div>";
            }
        ?>
    </section>
        </main>
    <?php
        require "assets/footer.php";
    ?>
</body>
</html>