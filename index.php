<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Spēks</title>
    <link rel="stylesheet" href="assets/style_main.css">
    <script src="assets/script.js" defer></script>
    <!-- <link rel="shortcut icon" href="images/lvt.png" type="image/x-icon"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
</head>
<body>
    <?php
        require "assets/header.php";
        require "assets/login.php";
    ?>

    <section id="header">
        <div class="left">
            <h1>Atrodiet <span>savu nākotnes</span> darbu IT jomā Latvijā!</h1>

            <div class="searchbar">
                <!-- <button onclick="togglePanel('searchbar-container')" class="default-button" id="toggle-panel"><i class="fa-solid fa-magnifying-glass"></i></button> -->
    
                <div id="search-container">
                    <form method="POST" id="search-form">
                        
                        <input type="text" class="default-input default-borders" name="atslegvardsIndex" placeholder="Atslēgvārds">
                        
                        <select name="vieta">
                            <option value="" disabled selected>Vieta</option>
                            <option value="liepaja">Liepāja</option>
                            <option value="riga">Rīga</option>
                        </select>

                        <button type="submit" id="search-btn" class="default-button">Meklēt</button>
                    
                    </form>
                </div>
            </div>

            <p class="info-text">Izvēlies no vairāk kā <span>120</span> piedāvājumiem!</p>
        </div>
        <div class="right"></div>
    </section>

    <section id="statistics">
        <h2>Mūsu aģentūras statistika</h2>
        <div class="stats">
            <div class="stat">
                <p class="num">34</p>
                <p>Vakances</p>
            </div>
            <div class="stat">
                <p class="num">15</p>
                <p>Kompānijas</p>
            </div>
            <div class="stat">
                <p class="num">100+</p>
                <p>Pieteikumi</p>
            </div>
        </div>
    </section>

    <section id="services">
        <h2>Mūsu pakalpojumi</h2>
        <div class="circles-all">
            <!-- pievienot clicable links ()))))))))) -->
            <div class="circles">
                <div class="circle">
                    <h3>Piesakies vakancēm</h3>
                </div>
                <div class="circle">
                    <h3>Uzzini jaunumus IT jomā</h3>
                </div>
                <div class="circle">
                    <h3>Publicē sava uzņēmuma vakances</h3>
                </div>
            </div>
            <div class="circles-back">
                <div class="circle-back"></div>
                <div class="circle-back"></div>
            </div>
        </div>
        
    </section>

    <section id="about">
        <div class="left">
            <h1><span>Sazinies</span> ar mums!</h1>
            <form action="">
                <input type="text" placeholder="Vārds" class="box">
                <input type="email" placeholder="E-pasts" class="box">
                <input type="tel" placeholder="Tālrunis" class="box">
                <textarea name="" placeholder="Jūsu ziņa..." required class="box"></textarea>
                <button type="submit" name="sendMsg" class="btn">Sazināties</button>
            </form>
        </div>
        <div class="right">
            <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d17601.485656897643!2d21.01436780494168!3d56.533447208670836!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46faa7ccb271be93%3A0xf9d1bf3406ae7d9d!2sLiep%C4%81jas%20Valsts%20tehnikums!5e0!3m2!1sen!2slv!4v1712747037508!5m2!1sen!2slv" width="600" height="450" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <?php
        require "assets/footer.php";
    ?>
</body>
</html>