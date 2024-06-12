    <?php
        require "header.php";
        require "jaunums.php";

        if(isset($_POST['detele-news'])) {
            $newsId = $_POST['detele-news'];

            $sql_query_delete = "UPDATE it_speks_jaunumi SET Izdzests = 1 WHERE ID = '$newsId'";
            mysqli_query($savienojums, $sql_query_delete);
            header('location: jaunumi.php');
        }
    ?>
    <main>
    <section id="admin-section">
        <div class="table-heading">Jaunumu saraksts
            <form method="post">
                <button class="default-button" onclick="showWindow('edit-news-window')" value="" name="edit-news" type="submit"><i class="fa-solid fa-circle-plus"></i> Pievienot jaunumus</button>
            </form>
        </div>
        <form action="" method="post">
            <table id="news-table">
                <colgroup>
                <col style="width: 7rem;"><col><col style="width: 45rem;"><col><col style="width: 8rem;"><col style="width: 8rem;">
                </colgroup>
            <tr>
                <th>Āttels</th>
                <th>Virsraksts</th>
                <th>Saturs</th>
                <th>Datums</th>
                <th>
                    <button type="submit" class="sort-old <?php echo (isset($_SESSION['sort_order']) && $_SESSION['sort_order'] == 'asc') ? 'active' : ''; ?>" name="sort" value="asc">
                        <i class="fa-solid fa-arrow-up-9-1"></i>
                    </button>
                </th>
                <th>
                    <button type="submit" class="sort-new <?php echo (isset($_SESSION['sort_order']) && $_SESSION['sort_order'] == 'desc') ? 'active' : ''; ?>" name="sort" value="desc">
                        <i class="fa-solid fa-arrow-up-1-9"></i>
                    </button>
                </th>
            </tr>

            <?php
                require "../assets/connect_db.php";
                require "../assets/pagination.php";

                $order = 'DESC';

                if (isset($_POST['sort'])) {
                    $_SESSION['sort_order'] = $_POST['sort'];
                }
                
                if (isset($_SESSION['sort_order'])) {
                    $order = ($_SESSION['sort_order'] == 'asc') ? 'ASC' : 'DESC';
                }
                

                $news_SQL = "SELECT * FROM it_speks_jaunumi WHERE Izdzests = 0 ORDER BY Datums $order LIMIT $offset, $rindas_lapa";
                $select_news = mysqli_query($savienojums, $news_SQL);

                while($news = mysqli_fetch_array($select_news)){
                    $pic = ($news['Attels_ID'] == 0) ? "<img src='../images/image-placeholder.jpg' class='default-borders'>"
                    : "<img src='../images/image.php?id={$news['Attels_ID']}' class='default-borders'>";
                    echo "
                        <tr>
                            <td>
                                {$pic}
                            </td>
                            <td>{$news['Virsraksts']}</td>
                            <td class='descrip'>{$news['Teksts']}</td>
                            <td>".date("d.m.Y.", strtotime($news['Datums']))."</td>
                            <td>
                                <form method='post'>
                                    <button type='submit' name='edit-news' onclick='showWindow(\"edit-news-window\")' value='{$news['ID']}' class='default-button'><i class='fas fa-edit'></i></button>
                                </form>
                            </td>
                            <td>
                                <form method='post'>
                                    <button type='submit' name='detele-news' value='{$news['ID']}' class='default-button'><i class='fas fa-times'></i></button>
                                </form>
                            </td>
                        </tr>
                    ";
                }
            
            ?>
            </table>
        </form>
        <div class="pagination">
            <a href="?lapa=<?php echo $sobrideja_lapa - 1; ?>" class="pagination-arrow <?php if ($sobrideja_lapa == 1) echo 'hidden'; ?>"><i class="fa-solid fa-backward-step"></i></a>
            
            <?php for ($i = 1; $i <= $visas_lapas; $i++): ?>
                <a href="?lapa=<?php echo $i; ?>" <?php if ($i == $sobrideja_lapa) echo 'class="sobrideja_lapa"'; ?>><?php echo $i; ?></a>
            <?php endfor; ?>
            
            <a href="?lapa=<?php echo $sobrideja_lapa + 1; ?>" class="pagination-arrow <?php if ($sobrideja_lapa == $visas_lapas) echo 'hidden'; ?>"><i class="fa-solid fa-forward-step"></i></a>
        </div>
    </section>
    </main>
    <?php
        require "../assets/footer.php"
    ?>
</body>
</html>
