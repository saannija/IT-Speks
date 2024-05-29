    <?php
        require "header.php";
        require "darbinieks.php";


        if(isset($_POST['delete'])) {
            $userId = $_POST['delete'];

            $sql_query_delete = "UPDATE it_speks_darbinieki SET Izdzests = 1 WHERE Darbinieks_ID = '$userId'";
            mysqli_query($savienojums, $sql_query_delete);
            header('location: darbinieki.php');
        }

    ?>

    <section id="admin-section">
        <div class="table-heading">Darbinieku saraksts
        <form method='post' class='edit-user-form'>
            <button class="default-button" onclick="showWindow('edit-user-window')" value="" name="edit-user"><i class="fa-solid fa-circle-plus" type="button"></i> Pievienot lietotāju</button>
        </form>
        </div>
        <table>
            <colgroup>
            <col><col><col><col><col style="width: 8rem;"><col style="width: 8rem;">
            </colgroup>

            <th>Lietotājvārds</th>
            <th>E-pasts</th>
            <th>Parādāmais vārds</th>
            <th>Pieejas tiesības</th>
            <th></th>
            <th></th>

            <?php
                require "../assets/connect_db.php";
                $users_SQL = "SELECT * FROM it_speks_darbinieki WHERE Izdzests = 0";
                $select_users = mysqli_query($savienojums, $users_SQL);

                while($user = mysqli_fetch_array($select_users)){
                    echo "
                        <tr>
                            <td>{$user['Lietotajvards']}</td>
                            <td>{$user['Epasts']}</td>
                            <td>{$user['Paradamais_vards']}</td>
                            <td>{$user['Tiesibas']}</td>
                            <td>
                                <form method='POST' class='edit-user-form'>
                                    <button type='submit' name='edit-user' class='default-button' onclick='showWindow(\"edit-user-window\")' value='{$user['Darbinieks_ID']}'><i class='fas fa-edit'></i></button>
                                </form>
                            </td>";
                    echo ($user['Darbinieks_ID'] == 1) ? "<td></td></tr>" : "
                            <td>
                                <form method='POST'>
                                    <button type='submit' name='delete' class='default-button' value='{$user['Darbinieks_ID']}'><i class='fas fa-times'></i></button>
                                </form>
                            </td>
                        </tr>
                    ";
                }         
        ?>
        </table>
    </section>
    
    <?php
        require "../assets/footer.php"
    ?>
</body>
</html>








