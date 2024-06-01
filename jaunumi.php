<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Spēks</title>
    <link rel="stylesheet" href="assets/style_main.css">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <script src="assets/script.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
</head>
<body>
    <?php
        require "assets/header.php";
    ?>

    <section id="headerSimple">
        <h1 id="news-heading">Sekojiet līdzi šodienas <span>IT aktualitātēm!</span></h1>
    </section>

   <section id="latestNews">
        <?php
            $title = $text = $pic = $id =NULL;

            $newest_sql = "SELECT * FROM it_speks_jaunumi WHERE Izdzests = 0 ORDER BY Datums DESC LIMIT 1;";
            $result = mysqli_query($savienojums, $newest_sql);

            if(mysqli_num_rows($result) > 0){
                while($news = mysqli_fetch_assoc($result)){
                    $id = $news['ID'];
                    $title = $news['Virsraksts'];
                    $text = $news['Teksts'];
                    $pic = $news['Attels_ID'];
                }
            }
        ?>
        <div class="bg"></div>
        <div class="bg0"></div>
        <img src="images/image.php?id=<?php echo $pic;?>" alt="Jaunumi">
        <div class="latestContent">
            <h3 class="title"><?php echo $title;?></h3>
            <p class="text"><?php echo $text; ?></p>
            <a href="jaunums.php?id=<?php echo $id;?>" class="read-more">Lasīt vairāk!</a>
        </div>
   </section>
   
   <section id="news">
        <h2>Šī mēneša jaunumi</h2>
            <div class="cards">
                <?php
                    $news_sql = "SELECT * FROM it_speks_jaunumi WHERE Izdzests = 0 ORDER BY Datums DESC;";
                    $result = mysqli_query($savienojums, $news_sql);

                    if(mysqli_num_rows($result) > 0){
                        while($news = mysqli_fetch_assoc($result)){
                            echo "
                                <a href='jaunums.php?id={$news['ID']}' class='card-a'>
                                    <div class='card'>
                                        <img src='images/image.php?id={$news['Attels_ID']}' alt='pic'>
                                        <h3 class='title'>{$news['Virsraksts']}</h3>
                                        <div class='content'> 
                                            <h3 class='title'>{$news['Virsraksts']}</h3>
                                            <hr class='line'>
                                            <p class='text'>{$news['Teksts']}</p>
                                        </div>
                                    </div>
                                </a>
                            ";
                        }
                    }
                ?>
            
            </div>
        <div class="pagination">
            <button class="prev" onclick="prevPage()"><i class="fa-solid fa-backward-step"></i></button>
            <span id="page-number"></span>
            <button class="next" onclick="nextPage()"><i class="fa-solid fa-forward-step"></i></button>
        </div>
   </section>

   <section id="allBtn">
        <a href="visi_jaunumi.php" class="read-more view-all">Apskatīt visus jaunumus! </a>
   </section>

   <?php
        require "assets/footer.php";
    ?>
</body>
</html>