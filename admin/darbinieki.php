    <?php
        require "header.php";
        require "navigation.php";
        require "darbinieks.php";
    ?>

    <section id="admin-section">
        <div class="table-heading">Darbinieku saraksts
        <form action=""><button class="default-button"><i class="fa-solid fa-circle-plus"></i> Pievienot lietotāju</button></form></div>
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
            for($i = 0; $i < 9; $i++){
                echo "
                    <tr>
                        <td>Lietotājvārds</td>
                        <td>E-pasts</td>
                        <td>Parādāmais vārds</td>
                        <td>Pieejas tiesības</td>
                        <td>Parole</td> <!-- Paradas tikai administratoram-->
                        <td>
                            <form method='post'>
                                <button type='button' name='edit' class='default-button' onclick='showWindow(\"edit-user-window\")'><i class='fas fa-edit'></i></button>
                            </form>
                        </td>
                        <td>
                            <form method='post'>
                                <button type='button' name='detele' class='default-button' onclick='showWindow(\"edit-user-window\")'><i class='fas fa-times'></i></button>
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








