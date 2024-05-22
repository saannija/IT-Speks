<?php
    require "header.php";
    require "navigation.php";
?>

<!-- <th>Logo</th>
<th>Profesijas nosaukums</th>
<th>Kompānijas nosaukums</th>
<th>Darba vieta</th>
<th>Atrašanās vieta</th>
<th>Slodze</th>
<th>Alga</th>
<th>Apraksts</th>
<th>Datums</th>
<th></th>
<th></th> -->

<section id="admin-section">
    <form action="" id="vacancy-input-form">
        <div class="content">
                <div class="column">
                        <div class="image-upload">
                                <img src="../images/example2.jpg" alt="Placeholder Image" id="preview-image">
                                <input type="file" id="image-input">
                        </div>

                        <div class="row">
                        <label for="prof">Profesijas nosaukums</label>
                        <input type="text" id="prof" class="default-input">

                        <label for="komp">Kompānijas nosaukums</label>
                        <input type="text" id="komp" class="default-input">

                        <label for="dvieta">Darba vieta</label>
                        <select name="dvieta" id="dvieta">
                        <option value="attalinati">Attālināti</option>
                        <option value="klatiene">Klātiene</option>
                        </select>
                        </div>


                </div>

                <div class="column">
                        <label for="avieta">Atrašanās vieta</label>
                        <input type="text" id="avieta" class="default-input">

                        <label for="slodze">Slodze</label>
                        <select name="slodze" id="slodze">
                        <option value="pilnalika">Pilna laika</option>
                        <option value="nepilnalika">Nepilna laika</option>
                        </select>

                        <label for="alga">Alga</label>
                        <input type="number" id="alga" class="default-input">
                        <!--Update date when file was edited-->
                </div>

        </div>

        <div class="content">
                <label for="apraksts">Apraksts</label>
                <textarea name="" id="apraksts" class="default-input"></textarea>
        </div>

    </form>
</section>

<?php
    require "../assets/footer.php"
?>

</body>
</html>
