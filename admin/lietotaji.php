<?php
        require "header.php";
        require "darbinieks.php";

        if(isset($_POST['delete-user'])) {
            $userId = $_POST['delete-user'];

            $sql_query_delete = "UPDATE it_speks_lietotaji SET Izdzests = 1 WHERE Lietotajs_ID = '$userId'";
            mysqli_query($savienojums, $sql_query_delete);
            header('location: lietotaji.php');
        }

    ?>
    <main>
    <section id="admin-section">
        <div class="table-heading">Lietotāju saraksts
        </div>
        <table>
            <th>Lietotājvārds</th>
            <th>Vārds</th>
            <th>Uzvārds</th>
            <th>Tālrunis</th>
            <th>E-pasts</th>
            <th>Pēdējais tiešsaistē</th>
            <form action="" method="post">
                <th><button type="submit" class="sort-old" name="sort" value="asc"><i class="fa-solid fa-arrow-up-9-1"></i></button></th>
                <th> <button type="submit" class="sort-new" name="sort" value="desc"><i class="fa-solid fa-arrow-up-1-9"></i></button></th>
            </form>

            <?php
                require "../assets/connect_db.php";
                $order = 'DESC';

                if (isset($_POST['sort'])){
                    if($_POST['sort'] == 'asc'){
                        $order = 'ASC';
                    } else if($_POST['sort'] == 'desc'){
                        $order = 'DESC';
                    }
                }
                
                $users_SQL = "SELECT * FROM it_speks_lietotaji WHERE Izdzests = 0 ORDER BY Tiessaiste " .$order;
                $select_users = mysqli_query($savienojums, $users_SQL);

                while($user = mysqli_fetch_array($select_users)){

                    echo "
                        <tr>
                            <td>{$user['Lietotajvards']}</td>
                            <td>{$user['Vards']}</td>
                            <td>{$user['Uzvards']}</td>
                            <td>{$user['Talrunis']}</td>
                            <td>{$user['Epasts']}</td>
                            <td>" . date("d.m.Y.", strtotime($user['Tiessaiste'])) . "</td>
                            <td></td>
                            <td>
                                <form method='POST'>
                                    <button type='submit' name='delete-user' class='default-button' value='{$user['Lietotajs_ID']}'><i class='fas fa-times'></i></button>
                                </form>
                            </td>
                        </tr>
                    ";
                }         
        ?>
        </table>
    </section>
    </main>
    <?php
        require "../assets/footer.php"
    ?>
</body>
</html>