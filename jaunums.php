<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Spēks</title>
    <link rel="stylesheet" href="assets/style_main.css">
    <script src="assets/script.js" defer></script>
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
</head>
<body>
    <?php
        require "assets/header.php";
        require "assets/connect_db.php";

        if (isset($_GET['id'])){
            $newsId = intval($_GET['id']);

            $news_select_SQL = "SELECT * FROM it_speks_jaunumi WHERE Izdzests = 0 AND ID = {$newsId}";
            $select_news = mysqli_query($savienojums, $news_select_SQL);

            if(mysqli_num_rows($select_news) > 0){
                while($news = mysqli_fetch_assoc($select_news)){
                    $title = $news['Virsraksts'];
                    $text = $news['Teksts'];
                    $pic = $news['Attels_ID'];
                    $author = $news['Autors'];
                    $reg_date = date("d.m.Y.", strtotime($news['Datums']));
                }
            }
        }
    ?>

    <section id="headerNew">
        <div class="navigation">
            <a href="jaunumi.php"><i class="fa-solid fa-arrow-left"></i></a>
        </div>
    </section>

    <section id="new">
        <div class="image-container">
            <img class="banner-image" src="images/image.php?id= <?php echo $pic; ?> " alt="img">
        </div>
        <h1><?php echo $title; ?></h1>
        <p class="allText"> <?php echo $text; ?> </p>
    </section>
    <hr id="news-hr">
    <section id="footerNew">
        <p id="author">Autors: <?php echo $author; ?> </p>
        <p id="date">Publicēts: <?php echo $reg_date; ?> </p>
    </section>
   <?php
        require "assets/footer.php";
    ?>
</body>
</html>