<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style_main.css">
    <script src="assets/script.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <title>Vakances</title>
</head>
<body>
    <?php
        require "assets/header.php";
        require "assets/login.php";
    ?>

    <header id="vacancy-header"> 
        <h2>Nosaukums</h2>
    </header>

    <section id="vacancy-section">
        <div class="element" id="description"> <!-- description -->
            <div class="wrapper">
                <h3>Vakances apraksts</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet pharetra ante. Vivamus vel eros eget turpis lacinia lobortis. Praesent viverra lacus in lorem eleifend posuere. Phasellus tempor nisl et laoreet porttitor. Quisque ut dolor consequat, molestie tortor at, iaculis ante. Fusce fringilla metus justo, sit amet volutpat mi eleifend sed. Nullam auctor est massa, vel auctor libero mattis at. Proin efficitur odio orci. Phasellus cursus eleifend sapien sed blandit. Phasellus sit amet justo vel felis lobortis ultricies a pharetra eros. Donec eu arcu id nisl vestibulum faucibus. Aenean fermentum dignissim lobortis. Vestibulum consectetur id neque at convallis. Proin mollis augue sed nulla ultricies vehicula.<br><br>Nunc a ex sed velit convallis vestibulum quis ut lorem. Proin porta, nibh in rhoncus rutrum, erat nunc aliquam risus, sed aliquam massa risus vulputate tortor. Sed aliquet id erat quis scelerisque. Suspendisse ultrices laoreet mauris sit amet vulputate. Donec porta feugiat erat, mollis aliquet tellus. Cras maximus mauris et augue vestibulum convallis. Praesent ut lectus a enim viverra laoreet sit amet eget lacus. Nulla justo magna, vestibulum at congue ac, auctor eu ex. Morbi vitae eros non mi pulvinar cursus vitae nec tellus. Praesent vulputate vehicula ipsum in consequat. Suspendisse hendrerit turpis sed diam dignissim iaculis. Cras venenatis lorem sit amet efficitur imperdiet. Maecenas sit amet lectus in dolor dapibus sodales. Duis sed ante vitae turpis ullamcorper convallis eget vel augue. Ut tincidunt pharetra vehicula.</p>
            </div>

            <div class="wrapper">
                <h3>Prasības</h3>
                <ul>
                    <li>qwe</li>
                    <li>qwe</li>
                </ul>
            </div>

            <div class="wrapper">
                <h3>Mēs piedāvājam</h3>
                <ul>
                    <li>qwe</li>
                    <li>qwe</li>
                </ul>
            </div>

        </div>

        <div class="element" id="summary"> <!-- summary -->
            <h3>Vakances kopsavilkums</h3>
            <ul>
                <li><strong>Publicēts:</strong> </li>
                <li><strong>Alga:</strong> </li>
                <li><strong>Atrašanās vieta:</strong> </li>
                <li><strong>Darba veids:</strong> </li>
            </ul>
        </div>

        <div class="element"> <!-- map -->
            <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d17601.485656897643!2d21.01436780494168!3d56.533447208670836!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46faa7ccb271be93%3A0xf9d1bf3406ae7d9d!2sLiep%C4%81jas%20Valsts%20tehnikums!5e0!3m2!1sen!2slv!4v1712747037508!5m2!1sen!2slv" width="600" height="450" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <div class="element" id="application"> <!-- application -->
            <h3>Piesakieties darbam</h3>
            <form method="POST" id="apply-form">
                <div class="wrapper-input">
                    <input type="text" class="default-input defalut-borders" name="vards" placeholder="Vārds">
                    <input type="text" class="default-input defalut-borders" name="uzvards" placeholder="Uzvārds">
                    <input type="text" class="default-input defalut-borders" name="talrunis" placeholder="Tālrunis">
                    <input type="text" class="default-input defalut-borders" name="epasts" placeholder="E-pasts">
                </div>

                <textarea name="komentars" placeholder="Komentāri" id="" class="default-input defalut-borders"></textarea>
                
                <div class="wrapper">
                    <label for="cv" class="cv-upload">
                        Augšupielādēt CV
                    </label>
                    <input id="cv" name="cv" type="file">
                    <button type="submit" class="default-button">Pieteikties</button>
                </div>
            </form>

        </div>

    </section>
    
    <?php
        require "assets/footer.php";
    ?>
</body>
</html>