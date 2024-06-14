    <?php
        session_start();
        require "login.php";
        require "create_user.php";
        require "password_reset.php";
        require "connect_db.php";
    ?>
    
    <header id="main">
        <a href="index.php" class="logo">IT Spēks</a>
        <nav id="navbar">
            <a href="index.php">Sākumlapa</a>
            <a href="index.php#services">Pakalpojumi</a>
            <a href="vakances.php">Vakances</a>
            <a href="jaunumi.php">Jaunumi</a>
            <a href="index.php#about">Kontakti</a>
            <?php
                if(isset($_SESSION["lietotajvards"])){
                    echo "
                        <a href='./admin/index.php'>Administratora panelis</a>
                        <a id='logout' href='./assets/logout.php'><i class='fa-solid fa-arrow-right-from-bracket'></i></a>
                    ";
                }elseif(isset($_SESSION["lietotajs"])){
                    echo "
                        <a href='./pieteikumi.php'>Mani pieteikumi</a>
                        <a id='logout' href='./assets/logout.php'><i class='fa-solid fa-arrow-right-from-bracket'></i></a>
                    ";
                }else{
                    echo "
                        <button id='logout' class='default-button' onclick=\"showWindow('login-window')\">Autorizācija</button>
                    ";
                }
            ?>
            <div id="modes" class="fa-regular fa-moon"></div>
        </nav>
        <button class="toggle-btn default-button" onclick="togglePanel('navbar')">
            <i class="fas fa-bars"></i>
        </button>
    </header>