<?php
    require "header.php";
    require "navigation.php";
?>

<section id="admin-section">
    <form action="" id="vacancy-input-form">
        <div class="content">
            <div class="row">
                <div class="column">
                <div class="image-upload default-borders">
                    <img src="../images/image-placeholder.jpg" id="preview-image">
                </div>
                <label for="image-input" class="upload">
                        Augšupielādēt Logo
                </label>
                <input type="file" id="image-input">
                </div>



                <div class="column">
                    <label for="prof">Profesijas nosaukums</label>
                    <input type="text" id="prof" class="default-input">

                    <label for="komp">Kompānijas nosaukums</label>
                    <input type="text" id="komp" class="default-input">

                    <label for="avieta">Atrašanās vieta</label>
                    <input type="text" id="avieta" class="default-input">
                
                    <label for="dvieta">Darba vieta</label>
                    <select name="dvieta" id="dvieta">
                    <option value="attalinati">Attālināti</option>
                    <option value="klatiene">Klātiene</option>
                    </select>

                    <label for="slodze">Slodze</label>
                    <select name="slodze" id="slodze">
                    <option value="pilnalika">Pilna laika</option>
                    <option value="nepilnalika">Nepilna laika</option>
                    </select>
                                
                    <label for="alga">Alga</label>
                    <input type="number" id="alga" class="default-input">
                    <!-- Update date when file was edited -->

                </div>

            </div>

        </div>

        <div class="content">
                <label for="apraksts">Vakances apraksts</label>
                <textarea name="" id="apraksts" class="default-input"></textarea>

                <div class="container">
                <div id="list-container">
                        <label for="prasibas">Prasības</label>
                        <ul id="prasibas-item-list">
                                <li><input type="text" id="prasibas" class="default-input"></li>
                        </ul>
                        <button class="default-button" onclick="createNewItem('prasibas-item-list')" type="button">Pievienot</button>
                </div>

                <div id="list-container">
                        <label for="piedavajam">Mēs piedāvājam</label>
                        <ul id="piedavajam-item-list">
                                <li><input type="text" id="piedavajam" class="default-input"></li>
                        </ul>
                        <button class="default-button" onclick="createNewItem('piedavajam-item-list')" type="button">Pievienot</button>
                </div>

                <button type="submit" class="default-button" id="save-button">Saglabāt</button>
                </div>
                
        </div>

    </form>
</section>

<?php
    require "../assets/footer.php"
?>

</body>
</html>
