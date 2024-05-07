<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Spēks</title>
    <link rel="stylesheet" href="assets/style_main.css">
    <!-- <link rel="shortcut icon" href="images/lvt.png" type="image/x-icon"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
</head>
<body>
    <header>
        <a href="#" class="logo">IT Spēks</a>
        <nav id="navbar">
            <a href="#">Sākumlapa</a>
            <a href="#">Pakalpojumi</a>
            <a href="#">Vakances</a>
            <a href="#">Jaunumi</a>
            <a href="#">Kontakti</a>
            <a href="#">Autorizācija</a>
        </nav>
    </header>

    <section id="header">
        <div class="left">
            <h1>Atrodiet <span>savu nākotnes</span> darbu IT jomā Latvijā!</h1>
            <div class="search">form input select button</div>
            <p>Izvēlēties no vairāk kā 120 piedāvājumiem!</p>
        </div>
        <div class="right">
            
        </div>
    </section>

    <section id="statistics">
        <h2>Mūsu aģentūras statistika</h2>
        <div class="stats">
            <div class="stat">
                <p>34</p>
                <p>Vakances</p>
            </div>
            <div class="stat">
                <p>15</p>
                <p>Kompānijas</p>
            </div>
            <div class="stat">
                <p>100+</p>
                <p>Pieteikumi</p>
            </div>
        </div>
    </section>

    <section id="services">
        <h2>Mūsu pakalpojumi</h2>
        <div class="circles">
            <div class="circle">
                <h3>Piesakies vakancēm</h3>
            </div>
            <!-- kaut ka tos aplus kas ir aiz main apliem attēlot -->
            <div class="circle-back"></div>
            <div class="circle">
                <h3>Uzzini jaunumus IT jomā</h3>
            </div>
            <div class="circle-back"></div>
            <div class="circle">
                <h3>Publicē sava uzņēmuma vakances</h3>
            </div>
        </div>
    </section>

    <section id="about">
        <div class="left">
            <h1><span>Sazinies</span> ar mums!</h1>
            <form action="">
                <input type="text" placeholder="Vārds">
                <input type="email" placeholder="E-pasts">
                <input type="tel" placeholder="Tālrunis">
                <textarea name="" placeholder="Jūsu komentāri" required></textarea>
                <button type="submit" name="sendMsg" class="btn">Sazināties</button>
            </form>
        </div>
        <div class="right">
            <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d17601.485656897643!2d21.01436780494168!3d56.533447208670836!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46faa7ccb271be93%3A0xf9d1bf3406ae7d9d!2sLiep%C4%81jas%20Valsts%20tehnikums!5e0!3m2!1sen!2slv!4v1712747037508!5m2!1sen!2slv" width="600" height="450" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <footer>
        <div id="footer">
            <div class="contacts">
                <div class="info">
                    <i class="fas fa-map-marker-alt"></i>
                    <p>Adrese 123, Liepāja</p>
                </div>
                <div class="info">
                    <i class="fas fa-envelope"></i>
                    <p>epasts@epasts.lv</p>
                </div>
                <div class="info">
                    <i class="fas fa-phone"></i>
                    <p>+371 21234567</p>
                </div>
            </div>
            IT Spēks &copy; 2024
        </div>
       
    </footer>
</body>
</html>