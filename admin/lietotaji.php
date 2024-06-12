<?php
        require "header.php";
        require "darbinieks.php";

        if(isset($_POST['delete-user'])) {
            $userId = $_POST['delete-user'];

            $sql_query_delete = "UPDATE it_speks_lietotaji SET Izdzests = 1 WHERE Lietotajs_ID = '$userId'";
            mysqli_query($savienojums, $sql_query_delete);
            header('location: lietotaji.php');
        }

        if(isset($_POST['sort'])){
            $_SESSION['sort'] = $_POST['sort'];
        }else{
            $_SESSION['sort'] = "DESC";
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
            <th><form method="POST" id="table-button"><button type="submit" name="sort" value="<?php echo ($_SESSION['sort'] == 'ASC' ? 'DESC' : 'ASC'); ?>">Pēdējais tiešsaistē <i class="fa-solid fa-sort"></i><button></form></th>
            <th></th>

            <?php
                require "../assets/connect_db.php";
                
                $sort = $_SESSION['sort'];
                $users_SQL = "SELECT * FROM it_speks_lietotaji WHERE Izdzests = 0 ORDER BY Tiessaiste " .$sort;
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