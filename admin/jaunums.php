<?php
    require "header.php";
    require "navigation.php";
?>

<section id="admin-section">
    <form action="" id="news-input-form">
        <div class="content">
            <div class="row">
                <div class="column">
                <div class="image-upload default-borders">
                    <img src="../images/image-placeholder.jpg" id="preview-image">
                </div>
                <label for="image-input" class="upload">
                        Augšupielādēt attēlu
                </label>
                <input type="file" id="image-input">
                </div>

            </div>

        </div>

        <div class="content">
            <div>
                <label for="virsraksts">Virsraksts</label>
                <input type="text" id="virsraksts" class="default-input">
            </div>

            <div>
                <label for="apraksts">Saturs</label>
                <textarea name="" id="apraksts" class="default-input"></textarea>
            </div>


            <button type="submit" class="default-button" id="save-button">Saglabāt</button>

        </div>


    </form>
</section>

<?php
    require "../assets/footer.php"
?>

</body>
</html>
