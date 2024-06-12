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
    ?>

        <section id="news">
            <div id="allNews">
                <div class="navigation">
                    <a href="jaunumi.php"><i class="fa-solid fa-arrow-left"></i></a>
                    <div class="sorting">
                        <form action="" method="post">
                            <button type="submit" class="sort-old" name="sort" value="asc"><i class="fa-solid fa-arrow-up-9-1"></i></button>
                            <button type="submit" class="sort-new" name="sort" value="desc"><i class="fa-solid fa-arrow-up-1-9"></i></button>
                        </form>
                    </div>
                </div>
                <h2>Visi jaunumi</h2>
                
                <div class="cards all-cards">
                    <?php
                        require "assets/connect_db.php";
                        
                        $order = 'DESC';

                        if (isset($_POST['sort'])){
                            if($_POST['sort'] == 'asc'){
                                $order = 'ASC';
                            } else if($_POST['sort'] == 'desc'){
                                $order = 'DESC';
                            }
                        }

                        $news_sql = "SELECT * FROM it_speks_jaunumi WHERE Izdzests = 0 ORDER BY Datums $order;";
                        $result = mysqli_query($savienojums, $news_sql);

                        if(mysqli_num_rows($result) > 0){
                            while($news = mysqli_fetch_assoc($result)){
                                echo "
                                    <a href='jaunums.php?id={$news['ID']}'>
                                        <div class='card all-card'>
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

                <div class="pagination-all pagination">
                    <button class="prev-all" onclick="prevPageAll()"><i class="fa-solid fa-backward-step"></i></button>
                    <span id="page-number-all"></span>
                    <button class="next-all" onclick="nextPageAll()"><i class="fa-solid fa-forward-step"></i></button>
                </div>
            </div>
        </section>
   
   <?php
        require "assets/footer.php";
    ?>
</body>
</html>