<!DOCTYPE html>
<html lang="en">
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
        require "assets/login.php";

        $keyword = NULL; $location = NULL;

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(isset($_POST['search-btn'])){
                $keyword = empty($_POST['atslegvardsIndex']) ? NULL : htmlspecialchars($_POST['atslegvardsIndex']);
                $location = empty($_POST['vieta']) ? NULL : $_POST['vieta'];
            }
        }

    ?>

    <section id="headerSimple-vacancies">
        <h1>Izvēlies no vairāk kā <span class="count">120</span> piedāvājumiem!</h1>
    </section>

    <div class="search-wrapper">
        <button onclick="togglePanel('searchbar-container')" class="default-button" id="toggle-panel-minimized"><i class="fa-solid fa-magnifying-glass"></i></button>
        
        <button class="toggle-btn default-button" id="toggle-panel" onclick="togglePanel('searchbar-container')">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>

        <div id="searchbar-container">
            <form method="POST" id="serchbar-form">
                <div class="wrapper">
                    <input type="text" class="default-input default-borders" name="atslegvards" value="<?php echo $keyword; ?>" placeholder="Meklēt">
                    <button type="submit" id="search-button" class="default-button"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>

                <select name="vieta">
                    <option value="" disabled selected>Vieta</option> <!-- need database connection to pass selected value here -->
                    <option value="liepaja">Liepāja</option>
                    <option value="riga">Rīga</option>
                </select>
                <select name="kompanija">
                    <option value="" disabled selected>Kompānija</option>
                    <option value="123">123</option>
                    <option value="312">312</option>
                </select>

                <div class="buttons-wrapper">
                    <div class="wrapper">
                        <label>
                            <input type="radio" name="darba-vieta" value="attalinati" class="default-input-radio">
                            <span class="radio-button"> Attālināti </span>
                        </label>
                        <label>
                            <input type="radio" name="darba-vieta" value="klatiene" class="default-input-radio"> 
                            <span class="radio-button"> Klātiene </span>
                        </label>
                    </div>
    
                    <div class="wrapper">
                        <label>
                            <input type="radio" name="kartot" value="attalinati" class="default-input-radio">
                            <span class="radio-button"> <i class="fa-regular fa-calendar-days"></i> </span>
                        </label>
                        <label>
                            <input type="radio" name="kartot" value="klatiene" class="default-input-radio"> 
                            <span class="radio-button"> <i class="fa-solid fa-arrow-up-a-z"></i></span>
                        </label>
                        <label>
                            <input type="radio" name="kartot" value="klatiene" class="default-input-radio"> 
                            <span class="radio-button"> <i class="fa-solid fa-arrow-up-z-a"></i> </span>
                        </label>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <section id="vacancy-container">
        <a href="vakance.php">
            <div class="element">
                <div class="logo-container">
                    <!-- <img src="images/example.jpg" class="default-borders"> -->
                    <i class="fa-regular fa-building"></i>
                </div>

                <div class="container">
                    <div class="title">
                        <h2>Nosaukums</h2>
                        <p>30.04.2021.</p>
                    </div>

                    <div class="info-container">
                        <p><i class="fa-solid fa-location-dot"></i> Atr. vieta</p>
                        <p><i class="fa-solid fa-building"></i> Kopm Nosaukums</p>
                        <p><i class="fa-solid fa-clock"></i> Slodze</p>
                        <p><i class="fa-solid fa-house-laptop"></i> Darba vieta</p>
                    </div>

                    <p class="description"> <!-- ~200 characters max -->
                        Join our passionate IT team in Liepāja! Develop & deploy cutting-edge cloud applications (Java/Python). We value problem-solvers who thrive in a collaborative & fast-paced environment. Learn, grow, and make a
                    </p>
                </div>             
            </div>
        </a>

        <a href="vakance.php">
            <div class="element">
                <div class="logo-container">
                    <img src="images/example.jpg" class="default-borders">
                </div>

                <div class="container">
                    <div class="title">
                        <h2>Nosaukums</h2>
                        <p>30.04.2021.</p>
                    </div>

                    <div class="info-container">
                        <p><i class="fa-solid fa-location-dot"></i> Atr. vieta</p>
                        <p><i class="fa-solid fa-building"></i> Kopm Nosaukums</p>
                        <p><i class="fa-solid fa-clock"></i> Slodze</p>
                        <p><i class="fa-solid fa-house-laptop"></i> Darba vieta</p>
                    </div>

                    <p class="description"> <!-- ~200 characters max -->

                    </p>
                </div>
            </div>
        </a>

        <a href="vakance.php">
            <div class="element">
                <div class="logo-container">
                    <img src="images/example.jpg" class="default-borders">
                </div>

                <div class="container">
                    <div class="title">
                        <h2>Nosaukums</h2>
                        <p>30.04.2021.</p>
                    </div>

                    <div class="info-container">
                        <p><i class="fa-solid fa-location-dot"></i> Atr. vieta</p>
                        <p><i class="fa-solid fa-building"></i> Kopm Nosaukums</p>
                        <p><i class="fa-solid fa-clock"></i> Slodze</p>
                        <p><i class="fa-solid fa-house-laptop"></i> Darba vieta</p>
                    </div>

                    <p class="description"> <!-- ~200 characters max -->

                    </p>
                </div>
            </div>
        </a>

        <a href="vakance.php">
            <div class="element">
                <div class="logo-container">
                    <img src="images/example.jpg" class="default-borders">
                </div>

                <div class="container">
                    <div class="title">
                        <h2>Nosaukums</h2>
                        <p>30.04.2021.</p>
                    </div>

                    <div class="info-container">
                        <p><i class="fa-solid fa-location-dot"></i> Atr. vieta</p>
                        <p><i class="fa-solid fa-building"></i> Kopm Nosaukums</p>
                        <p><i class="fa-solid fa-clock"></i> Slodze</p>
                        <p><i class="fa-solid fa-house-laptop"></i> Darba vieta</p>
                    </div>

                    <p class="description"> <!-- ~200 characters max -->

                    </p>
                </div>
            </div>
        </a>

        <a href="vakance.php">
            <div class="element">
                <div class="logo-container">
                    <img src="images/example.jpg" class="default-borders">
                </div>

                <div class="container">
                    <div class="title">
                        <h2>Nosaukums</h2>
                        <p>30.04.2021.</p>
                    </div>

                    <div class="info-container">
                        <p><i class="fa-solid fa-location-dot"></i> Atr. vieta</p>
                        <p><i class="fa-solid fa-building"></i> Kopm Nosaukums</p>
                        <p><i class="fa-solid fa-clock"></i> Slodze</p>
                        <p><i class="fa-solid fa-house-laptop"></i> Darba vieta</p>
                    </div>

                    <p class="description"> <!-- ~200 characters max -->

                    </p>
                </div>
            </div>
        </a>

        <a href="vakance.php">
            <div class="element">
                <div class="logo-container">
                    <img src="images/example.jpg" class="default-borders">
                </div>

                <div class="container">
                    <div class="title">
                        <h2>Nosaukums</h2>
                        <p>30.04.2021.</p>
                    </div>

                    <div class="info-container">
                        <p><i class="fa-solid fa-location-dot"></i> Atr. vieta</p>
                        <p><i class="fa-solid fa-building"></i> Kopm Nosaukums</p>
                        <p><i class="fa-solid fa-clock"></i> Slodze</p>
                        <p><i class="fa-solid fa-house-laptop"></i> Darba vieta</p>
                    </div>

                    <p class="description"> <!-- ~200 characters max -->

                    </p>
                </div>
            </div>
        </a>

        <a href="vakance.php">
            <div class="element">
                <div class="logo-container">
                    <img src="images/example.jpg" class="default-borders">
                </div>

                <div class="container">
                    <div class="title">
                        <h2>Nosaukums</h2>
                        <p>30.04.2021.</p>
                    </div>

                    <div class="info-container">
                        <p><i class="fa-solid fa-location-dot"></i> Atr. vieta</p>
                        <p><i class="fa-solid fa-building"></i> Kopm Nosaukums</p>
                        <p><i class="fa-solid fa-clock"></i> Slodze</p>
                        <p><i class="fa-solid fa-house-laptop"></i> Darba vieta</p>
                    </div>

                    <p class="description"> <!-- ~200 characters max -->
                        Unleash your coding potential!  We're searching for a talented developer in Liepāja to join our fast-growing IT team.  Develop and deploy cutting-edge cloud applications using your Java/Python expertise.
                    </p>
                </div>
            </div>
        </a>
    </section>

    <?php
        require "assets/footer.php";
    ?>
</body>
</html>