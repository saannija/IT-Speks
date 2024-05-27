<div id="edit-news-window" class="default-popup">
    <div class="row">
        <h2>Rediģēt</h2>
        <button class="default-button" onclick="hideWindow('edit-news-window')"><i class="fas fa-times"></i></button>
    </div>

    <hr>

    <form id="news-input-form">
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

</div>

<div id="background-overlay"></div>
