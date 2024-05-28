    <?php
        require "header.php";
        require "navigation.php";
        require "darbinieks.php";
    ?>

    <section id="admin-section">
        <div class="table-heading">Darbinieku saraksts
            <button class="default-button" onclick="showWindow('edit-user-window')"><i class="fa-solid fa-circle-plus" type="button"></i> Pievienot lietotāju</button>
        </div>
        <table>
            <colgroup>
            <col><col><col><col><col><col style="width: 8rem;"><col style="width: 8rem;">
            </colgroup>

            <th>Lietotājvārds</th>
            <th>E-pasts</th>
            <th>Parādāmais vārds</th>
            <th>Pieejas tiesības</th>
            <th>Parole</th>
            <th></th>
            <th></th>

            <?php
                require "../assets/connect_db.php";
                $users_SQL = "SELECT * FROM it_speks_darbinieki";
                $select_users = mysqli_query($savienojums, $users_SQL);

                while($user = mysqli_fetch_array($select_users)){
                    echo "
                        <tr>
                            <td>{$user['Lietotajvards']}</td>
                            <td>{$user['Epasts']}</td>
                            <td>{$user['Paradamais_vards']}</td>
                            <td>{$user['Tiesibas']}</td>
                            <td>{$user['Parole']}</td>
                            <td>
                                <form method='post'>
                                    <button type='button' name='edit' class='default-button' onclick='showWindow(\"edit-user-window\")' value='{$user['Darbinieks_ID']}'><i class='fas fa-edit'></i></button>
                                </form>
                            </td>
                            <td>
                                <form method='post'>
                                    <button type='button' name='detele' class='default-button' onclick='showWindow(\"edit-user-window\")'><i class='fas fa-times' value='{$user['Darbinieks_ID']}'></i></button>
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








