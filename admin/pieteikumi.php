    <?php
        require "header.php";
        require "navigation.php";
        require "pieteikums.php";
    ?>
    
    <section id="admin-section">
        <div class="table-heading">Pieteikumu saraksts</div>
            <table>
            <colgroup>
                <col><col><col><col><col><col><col><col><col><col><col style="width: 5rem;"><col style="width: 5rem;">
            </colgroup>

                <th>Vārds</th>
                <th>Uzvārds</th>
                <th>Tālrunis</th>
                <th>E-pasts</th>
                <th>CV</th>
                <th>Izglītība</th>
                <th>Darba pieredze</th>
                <th>Komentāri</th>
                <th>Datums</th>
                <th>Statuss</th>
                <th></th>

                <?php
            for($i = 0; $i < 9; $i++){
                echo "
                    <tr>
                        <td>Vārds</td>
                        <td>Uzvārds</td>
                        <td>Tālrunis</td>
                        <td>E-pasts</td>  
                        <td>CV</td>
                        <td>Izglītība</td>
                        <td>Darba pieredze</td>
                        <td>Komentāri</td>
                        <td>Datums</td>
                        <td>Statuss</td>
                        <td>
                            <form method='post'>
                                <button type='button' name='edit' class='default-button' onclick='showWindow(\"edit-appl-window\")'><i class='fas fa-edit'></i></button>
                            </form>
                        </td>
                        <td>
                            <form method='post'>
                                <button type='submit' name='detele' class='default-button'><i class='fas fa-times'></i></button>
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











